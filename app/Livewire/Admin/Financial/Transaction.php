<?php

namespace App\Livewire\Admin\Financial;

use App\Helpers\NumberHelper;
use App\Models\Account;
use App\Models\User;
use App\Models\Withdraw;
use App\Repositories\Interfaces\TransactionRepositoryInterface;
use Livewire\Component;
use Livewire\WithPagination;

class Transaction extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    private $transactionRepository;
    public $page = 'financial';
    public $entries = 10;
    public $search = '';
    public $deposit_amount;
    public $withdraw_amount;
    public $user_id;
    public $owner_name = '';
    public $available_balance = '';

    public function boot(TransactionRepositoryInterface $transactionRepository)
    {
        $this->transactionRepository = $transactionRepository;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function resetFields()
    {
        $this->reset('deposit_amount', 'user_id', 'owner_name', 'withdraw_amount', 'available_balance');
        $this->resetErrorBag();
    }


    public function render()
    {
        $usersWithTransaction = $this->transactionRepository->getUsersTransactionInfo($this->entries, $this->search);
        return view('livewire.admin.financial.transaction', [
            'usersWithTransaction' => $usersWithTransaction
        ]);
    }

    // ======get user info========
    public function getUserInfo($id, $available_balance = null)
    {
        try {
            $user = User::find($id);
            if (!$user) {
                $this->dispatch('error', title: 'यो कृषक नम्बर हाम्रो डाटाबेसमा भेटिएन');
                return;
            }
            if ($available_balance) {
                $this->available_balance = $available_balance;
            }
            $this->user_id = $user->id;
            $this->owner_name = $user->owner_name;
        } catch (\Throwable $th) {
            $this->dispatch('error', $th->getMessage());
        }
    }

    // =======deposit===========
    public function checkDepositInfo()
    {
        $this->validate([
            'deposit_amount' => 'required|min:1|numeric',
        ], [
            'deposit_amount.required' => 'कृपया जम्मा गर्ने रकम प्रविष्ट गर्नुहोस्।',
            'deposit_amount.min' => 'रकम कम्तीमा १ हुनुपर्छ।',
            'deposit_amount.numeric' => 'कृपया मात्र अङ्कको मान्य रकम प्रविष्ट गर्नुहोस्।',
        ]);


        try {
            $deposit_amount = NumberHelper::toNepaliNumber($this->deposit_amount);
            $this->dispatch('warningForDeposit', title: "के तपाईं रु {$deposit_amount} किसानको खाता मा जम्मा गर्न निश्चित हुनुहुन्छ?");
            return;
        } catch (\Throwable $th) {
            $this->dispatch('error', $th->getMessage());
        }
    }
    public function confirmDeposit()
    {
        try {
            // Find the user's account or create one if it doesn't exist
            $account = Account::firstOrCreate(
                ['user_id' => $this->user_id],
                ['balance' => 0, 'interest_rate' => 0.04] // Default interest rate
            );

            // Update the account balance
            $account->balance += $this->deposit_amount;
            $account->save();

            // Log the transaction
            Transaction::create([
                'user_id' => $this->user_id,
                'transaction_type' => 'deposit',
                'amount' => $this->deposit_amount,
                'balance_after' => $account->balance,
                'transaction_date' => now(),
            ]);
            $deposit_amount = NumberHelper::toNepaliNumber($this->deposit_amount);
            $this->dispatch('success', title: "रु {$deposit_amount} किसानको खातामा सफलतापूर्वक जम्मा गरिएको छ।");
            $this->resetFields();
        } catch (\Throwable $th) {
            $this->dispatch('error', $th->getMessage());
        }
    }

    // ======withdraw==========
    public function checkWithdrawInfo()
    {
        $available_balance = NumberHelper::toNepaliNumber($this->available_balance);
        $this->validate([
            'withdraw_amount' => 'required|min:1|numeric|max:' . $this->available_balance,
        ], [
            'withdraw_amount.required' => 'कृपया रकम प्रविष्ट गर्नुहोस्।',
            'withdraw_amount.min' => 'रकम कम्तीमा १ रुपैयाँ हुनुपर्छ।',
            'withdraw_amount.numeric' => 'कृपया मात्र अङ्क (संख्यात्मक) रकम प्रविष्ट गर्नुहोस्।',
            'withdraw_amount.max' => 'अधिकतम निकासी रकम ' . $available_balance . ' रुपैयाँ मात्र गर्न सकिन्छ।',
        ]);
        try {
            $withdraw_amount = NumberHelper::toNepaliNumber($this->withdraw_amount);
            $this->dispatch('warningForWithdraw', title: "के तपाईं रु {$withdraw_amount} किसानको खाता बाट निकाल्न निश्चित हुनुहुन्छ?");
            return;
        } catch (\Throwable $th) {
            $this->dispatch('error', $th->getMessage());
        }
    }

    public function confirmWithdraw()
    {
        try {
            // Find the user's account
            $account = Account::where('user_id', $this->user_id)->first();

            if (!$account) {
                $this->dispatch('error', title:'Account not found');
                return;
            }

            // Check if the user has sufficient balance
            if ($account->balance < $this->withdraw_amount) {
                $this->dispatch('error', title:'Insufficient balance');
                return;
            }

            // Update the account balance
            $account->balance -= $this->withdraw_amount;
            $account->save();

            // Log the transaction
            Transaction::create([
                'user_id' => $this->user_id,
                'transaction_type' => 'withdraw',
                'amount' => $this->withdraw_amount,
                'balance_after' => $account->balance,
                'transaction_date' => now(),
            ]);
            $withdraw_amount = NumberHelper::toNepaliNumber($this->withdraw_amount);
            $this->dispatch('success', title: "रु {$withdraw_amount} किसानको खाताबाट सफलतापूर्वक झिकिएको छ।");
            $this->resetFields();
        } catch (\Throwable $th) {
            $this->dispatch('error', title:$th->getMessage());
        }
    }
}
