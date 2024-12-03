<?php

namespace App\Livewire\Frontend\Profile;

use Livewire\Component;

class Profile extends Component
{
    public $page = 'profile';
    public $sub_page;
    public function render()
    {
        return view('livewire.frontend.profile.profile');
    }
}
