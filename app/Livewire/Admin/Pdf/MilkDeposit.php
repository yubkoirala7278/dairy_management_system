<?php

namespace App\Livewire\Admin\Pdf;

use App\Helpers\NumberHelper;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Livewire\Component;

class MilkDeposit extends Component
{
    private $userRepository;
    public $search,$milk_deposit_date,$milk_deposit_time;

    public function boot(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function mount($milk_deposit_date='',$milk_deposit_time='',$search = '')
    {
        $this->milk_deposit_date=$milk_deposit_date;
        $this->milk_deposit_time=$milk_deposit_time;
        $this->search = '';
    }

    public function render()
    {
        $milkDeposits = $this->userRepository->getMilkDeposits(10000, $this->search, $this->milk_deposit_date, $this->milk_deposit_time,null,true);
        $milkInfo = $this->userRepository->getTotalIncomeFromMilkOnSpecificDate($this->milk_deposit_date, $this->milk_deposit_time);
        $totalDepositIncome = NumberHelper::toNepaliNumber($milkInfo['totalDepositIncome']);
        $totalDepositedMilk = NumberHelper::toNepaliNumber($milkInfo['totalDepositedMilk']);
        return view('livewire.admin.pdf.milk-deposit',[
            'milkDeposits'=>$milkDeposits,
            'totalDepositIncome'=>$totalDepositIncome,
            'totalDepositedMilk'=>$totalDepositedMilk
        ]);
    }
}
