<?php

namespace App\Services;

use App\Models\Sale;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\SaleItem;
use App\Models\BranchInventories;
use App\Services\EmployeeKpiService;
use App\Models\InventoryTransaction;
use Illuminate\Validation\ValidationException;

class SaleService
{
    public function __construct(
        private readonly EmployeeKpiService $employeeKpiService
    ){}

    public function create(array $data): Sale
    {
        return DB::transaction(function () use ($data) {

            $invoiceNo = 'INV-' . now()->format('YmdHis') . '-' . random_int(1000, 9999);

            $sale = Sale::create([

                'invoice_no'     => $invoiceNo,
                'branch_id'      => $data['branch_id'],
                'customer_id'    => $data['customer_id'],
                'user_id'        => Auth::id(),
                'subtotal'       => 0,
                'discount'       => $data['discount'] ?? 0,
                'tax'            => $data['tax'] ?? 0,
                'total'          => 0,
                'payment_method' => $data['payment_method'],
                'payment_status' => $data['payment_status'],
                'sold_at'        => $data['sold_at'],

            ]);

            $subtotal = 0;

            foreach ($data['items'] as $item) {

                $product = Product::findOrFail($item['product_id']);

                if (! $product->is_active) {

                    throw ValidationException::withMessages([

                        'product' => [
                            "{$product->name} is inactive."
                        ]

                    ]);
                }

                $inventory = BranchInventories::where(

                        'branch_id',

                        $data['branch_id']

                    )
                    ->where(

                        'product_id',

                        $product->id

                    )
                    ->lockForUpdate()
                    ->first();

                if (! $inventory) {

                    throw ValidationException::withMessages([

                        'inventory' => [
                            "{$product->name} does not exist in this branch."
                        ]

                    ]);
                }

                if ($inventory->stock_quantity < $item['quantity']) {

                    throw ValidationException::withMessages([

                        'stock' => [
                            "Insufficient stock for {$product->name}."
                        ]

                    ]);
                }

                $lineSubtotal = $product->price * $item['quantity'];

                SaleItem::create([

                    'sale_id' => $sale->id,
                    'product_id' => $product->id,
                    'quantity' => $item['quantity'],
                    'unit_price' => $product->price,
                    'subtotal' => $lineSubtotal,
                ]);

                $previousStock = $inventory->stock_quantity;

                $inventory->decrement(

                    'stock_quantity',

                    $item['quantity']

                );

                InventoryTransaction::create([

                    'branch_id' => $data['branch_id'],
                    'product_id' => $product->id,
                    'sale_id' => $sale->id,
                    'type' => 'sale',
                    'quantity' => $item['quantity'],
                    'previous_stock' => $previousStock,
                    'new_stock' => $previousStock - $item['quantity'],
                    'user_id' => Auth::id(),
                    'timestamp' => now(),

                ]);

                $subtotal += $lineSubtotal;
            }

            $total = $subtotal
                - ($data['discount'] ?? 0)
                + ($data['tax'] ?? 0);

            $sale->update([

                'subtotal' => $subtotal,
                'total' => $total,
                                     
            ]);

            $this->employeeKpiService->reward($sale);

            return $sale->fresh([
                'customer',
                'user',
                'branch',
                'saleItems.product',
            ]);
        });
    }
}