<?php

namespace App\Exports;

use App\Models\MilkDeposit;
use Maatwebsite\Excel\Concerns\FromCollection;

class MilkDepositsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return MilkDeposit::with('user')->get()->map(function ($deposit) {
            return [
                'Member No' => $deposit->user->farmer_number,
                'Owner' => $deposit->user->owner_name,
                'Type' => $deposit->milk_type,
                'Qty (L)' => $deposit->milk_quantity,
                'Fat (%)' => $deposit->milk_fat,
                'SNF (%)' => $deposit->milk_snf,
                'Price/L' => $deposit->milk_per_ltr_price_with_commission,
                'Total Price' => $deposit->milk_total_price,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Member No',
            'Owner',
            'Type',
            'Qty (L)',
            'Fat (%)',
            'SNF (%)',
            'Price/L',
            'Total Price',
        ];
    }
}
