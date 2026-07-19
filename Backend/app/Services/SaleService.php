<?php

namespace App\Services;

use App\Models\Sale;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\SaleItem;
use App\Models\InventoryTransaction;
use Illuminate\Validation\ValidationException;

class SaleService
{
     public function create(array $data): Sale
    {
        return DB::transaction(function () use ($data) {

            $invoice = 'INV-' . now()->format('YmdHis');

            $sale = Sale::create([

                'invoice_no' => $invoice,
                'customer_id' => $data['customer_id'],
                'user_id' => Auth::id(),
                'subtotal' => 0,
                'discount' => $data['discount'] ?? 0,
                'tax' => $data['tax'] ?? 0,
                'total' => 0,
                'payment_method' => $data['payment_method'],
                'payment_status' => $data['payment_status'],
                'sold_at' => $data['sold_at'],

            ]);

            $subtotal = 0;

            foreach ($data['items'] as $item) {

                $product = Product::lockForUpdate()->findOrFail($item['product_id']);

                if (! $product->is_active) {
                    throw ValidationException::withMessages([
                        'product' => "Product {$product->name} is inactive."
                    ]);
                }

                if ($product->stock_quantity < $item['quantity']) {
                    throw ValidationException::withMessages([
                        'stock' => "Insufficient stock for {$product->name}."
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

                $previous = $product->stock_quantity;

                $product->decrement('stock_quantity', $item['quantity']);

                InventoryTransaction::create([

                    'product_id' => $product->id,
                    'sale_id' => $sale->id,
                    'type' => 'sale',
                    'quantity' => $item['quantity'],
                    'previous_stock' => $previous,
                    'new_stock' => $previous - $item['quantity'],
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

            return $sale->fresh();
        });
    }
}