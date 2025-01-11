<?php

namespace App\Livewire\Admin\Dairy;

use App\Helpers\NumberHelper;
use App\Models\Account;
use App\Models\Deposit;
use App\Models\InterestRate;
use App\Models\MilkIncome;
use App\Models\Transaction;
use App\Repositories\Interfaces\TransactionRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Accounting extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $page = 'farmer';
    public $search = '';
    private $transactionRepository;
    public $entries = 10;
    public $incomes = [];
    public $selectAll = false;

    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function updatedEntries()
    {
        $this->resetPage();
    }
    public function boot(TransactionRepositoryInterface $transactionRepository)
    {
        $this->transactionRepository = $transactionRepository;
    }
    public function render()
    {
        $milkDepositsIncome = $this->transactionRepository->getMilkDepositIncome($this->entries, $this->search);
        $totals = MilkIncome::withSum('milkDeposits', 'milk_quantity')
            ->withSum('milkDeposits', 'milk_total_price')
            ->get();

        $totalMilkQuantity = NumberHelper::toNepaliNumber($totals->sum('milk_deposits_sum_milk_quantity'));
        $totalMilkTotalPrice = NumberHelper::toNepaliNumber($totals->sum('milk_deposits_sum_milk_total_price'));
        return view('livewire.admin.dairy.accounting', [
            'milkDepositsIncome' => $milkDepositsIncome,
            'totalMilkQuantity' => $totalMilkQuantity,
            'totalMilkTotalPrice' => $totalMilkTotalPrice
        ]);
    }

    public function depositMilkIncome()
    {
        try {
            if (!$this->incomes) {
                $this->dispatch('warningMessage', title: 'कृपया कम्तिमा एक जना कृषकको दूध डिपोजिट आय छान्नुहोस्।');
                return;
            }
            $this->dispatch('warning', title: "के तपाईं चयनित किसानहरूको पैसा जम्मा गर्न चाहनुहुन्छ?");
        } catch (\Throwable $th) {
            $this->dispatch('error', title: $th->getMessage());
        }
    }
    public function confirmDepositMilkIncome()
    {
        DB::beginTransaction(); // Begin the transaction
    
        try {
            // Check if any incomes are selected
            if (count($this->incomes) > 0) {
                // Get the milk incomes for the selected IDs
                $milkIncomes = MilkIncome::whereIn('id', $this->incomes)->get();
    
                // Prepare an array for bulk insert into Deposit table
                $deposits = $milkIncomes->map(function ($income) {
                    return [
                        'user_id' => $income->user_id,
                        'deposit' => $income->deposit,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                })->toArray();
    
                foreach ($deposits as $key => $deposit) {
                    // Find the user's account or create one if it doesn't exist
                    $account = Account::firstOrCreate(
                        ['user_id' => $deposit['user_id']],
                        ['balance' => 0]
                    );
    
                    // Update account balance
                    $account->increment('balance', $deposit['deposit']);
    
                    // Record transaction
                    Transaction::create([
                        'account_id' => $account->id,
                        'type' => 'deposit',
                        'amount' => $deposit['deposit'],
                    ]);
                }
    
                // Delete the selected milk incomes
                MilkIncome::whereIn('id', $this->incomes)->delete();
    
                DB::commit(); // Commit the transaction
    
                // Dispatch success message
                $this->dispatch('success', title: 'चयनित किसानहरूको पैसा सफलतापूर्वक जम्मा गरिएको छ।');
    
                // Reset the incomes array
                $this->reset('incomes');
                $this->resetPage();
            } else {
                // If no incomes are selected, dispatch a warning
                $this->dispatch('warning', title: 'कृपया किसान चयन गर्नुहोस्।');
            }
        } catch (\Throwable $th) {
            DB::rollBack(); // Rollback in case of an error
            // Dispatch error message
            $this->dispatch('error', title: $th->getMessage());
        }
    }

    public function updatedSelectAll()
    {
        if ($this->selectAll) {
            $this->incomes = MilkIncome::pluck('id')->toArray();
        } else {
            $this->incomes = [];
        }
    }
}
