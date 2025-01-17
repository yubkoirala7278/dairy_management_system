<?php

namespace App\Repositories\Interfaces;

interface TransactionRepositoryInterface
{
    public function getUsersTransactionInfo($entries, $keyword);
    public function getMilkDepositIncome($entries, $keyword);
    public function getTotalMilkIncomeWithFilters($search = null);
}
