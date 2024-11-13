<?php

namespace App\Livewire\Frontend\About;

use Livewire\Component;

class About extends Component
{
    public $page = 'about';
    public $sub_page;
    public function render()
    {
        return view('livewire.frontend.about.about');
    }
}
