<?php

namespace App\Repositories;

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
}
