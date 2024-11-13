<?php

namespace App\Livewire\Frontend\Product;

use Livewire\Component;

class Product extends Component
{
    public $page = 'product';
    public $sub_page;
    public function render()
    {
        return view('livewire.frontend.product.product');
    }
}
