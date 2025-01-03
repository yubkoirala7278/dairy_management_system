<?php

namespace App\Livewire\Admin\Dairy;

use App\Models\MilkDeposit as ModelsMilkDeposit;
use App\Models\Setup;
use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Livewire\WithPagination;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\View;
use App\Helpers\NumberHelper;
use App\Exports\MilkDepositsExport;
use App\Models\Deposit;
use App\Models\MilkIncome;
use Maatwebsite\Excel\Facades\Excel;
use Livewire\Component;

class MilkDeposit extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    private $userRepository;
    public $page = 'farmer';
    public $farmernumber;
    public $owner_name,
        $location,
        $phone_number,
        $milk_fat = 0,
        $milk_snf = 0,
        $milkQuantity,
        $per_litre_commission = 0,
        $per_litre_price,
        $milk_type = 'मिश्रित',
        $gov_snf,
        $gov_fat,
        $total_milk_price,
        $milk_deposit_date,
        $milk_deposit_time = 'बिहान';
    public $entries = 10;
    public $search = '';
    public $sortField = 'created_at';
    public $sortDirection = 'desc';
    public $milk_deposit_id;
    public $user_id;

    public function resetFields()
    {
        $this->reset([
            'farmernumber',
            'per_litre_commission',
            'milkQuantity',
            'milk_fat',
            'milk_snf',
            'milk_deposit_id',
            'user_id'
        ]);
        $this->resetErrorBag();
    }

    // ==========filter=========
    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }
    public function updatingSearch()
    {
        $this->resetPage();
    }



    public function boot(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function mount()
    {
        $setup = Setup::latest()->first(['gov_snf', 'gov_fat']);
        $this->gov_snf = $setup->gov_snf;
        $this->gov_fat = $setup->gov_fat;
    }
    public function milkPriceUpdation()
    {
        $this->per_litre_price = round(((float)$this->milk_snf * $this->gov_snf) + ((float)$this->milk_fat * $this->gov_fat), 4) + (float)$this->per_litre_commission;
        $this->total_milk_price = round((float)$this->milkQuantity * $this->per_litre_price, 4);
    }
    public function updatedMilkFat()
    {
        $this->milkPriceUpdation();
    }
    public function updatedMilkSnf()
    {
        $this->milkPriceUpdation();
    }
    public function updatedPerLitreCommission()
    {
        $this->milkPriceUpdation();
    }
    public function updatedFarmernumber()
    {
        $user = User::where('farmer_number', $this->farmernumber)->first();
        if (!$user) {
            $this->reset(['owner_name', 'location', 'phone_number']);
            return;
        }
        $this->owner_name = $user->owner_name;
        $this->location = $user->location;
        $this->phone_number = $user->phone_number;
        $this->milk_fat = $user->milk_fat ?? 0;
        $this->milk_snf = $user->milk_snf ?? 0;
        $this->per_litre_price = round(($this->milk_snf * $this->gov_snf) + ($this->milk_fat * $this->gov_fat), 4);
    }
    public function updatedMilkQuantity()
    {
        $this->total_milk_price = round((float)$this->milkQuantity * $this->per_litre_price, 4);
    }
    public function render()
    {
        $milkDeposits = $this->userRepository->getMilkDeposits($this->entries, $this->search, $this->sortField, $this->sortDirection, $this->milk_deposit_date, $this->milk_deposit_time, $this->milk_type);
        $milkInfo = $this->userRepository->getTotalIncomeFromMilkOnSpecificDate($this->milk_deposit_date, $this->milk_deposit_time);
        $totalDepositIncome = NumberHelper::toNepaliNumber($milkInfo['totalDepositIncome']);
        $totalDepositedMilk = NumberHelper::toNepaliNumber($milkInfo['totalDepositedMilk']);
        return view('livewire.admin.dairy.milk-deposit', [
            'milkDeposits' => $milkDeposits,
            'totalDepositIncome' => $totalDepositIncome,
            'totalMilkQuantity' => $totalDepositedMilk
        ]);
    }

    protected $rules = [
        'farmernumber' => 'required',
        'milkQuantity' => 'required',
        'milk_fat' => 'required|min:1|numeric',
        'milk_snf' => 'required|min:1|numeric',
        'per_litre_commission' => 'nullable|numeric',
        'per_litre_price' => 'required|numeric',
        'milk_deposit_date'=>'required'
    ];

    protected $messages = [
        'farmernumber.required' => 'कृषक नम्बर आवश्यक छ।',
        'milkQuantity.required' => 'दूधको मात्रा आवश्यक छ।',
        'milk_fat.required' => 'दूधको फ्याट आवश्यक छ।',
        'milk_fat.min' => 'दूधको फ्याट कम्तिमा १ हुनु पर्छ।',
        'milk_fat.numeric' => 'दूधको फ्याट संख्यामा हुनुपर्छ।',
        'milk_snf.required' => 'दूधको एस.एन.एफ आवश्यक छ।',
        'milk_snf.min' => 'दूधको एस.एन.एफ कम्तिमा १ हुनु पर्छ।',
        'milk_snf.numeric' => 'दूधको एस.एन.एफ संख्यामा हुनुपर्छ।',
        'per_litre_commission.nullable' => 'प्रति लिटर कमिशन आवश्यक छैन।',
        'per_litre_commission.numeric' => 'प्रति लिटर कमिशन संख्यामा हुनुपर्छ।',
        'per_litre_price.required' => 'प्रति लिटर रकम आवश्यक छ।',
        'per_litre_price.numeric' => 'प्रति लिटर रकम संख्यामा हुनुपर्छ।',
       'milk_deposit_date.required' => 'दूध सङ्कलन मिति आवश्यक छ।',
    ];


    public function register()
    {
        $this->validate();
        $user = User::where('farmer_number', $this->farmernumber)->first();
        if (!$user) {
            $this->dispatch('warningMessage', title: "कृषक नम्बर {$this->farmernumber} दर्ता भएको छैन।");
            $this->resetFields();
            return;
        }
        if ($this->milk_deposit_id) {
            $this->user_id = $user->id;
            $this->update();
            return;
        }
        try {
            $milkDeposit = ModelsMilkDeposit::where('user_id', $user->id)->where('milk_deposit_date', $this->milk_deposit_date)->where('milk_deposit_time', $this->milk_deposit_time)->first();
            if ($milkDeposit) {
                $this->dispatch('warningMessage', title: 'यो दूधको अभिलेख पहिले नै राखिएको छ।');
                $this->resetFields();
                return;
            }
            $user->update([
                'milk_fat' => $this->milk_fat,
                'milk_snf' => $this->milk_snf
            ]);
            $milk_deposit=ModelsMilkDeposit::create([
                'user_id' => $user->id,
                'milk_quantity' => $this->milkQuantity,
                'milk_fat' => $this->milk_fat,
                'milk_snf' => $this->milk_snf,
                'milk_price_per_ltr' => $this->per_litre_price,
                'per_ltr_commission' => $this->per_litre_commission,
                'milk_per_ltr_price_with_commission' => $this->per_litre_price + $this->per_litre_commission,
                'milk_total_price' => $this->total_milk_price,
                'milk_deposit_date' => $this->milk_deposit_date,
                'milk_deposit_time' => $this->milk_deposit_time,
                'milk_type' => $this->milk_type
            ]);
            MilkIncome::create([
                'user_id'=>$user->id,
                'deposit'=>$this->total_milk_price,
                'milk_deposits_id'=>$milk_deposit->id
            ]);
            $this->resetFields();
            $this->dispatch('success', title: 'डेटा सफलतापूर्वक सुरक्षित भयो।');
        } catch (\Throwable $th) {
            $this->dispatch('error', title: $th->getMessage());
        }
    }

    public function exportMilkDepositsToPdf()
    {
        // Fetch milk deposit records based on filters
        $milkDeposits = $this->userRepository->getMilkDeposits(
            $this->entries,
            $this->search,
            $this->sortField,
            $this->sortDirection,
            $this->milk_deposit_date,
            $this->milk_deposit_time,
            $this->milk_type,
            true
        );

        // Generate PDF view with encoding for Nepali language support
        $view = view::make('exports.milk_deposits_pdf', [
            'milkDeposits' => $milkDeposits
        ])->render();

        // Convert entire view content to UTF-8 HTML entities
        $encodedView = mb_convert_encoding($view, 'HTML-ENTITIES', 'UTF-8');

        // Load HTML content into PDF
        $pdf = PDF::loadHtml($encodedView);

        // Download the PDF
        return response()->streamDownload(fn() => print($pdf->output()), 'milk_deposits.pdf');
    }

    public function exportToExcel()
    {
        return Excel::download(new MilkDepositsExport, 'milk_deposits.xlsx');
    }

    // ============update===================

    public function edit($id)
    {
        try {
            $deposit = ModelsMilkDeposit::with('user')->find($id);
            $this->milkQuantity = $deposit->milk_quantity;
            $this->milk_fat = $deposit->milk_fat;
            $this->milk_snf = $deposit->milk_snf;
            $this->per_litre_price = $deposit->milk_price_per_ltr;
            $this->per_litre_commission = $deposit->per_ltr_commission;
            $this->total_milk_price = $deposit->milk_total_price;
            $this->milk_deposit_date = $deposit->milk_deposit_date;
            $this->milk_deposit_time = $deposit->milk_deposit_time;
            $this->milk_type = $deposit->milk_type;
            $this->farmernumber = $deposit->user->farmer_number;
            $this->owner_name = $deposit->user->owner_name;
            $this->location = $deposit->user->location;
            $this->phone_number = $deposit->user->phone_number;
            $this->milk_deposit_id = $id;

        } catch (\Throwable $th) {
            $this->dispatch('error', title: $th->getMessage());
        }
    }
    public function update()
    {
        $milkDeposit = ModelsMilkDeposit::where('user_id', $this->user_id)->where('milk_deposit_date', $this->milk_deposit_date)->where('milk_deposit_time', $this->milk_deposit_time)->first();
        if ($milkDeposit && $milkDeposit->id != $this->milk_deposit_id) {
            $this->dispatch('warningMessage', title: 'यो दूधको अभिलेख पहिले नै राखिएको छ।');
            $this->resetFields();
            return;
        }
        $this->dispatch('warning');
    }
    public function confirmUpdate()
    {
        try {
            $milkDeposit = ModelsMilkDeposit::where('id', $this->milk_deposit_id)->first();
            $milkDeposit->update([
                'user_id' => $this->user_id,
                'milk_quantity' => $this->milkQuantity,
                'milk_fat' => $this->milk_fat,
                'milk_snf' => $this->milk_snf,
                'milk_price_per_ltr' => $this->per_litre_price,
                'per_ltr_commission' => $this->per_litre_commission,
                'milk_per_ltr_price_with_commission' => $this->per_litre_price + $this->per_litre_commission,
                'milk_total_price' => $this->total_milk_price,
                'milk_deposit_date' => $this->milk_deposit_date,
                'milk_deposit_time' => $this->milk_deposit_time,
                'milk_type' => $this->milk_type
            ]);
            $deposit=MilkIncome::where('milk_deposits_id',$milkDeposit->id)->first();
            $deposit->update([
                'user_id'=>$this->user_id,
                'deposit'=>$this->total_milk_price,
                'milk_deposits_id'=>$milkDeposit->id
            ]);
            $this->resetFields();
            $this->dispatch('success', title: 'डेटा सफलतापूर्वक सुरक्षित भयो।');
        } catch (\Throwable $th) {
            $this->dispatch('error', title: $th->getMessage());
        }
    }

    // =========delete milk deposits=======
    public function delete($id)
    {
        try {
            $milkDeposit = ModelsMilkDeposit::where('id', $id)->first();
            if (!$milkDeposit) {
                $this->dispatch('warningMessage', title: "कृषक नम्बर {$this->farmernumber} दर्ता भएको छैन।");
                return;
            }
            $deposit=MilkIncome::where('milk_deposits_id',$milkDeposit->id)->first();
            $deposit->delete();
            $milkDeposit->delete();
            $this->dispatch('success', title: 'डाटा मेटाइएको छ।');
        } catch (\Throwable $th) {
            $this->dispatch('error', title: $th->getMessage());
        }
    }
}
