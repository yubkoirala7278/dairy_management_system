<?php

namespace App\Livewire\Admin\Dairy;
use Livewire\WithPagination;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Helpers\NumberHelper;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Livewire\Component;
use Illuminate\Support\Facades\View;

class MilkReport extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    private $userRepository;
    public $page = 'farmer';
    public $entries = 10;
    public $search = '';
    public $sortField = 'created_at';
    public $sortDirection = 'desc';
    public $milk_deposit_date,$milk_deposit_time,$milk_type;

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
    public function render()
    {
        $milkDeposits = $this->userRepository->getMilkDepositsReports($this->entries, $this->search);
        $milkInfo = $this->userRepository->getTotalIncomeFromMilk();
        $totalDepositIncome = NumberHelper::toNepaliNumber($milkInfo['totalDepositIncome']);
        $totalDepositedMilk = NumberHelper::toNepaliNumber($milkInfo['totalDepositedMilk']);
        return view('livewire.admin.dairy.milk-report',[
            'milkDeposits'=>$milkDeposits,
            'totalDepositIncome' => $totalDepositIncome,
            'totalMilkQuantity' => $totalDepositedMilk
        ]);
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
}
