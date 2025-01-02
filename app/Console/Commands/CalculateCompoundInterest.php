<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Account;
use Carbon\Carbon;

class CalculateCompoundInterest extends Command
{
    protected $signature = 'calculate:interest';
    protected $description = 'Calculate monthly compound interest for all accounts';

    public function handle()
    {
        $accounts = Account::all();
        $today = Carbon::now();

        foreach ($accounts as $account) {
            $lastCompounded = Carbon::parse($account->compounded_on);
            if ($lastCompounded->diffInMonths($today) >= 1) {
                $months = $lastCompounded->diffInMonths($today);
                $principal = $account->balance;
                $rate = $account->interest_rate; // Annual rate
                $n = 12; // Monthly compounding

                // Compound for all pending months
                $amount = $principal * pow((1 + ($rate / $n)), $n * ($months / 12));
                $interest = $amount - $principal;

                // Update account balance and compounded date
                $account->balance += $interest;
                $account->compounded_on = $today;
                $account->save();
            }
        }

        $this->info('Interest calculation completed!');
    }
}
