<?php

namespace App\Livewire\Admin\Financial;

use Livewire\Component;

class Withdraw extends Component
{
    public $page = 'financial';
    public function render()
    {
        return view('livewire.admin.financial.withdraw');
    }
}
