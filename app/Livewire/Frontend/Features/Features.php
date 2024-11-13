<?php

namespace App\Livewire\Frontend\Features;

use Livewire\Component;

class Features extends Component
{
    public $page="pages";
    public $sub_page="feature";
    public function render()
    {
        return view('livewire.frontend.features.features');
    }
}
