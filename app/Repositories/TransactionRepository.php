<?php

namespace App\Repositories;

use App\Helpers\NumberHelper;
use App\Models\Account;
use App\Models\MilkIncome;
use App\Models\User;
use App\Repositories\Interfaces\TransactionRepositoryInterface;

class TransactionRepository implements TransactionRepositoryInterface
{
    public function getUsersTransactionInfo($entries, $keyword = null)
    {
        $accountsQuery = Account::with('user')
            ->join('users', 'users.id', '=', 'accounts.user_id')  // Join the users table
            ->orderBy('users.id', 'asc'); // Order by users' created_at in ascending order

        // Apply search condition only if $keyword is provided
        if ($keyword) {
            $accountsQuery->where(function ($query) use ($keyword) {
                $query->where('users.owner_name', 'like', "%$keyword%")
                    ->orWhere('users.farmer_number', 'like', "%$keyword%");
            });
        }

        // If `$entries` is 'all', retrieve all records, else paginate
        $accounts = ($entries === 'all') ? $accountsQuery->get() : $accountsQuery->paginate($entries);

        // Convert balance to Nepali numbers
        $accounts->transform(function ($account) {
            $account->nepali_balance = \App\Helpers\NumberHelper::toNepaliNumber($account->balance);
            return $account;
        });

        return $accounts;
    }

    public function getTotalBalance()
    {
        // Get the sum of all balances from the 'accounts' table
        $totalBalance = Account::sum('balance');

        // Convert the total balance to Nepali numerals
        $totalBalanceNepali = \App\Helpers\NumberHelper::toNepaliNumber($totalBalance);

        // Return the total balance in Nepali format
        return $totalBalanceNepali;
    }


    public function getMilkDepositIncome($entries, $keyword, $milk_deposit_date = null)
    {
        // Start the query for MilkIncome with relations and sum aggregations
        $query = MilkIncome::with('user', 'milkDeposits')
            ->orderBy('created_at', 'asc');;

        // Apply keyword filter for user attributes like name, email, or other attributes
        if ($keyword) {
            $query->where(function ($q) use ($keyword) {
                $q->whereHas('user', function ($query) use ($keyword) {
                    $query->where('owner_name', 'like', '%' . $keyword . '%')
                        ->orWhere('farmer_number', 'like', '%' . $keyword . '%');
                })
                    ->orWhereHas('milkDeposits', function ($query) use ($keyword) {
                        $query->where('milk_deposit_time', 'like', '%' . $keyword . '%');
                    });
            });
        }

        // Apply filter for milk_deposit_date if provided
        if ($milk_deposit_date) {
            $query->whereHas('milkDeposits', function ($query) use ($milk_deposit_date) {
                $query->where('milk_deposit_date', '=', $milk_deposit_date);
            });
        }

        // Apply pagination with the specified number of entries per page
        $accounting = ($entries === 'all') ? $query->get() : $query->paginate($entries);

        $accounting->getCollection()->transform(function ($account) {
            $account->deposit_nepali = NumberHelper::toNepaliNumber($account->deposit);
            $account->milkDeposits->milk_quantity_nepali = NumberHelper::toNepaliNumber($account->milkDeposits->milk_quantity);
            return $account;
        });

        return $accounting;
    }

    public function getMilkDepositIncomeForExport($keyword, $milk_deposit_date = null)
    {
        // Start the query for MilkIncome with relations and sum aggregations
        $query = MilkIncome::with('user', 'milkDeposits')
            ->join('users', 'users.id', '=', 'milk_incomes.user_id')
            ->orderBy('users.id', 'asc');

        // Apply keyword filter for user attributes like name, email, or other attributes
        if ($keyword) {
            $query->where(function ($q) use ($keyword) {
                $q->whereHas('user', function ($query) use ($keyword) {
                    $query->where('owner_name', 'like', '%' . $keyword . '%')
                        ->orWhere('farmer_number', 'like', '%' . $keyword . '%');
                })
                    ->orWhereHas('milkDeposits', function ($query) use ($keyword) {
                        $query->where('milk_deposit_time', 'like', '%' . $keyword . '%');
                    });
            });
        }

        // Apply filter for milk_deposit_date if provided
        if ($milk_deposit_date) {
            $query->whereHas('milkDeposits', function ($query) use ($milk_deposit_date) {
                $query->where('milk_deposit_date', '=', $milk_deposit_date);
            });
        }

        // Apply pagination with the specified number of entries per page
        $accounting = $query->get(); // Use get() instead of paginate()

        $accounting->transform(function ($account) {
            $account->deposit_nepali = NumberHelper::toNepaliNumber($account->deposit);
            $account->milkDeposits->milk_quantity_nepali = NumberHelper::toNepaliNumber($account->milkDeposits->milk_quantity);
            return $account;
        });

        return $accounting; // Return the collection instead of paginated data
    }


    public function getTotalMilkIncomeWithFilters($keyword, $milk_deposit_date = null)
    {
        // Start the query for MilkIncome with relations and sum aggregations
        $query = MilkIncome::with('user', 'milkDeposits')
            ->join('milk_deposits', 'milk_incomes.milk_deposits_id', '=', 'milk_deposits.id') // Corrected the foreign key reference
            ->selectRaw('SUM(milk_deposits.milk_quantity) as total_milk_quantity, SUM(milk_deposits.milk_total_price) as total_milk_price'); // Aggregate sums directly

        // Apply keyword filter for user attributes like name, email, or other attributes
        if ($keyword) {
            $query->where(function ($q) use ($keyword) {
                $q->whereHas('user', function ($query) use ($keyword) {
                    $query->where('owner_name', 'like', '%' . $keyword . '%')
                        ->orWhere('farmer_number', 'like', '%' . $keyword . '%');
                })
                    ->orWhereHas('milkDeposits', function ($query) use ($keyword) {
                        $query->where('milk_deposit_time', 'like', '%' . $keyword . '%');
                    });
            });
        }

        // Apply filter for milk_deposit_date if provided
        if ($milk_deposit_date) {
            $query->whereHas('milkDeposits', function ($query) use ($milk_deposit_date) {
                $query->where('milk_deposit_date', '=', $milk_deposit_date);
            });
        }

        // Execute the query to calculate the totals
        $totals = $query->first(); // Retrieve the totals directly

        // Convert the totals to Nepali numbers (if needed)
        $totalMilkQuantityNepali = NumberHelper::toNepaliNumber($totals->total_milk_quantity);
        $totalMilkPriceNepali = NumberHelper::toNepaliNumber($totals->total_milk_price);

        // Return the results with the totals
        return [
            'total_milk_quantity' => $totals->total_milk_quantity,
            'total_milk_quantity_nepali' => $totalMilkQuantityNepali,
            'total_milk_price' => $totals->total_milk_price,
            'total_milk_price_nepali' => $totalMilkPriceNepali,
        ];
    }
}
