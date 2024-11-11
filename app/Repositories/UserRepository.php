<?php

namespace App\Repositories;

use App\Models\MilkDeposit;
use App\Models\User;
use Carbon\Carbon;
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
    
        // Filter by milk type if provided
        if ($milk_type) {
            $query->where('milk_type', $milk_type);
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
        return $query->paginate($entries);
    }
    
    // ============end of getting milk deposits===========
}
