<?php

namespace App\Repositories\Interfaces;

interface TransactionRepositoryInterface
{
    public function getUsersTransactionInfo($entries, $keyword);
    public function getMilkDepositIncome($entries, $keyword);
    public function getTotalMilkIncomeWithFilters($keyword, $milk_deposit_date = null);
    public function getMilkDepositIncomeForExport($keyword, $milk_deposit_date = null);
    public function getTotalBalance();
    public function depositTransactions($entries,$keyword);
    public function sumDepositAmount($keyword = null);
    public function withdrawTransactions($entries, $keyword = null, $amount_withdraw_date_ad = null);
    public function sumWithdrawAmount($keyword = null, $amount_withdraw_date_ad = null);
}
