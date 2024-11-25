<?php

namespace App\Livewire\Frontend\Cart;

use App\Models\Cart as ModelsCart;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Cart extends Component
{
    public $page = 'cart';
    public $sub_page;
    private $productRepository;
    public $cartCounts = [];

    public function boot(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function updatedCartCounts($value, $key)
    {
        if(!$this->cartCounts[$key] || $this->cartCounts[$key]<=0){
            $this->dispatch('priceChanged');
            return;
        }
        // Update the corresponding cart in the database
        ModelsCart::where('id', $key)
            ->where('user_id', auth()->id())
            ->update(['cart_count' => $value]);
            $this->dispatch('priceChanged');
    }

    public function render()
    {
        $myCarts = $this->productRepository->getMyCartProducts();
        $sub_total=$this->productRepository->getCartSubtotal();
        foreach ($myCarts as $cart) {
            $this->cartCounts[$cart->id] = $cart->cart_count;
        }
        return view('livewire.frontend.cart.cart',[
            'myCarts'=>$myCarts,
            'sub_total'=>$sub_total
        ]);
    }

    public function removeFromCart($id)
    {
        ModelsCart::where('id', $id)->where('user_id', Auth::user()->id)->delete();
    }

    public function increaseQuantity($id)
    {
        $cartCount = ModelsCart::where('id', $id)
            ->where('user_id', Auth::user()->id)
            ->value('cart_count');
        ModelsCart::where('id', $id)->update([
            'cart_count' => $cartCount + 1
        ]);
        $this->dispatch('priceChanged');
    }

    public function decreaseQuantity($id)
    {
        $cartCount = ModelsCart::where('id', $id)
            ->where('user_id', Auth::user()->id)
            ->value('cart_count');
        if ($cartCount == 1) {
            $this->dispatch('priceChanged');
            return;
        }
        ModelsCart::where('id', $id)->update([
            'cart_count' => $cartCount - 1
        ]);
        $this->dispatch('priceChanged');
    }
}
