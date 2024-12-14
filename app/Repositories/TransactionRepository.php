<?php

namespace App\Repositories;

use App\Helpers\NumberHelper;
use App\Models\MilkIncome;
use App\Models\User;
use App\Repositories\Interfaces\TransactionRepositoryInterface;

class TransactionRepository implements TransactionRepositoryInterface
{
    public function getUsersWithTotalDepositsAndWithdraws($entries, $keyword)
    {
        // Start the query for users with the 'farmer' role
        $query = User::query()
            ->withSum('deposit', 'deposit')  // Get the total deposit for each user
            ->withSum('withdraw', 'withdraw')  // Get the total withdraw for each user
            ->whereHas('roles', function ($query) {
                $query->where('name', 'farmer');  // Filter users with the 'farmer' role
            })
            ->orderBy('owner_name');  // Sorting by owner_name

        // Apply the keyword filter for user attributes like name, farmer_number, phone_number, or location
        if ($keyword) {
            $query->where(function ($query) use ($keyword) {
                $query->where('owner_name', 'like', '%' . $keyword . '%')
                    ->orWhere('farmer_number', 'like', '%' . $keyword . '%')
                    ->orWhere('phone_number', 'like', '%' . $keyword . '%')
                    ->orWhere('location', 'like', '%' . $keyword . '%');
            });
        }

        // Limit the number of entries per page
        $users = $query->paginate($entries);

        return $users;
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
                    ->orWhere('phone_number', 'like', '%' . $keyword . '%')
                    ->orWhere('farmer_number', 'like', '%' . $keyword . '%');
                })
                ->orWhereHas('milkDeposits', function ($query) use ($keyword) {
                    $query->where('milk_deposit_date', 'like', '%' . $keyword . '%');
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
}
