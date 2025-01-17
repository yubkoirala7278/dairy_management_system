<?php

namespace App\Repositories\Interfaces;

interface UserRepositoryInterface
{
    public function all($entries, $search);
    public function getMilkDeposits($entries, $search,$milk_deposit_date,$milk_deposit_time,$milk_type);
    public function getTotalIncomeFromMilkOnSpecificDate($milk_deposit_date, $milk_deposit_time);
    public function getMilkDepositsReports($entries = 10, $search = null);
    public function getTotalIncomeFromMilk();
}
