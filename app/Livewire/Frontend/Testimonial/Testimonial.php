<?php

namespace App\Livewire\Frontend\Testimonial;

use Livewire\Component;

class Testimonial extends Component
{
    public $page="pages";
    public $sub_page="testimonial";
    public function render()
    {
        return view('livewire.frontend.testimonial.testimonial');
    }
}
