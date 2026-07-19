<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\SaleService;
use App\Http\Requests\StoreSaleRequest;
use App\Http\Resources\SaleResource;
use Illuminate\Http\JsonResponse;

class SaleController extends Controller
{
    public function __construct(
        private readonly SaleService $saleService
    ) {
    }

    public function store(StoreSaleRequest $request): JsonResponse
    {
        $sale = $this->saleService->create(
            $request->validated()
        );

        return response()->json([
            'success' => true,
            'message' => 'Sale completed successfully.',
            'data' => new SaleResource($sale),
        ], 201);
    }
}
