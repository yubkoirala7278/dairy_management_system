<?php

namespace App\Repositories;

use App\Helpers\NumberHelper;
use App\Models\Account;
use App\Models\MilkIncome;
use App\Models\User;
use App\Repositories\Interfaces\TransactionRepositoryInterface;

class TransactionRepository implements TransactionRepositoryInterface
{
    public function getUsersTransactionInfo($entries, $keyword)
    {
        $accounts = Account::with('user')
            ->whereHas('user', function ($query) use ($keyword) {
                $query->where('name', 'like', "%$keyword%")
                      ->orWhere('farmer_number', 'like', "%$keyword%");
            })
            ->paginate($entries);
    
        // Convert balance to Nepali numbers for each account
        $accounts->getCollection()->transform(function ($account) {
            $account->nepali_balance = \App\Helpers\NumberHelper::toNepaliNumber($account->balance);
            return $account;
        });
    
        return $accounts;
    }
    

    public function getMilkDepositIncome($entries, $keyword)
    {
        // Start the query for MilkIncome with relations and sum aggregations
        $query = MilkIncome::with('user', 'milkDeposits')
            ->orderBy('created_at', 'asc'); // Order by the latest entries

        // Apply keyword filter for user attributes like name, email, or other attributes
        if ($keyword) {
            $query->where(function ($q) use ($keyword) {
                $q->whereHas('user', function ($query) use ($keyword) {
                    $query->where('owner_name', 'like', '%' . $keyword . '%')
                    ->orWhere('farmer_number', 'like', '%' . $keyword . '%');
                });
            });
        }

        // Apply pagination with the specified number of entries per page
        $accounting = $query->paginate($entries);

        $accounting->getCollection()->transform(function ($account) {
            $account->deposit_nepali = NumberHelper::toNepaliNumber($account->deposit);
            $account->milkDeposits->milk_quantity_nepali = NumberHelper::toNepaliNumber($account->milkDeposits->milk_quantity);
            return $account;
        });

        return $accounting;
    }


    public function getTotalMilkIncomeWithFilters($search = null)
    {
        // Start the query
        $query = MilkIncome::query();

        // Apply search filter for specific fields
        if ($search) {
            $query->where(function ($query) use ($search) {
                $query->whereHas('milkDeposits', function ($milkDepositQuery) use ($search) {
                    $milkDepositQuery->whereHas('user', function ($userQuery) use ($search) {
                        $userQuery->where('farmer_number', 'like', "%{$search}%")
                            ->orWhere('owner_name', 'like', "%{$search}%");
                    });
                })
                    ->orWhereHas('milkDeposits', function ($milkDepositQuery) use ($search) {
                        $milkDepositQuery->where('milk_type', 'like', "%{$search}%");
                    });
            });
        }

        // Apply withSum to get the total milk quantity and total milk price
        $totals = $query->withSum('milkDeposits', 'milk_quantity')
            ->withSum('milkDeposits', 'milk_total_price')
            ->get();

        return $totals;
    }
}
