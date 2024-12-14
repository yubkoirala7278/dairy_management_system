<?php

namespace App\Livewire\Admin\Financial;

use App\Models\FinancialSetup as ModelsFinancialSetup;
use Livewire\Component;

class FinancialSetup extends Component
{
    public $page = 'financial';
    public $fixed_interest_rate,$compound_interest_rate,$tax_deduction_rate,$id;

    public function mount(){
        $setup=ModelsFinancialSetup::latest()->first();
        if($setup){
            $this->fixed_interest_rate=$setup->fixed_interest_rate;
            $this->compound_interest_rate=$setup->compound_interest_rate;
            $this->tax_deduction_rate=$setup->tax_deduction_rate;
        }
    }
    public function render()
    {
        return view('livewire.admin.financial.setup');
    }

    public function register(){
        $this->validate([
            'fixed_interest_rate' => 'required|min:0|numeric',
            'compound_interest_rate' => 'required|min:0|numeric',
            'tax_deduction_rate' => 'required|min:0|numeric',
        ], [
            'fixed_interest_rate.required' => 'स्थिर ब्याज दर अनिवार्य छ।',
            'fixed_interest_rate.min' => 'स्थिर ब्याज दर ० भन्दा कम हुन सक्दैन।',
            'fixed_interest_rate.numeric' => 'स्थिर ब्याज दर संख्यात्मक मान हुनुपर्छ।',
        
            'compound_interest_rate.required' => 'चक्रवृद्धि ब्याज दर अनिवार्य छ।',
            'compound_interest_rate.min' => 'चक्रवृद्धि ब्याज दर ० भन्दा कम हुन सक्दैन।',
            'compound_interest_rate.numeric' => 'चक्रवृद्धि ब्याज दर संख्यात्मक मान हुनुपर्छ।',
        
            'tax_deduction_rate.required' => 'कर कटौती दर अनिवार्य छ।',
            'tax_deduction_rate.min' => 'कर कटौती दर ० भन्दा कम हुन सक्दैन।',
            'tax_deduction_rate.numeric' => 'कर कटौती दर संख्यात्मक मान हुनुपर्छ।',
        ]);
        
        try{
            ModelsFinancialSetup::query()->delete();
            ModelsFinancialSetup::create(
                [
                    'fixed_interest_rate' => $this->fixed_interest_rate,
                    'compound_interest_rate' => $this->compound_interest_rate,
                    'tax_deduction_rate' => $this->tax_deduction_rate,
                ]
            );
    
            // Dispatch a success message
            $this->dispatch('success', title:'डेटा सफलतापूर्वक सुरक्षित भयो।');
        }catch(\Throwable $th){
            $this->dispatch('error',$th->getMessage());
        }
    }
}
