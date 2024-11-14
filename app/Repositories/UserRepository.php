<?php

namespace App\Repositories;

use App\Models\MilkDeposit;
use App\Models\User;
use Carbon\Carbon;
use App\Helpers\NumberHelper;
use App\Repositories\Interfaces\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    public function all($entries, $search, $sortField, $sortDirection)
    {
        // Start the query with users who have the 'farmer' role
        $query = User::role('farmer');

        // Apply search filter if search term is provided
        if (!empty($search)) {
            $query->where(function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('owner_name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('location', 'like', "%{$search}%")
                    ->orWhere('farmer_number', 'like', "%{$search}%")
                    ->orWhere('phone_number', 'like', "%{$search}%")
                    ->orWhere('pan_number', 'like', "%{$search}%")
                    ->orWhere('vat_number', 'like', "%{$search}%")
                    ->orWhere('gender', 'like', "%{$search}%")
                    ->orWhere('status', 'like', "%{$search}%");
            });
        }

        // Apply sorting if sort field and direction are provided
        if (!empty($sortField) && in_array($sortDirection, ['asc', 'desc'])) {
            $query->orderBy($sortField, $sortDirection);
        } else {
            $query->latest(); // Default sorting by latest if no sort parameters provided
        }

        // Paginate the results
        if ($entries == 'all') {
            return $query->get();
        }
        return $query->paginate($entries);
    }

    // ============get milk deposits =================
    public function getMilkDeposits($entries = 10, $search = null, $sortField = 'created_at', $sortDirection = 'desc', $milk_deposit_date = null, $milk_deposit_time = null, $milk_type = null)
    {
        // Start the query
        $query = MilkDeposit::with('user');

        // Filter by date if provided, otherwise use today's date
        if (!$milk_deposit_date) {
            $query->whereDate('created_at', Carbon::today());
        } else {
            $query->where('milk_deposit_date', $milk_deposit_date);
        }

        // Filter by milk deposit time if provided
        if ($milk_deposit_time) {
            $query->where('milk_deposit_time', $milk_deposit_time);
        }

        // Apply search filter for specific fields
        if ($search) {
            $query->where(function ($query) use ($search) {
                $query->whereHas('user', function ($userQuery) use ($search) {
                    $userQuery->where('farmer_number', 'like', "%{$search}%")
                        ->orWhere('owner_name', 'like', "%{$search}%");
                })
                    ->orWhere('milk_type', 'like', "%{$search}%");
            });
        }

        // Apply sorting
        $query->orderBy($sortField, $sortDirection);

        // Paginate the results with the specified number of entries per page
        if ($entries == 'all') {
            // If 'all' is passed, get all results without pagination
            $milkDeposits = $query->get();
        } else {
            // Otherwise, paginate the results
            $milkDeposits = $query->paginate($entries);
        }

        // Convert the milk_price_per_ltr column to Nepali numerals
        // Use the items() method on the paginator to access the collection
        $milkDeposits->getCollection()->transform(function ($deposit) {
            $deposit->milk_per_ltr_price_with_commission = NumberHelper::toNepaliNumber($deposit->milk_per_ltr_price_with_commission);
            $deposit->milk_snf = NumberHelper::toNepaliNumber($deposit->milk_snf);
            $deposit->milk_fat = NumberHelper::toNepaliNumber($deposit->milk_fat);
            $deposit->milk_quantity = NumberHelper::toNepaliNumber($deposit->milk_quantity);
            $deposit->milk_total_price = NumberHelper::toNepaliNumber($deposit->milk_total_price);
            return $deposit;
        });

        return $milkDeposits;
    }
    // ============end of getting milk deposits===========

    // ==========get total money generated from milk on specific date==========
    public function getTotalIncomeFromMilkOnSpecificDate($milk_deposit_date, $milk_deposit_time)
    {
        if (!$milk_deposit_date) {
            $milk_deposit_date = Carbon::now();
        }
        $totalDepositIncome = MilkDeposit::where('milk_deposit_date', $milk_deposit_date)
            ->where('milk_deposit_time', $milk_deposit_time)
            ->sum('milk_total_price');
        $totalDepositedMilk = MilkDeposit::where('milk_deposit_date', $milk_deposit_date)
            ->where('milk_deposit_time', $milk_deposit_time)
            ->sum('milk_quantity');
        return [
            'totalDepositIncome' => $totalDepositIncome,
            'totalDepositedMilk' => $totalDepositedMilk
        ];
    }
    // ==========end of getting total money generated from milk on specific date==========

    // ============get total milk deposits reports=================
    public function getMilkDepositsReports($entries = 10, $search = null)
    {
        // Start the query
        $query = MilkDeposit::with('user');
    
        // Apply search filter for specific fields
        if ($search) {
            $query->where(function ($query) use ($search) {
                $query->whereHas('user', function ($userQuery) use ($search) {
                    $userQuery->where('farmer_number', 'like', "%{$search}%")
                        ->orWhere('owner_name', 'like', "%{$search}%");
                })
                ->orWhere('milk_type', 'like', "%{$search}%")
                ->orWhere('milk_deposit_date','like', "%{$search}%")
                ->orWhere('milk_deposit_time','like', "%{$search}%");
            });
        }
    
        // Apply sorting to get latest first
        $query->orderBy('created_at', 'desc');
    
        // Paginate the results with the specified number of entries per page
        if ($entries == 'all') {
            $milkDeposits = $query->get();
        } else {
            $milkDeposits = $query->paginate($entries);
        }
    
        // Convert the milk_price_per_ltr column to Nepali numerals
        $milkDeposits->getCollection()->transform(function ($deposit) {
            $deposit->milk_per_ltr_price_with_commission = NumberHelper::toNepaliNumber($deposit->milk_per_ltr_price_with_commission);
            $deposit->milk_snf = NumberHelper::toNepaliNumber($deposit->milk_snf);
            $deposit->milk_fat = NumberHelper::toNepaliNumber($deposit->milk_fat);
            $deposit->milk_quantity = NumberHelper::toNepaliNumber($deposit->milk_quantity);
            $deposit->milk_total_price = NumberHelper::toNepaliNumber($deposit->milk_total_price);
            $deposit->milk_price_per_ltr = NumberHelper::toNepaliNumber($deposit->milk_price_per_ltr);
            $deposit->per_ltr_commission = NumberHelper::toNepaliNumber($deposit->per_ltr_commission);
            return $deposit;
        });
    
        return $milkDeposits;
    }
    
    //    =========end of getting total milk deposit reports========


     // ==========get total money generated from milk ==========
     public function getTotalIncomeFromMilk()
     {
         $totalDepositIncome = MilkDeposit::sum('milk_total_price');
         $totalDepositedMilk = MilkDeposit::sum('milk_quantity');
         return [
             'totalDepositIncome' => $totalDepositIncome,
             'totalDepositedMilk' => $totalDepositedMilk
         ];
     }
     // ==========end of getting total money generated from milk ==========
}
