<?php

namespace App\Services;

use App\Models\CustomerAssignment;
use App\Models\EmployeeKpi;
use App\Models\Sale;

class EmployeeKpiService
{

    public function __construct(
        private readonly EmployeeKpiService $employeeKpiService
    ){
    }

    public function reward(Sale $sale): void
    {
        $assignment = CustomerAssignment::where(
                'customer_id',
                $sale->customer_id
            )
            ->where('status', 'assigned')
            ->latest()
            ->first();

        if (! $assignment) {
            return;
        }

        EmployeeKpi::create([

            'user_id' => $assignment->user_id,
            'customer_id' => $sale->customer_id,
            'sale_id' => $sale->id,
            'points' => 10,
            'reason' => 'Inactive customer returned and completed a purchase.',

        ]);

        $assignment->update([
            'status' => 'completed',
        ]);
    }
}