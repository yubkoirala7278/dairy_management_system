<?php

namespace App\Livewire\Frontend\Checkout;

use App\Repositories\Interfaces\ProductRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Checkout extends Component
{
    public $page = 'cart';
    public $sub_page;
    public $user;
    private $productRepository;

    public function boot(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }
    public function mount()
    {
        $this->user = Auth::user();
    }
    public function render()
    {
        $myCarts = $this->productRepository->getCartInfo();
        $sub_total=$this->productRepository->getCartSubtotal();
        return view('livewire.frontend.checkout.checkout',[
            'myCarts'=>$myCarts,
            'sub_total'=>$sub_total
        ]);
    }
}
