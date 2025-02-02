<?php

namespace App\Repositories\Interfaces;

interface TransactionRepositoryInterface
{
    public function getUsersTransactionInfo($entries, $keyword);
    public function getMilkDepositIncome($entries, $keyword);
    public function getTotalMilkIncomeWithFilters($keyword, $milk_deposit_date = null);
    public function getMilkDepositIncomeForExport($keyword, $milk_deposit_date = null);
    public function getTotalBalance();
}
