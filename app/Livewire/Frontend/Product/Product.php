<?php

namespace App\Livewire\Frontend\Product;

use App\Models\User;
use Livewire\WithPagination;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Product extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $page = 'product';
    public $sub_page;
    private $productRepository;
    public $entries = 10;
    public $search = '';
    public $farmer_number, $password;

    // ==========filter=========
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function boot(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function render()
    {
        $products = $this->productRepository->all($this->entries, $this->search);
        return view('livewire.frontend.product.product', [
            'products' => $products
        ]);
    }
    public function addProductToCart($id)
    {
        if (!Auth::user()) {
            $this->dispatch('loginUser');
        }
    }
    public function loginUser()
    {
        // Validate the input fields
        $this->validate([
            'farmer_number' => 'required|string', // farmer_number is required
            'password' => 'required|string', // password is required
        ], [
            'farmer_number.required' => 'कृषक नम्बर अनिवार्य छ।',  // Farmer number is required
            'password.required' => 'पासवर्ड अनिवार्य छ।',
        ]);

        // Try to find the user by farmer_number
        $user = User::where('farmer_number', $this->farmer_number)->first();

        // Check if the user exists and the password is correct
        if ($user && Hash::check($this->password, $user->password)) {
            // Log the user in
            Auth::login($user);
            $this->dispatch('successLogin',title:'तपाईं सफलतापूर्वक लगइन हुनु भएको छ');
        }

        // If login fails, show an error message
        $this->addError('farmer_number', 'प्रदान गरिएको प्रमाणपत्र हाम्रो रेकर्डसँग मिल्दैन');
    }
}
