<?php

namespace App\Repositories\Interfaces;

interface TransactionRepositoryInterface
{
    public function getUsersWithTotalDepositsAndWithdraws($entries, $keyword);
    public function getMilkDepositIncome($entries, $keyword);
}
