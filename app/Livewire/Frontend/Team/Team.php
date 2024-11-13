<?php

namespace App\Livewire\Frontend\Team;

use Livewire\Component;

class Team extends Component
{
    public $page="pages";
    public $sub_page="team";
    public function render()
    {
        return view('livewire.frontend.team.team');
    }
}
