<?php

namespace App\Livewire\Admin\Product;

use App\Models\Product as ModelsProduct;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

use Livewire\Component;

class Product extends Component
{
    use WithFileUploads;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    private $productRepository;
    public $page = 'product';
    public $entries = 10;
    public $search = '';

    public $name, $price_per_kg, $status = 1, $image, $product_id;

    // ========reset fields=========
    public function resetFields()
    {
        $this->reset([
            'name',
            'price_per_kg',
            'status',
            'image',
            'product_id'
        ]);
        $this->resetErrorBag();
    }

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
        return view('livewire.admin.product.product', [
            'products' => $products
        ]);
    }

    // ==========create product==============
    public function createProduct()
    {
        // Validate the form inputs
        $this->validate([
            'name' => ['required'],
            'price_per_kg' => ['required'],
            'status' => ['required'],
            'image' => 'required|max:2024|mimes:png,jpg,jpeg,webp',
        ], [
            'name.required' => 'प्रोडक्टको नाम आवश्यक छ',
            'price_per_kg.required' => 'प्रति किलो मूल्य आवश्यक छ',
            'status.required' => 'स्थिति चयन गर्नुहोस्',
            'image.required' => 'प्रोडक्टको फोटो आवश्यक छ',
            'image.image' => 'कृपया एक मान्य फोटो अपलोड गर्नुहोस्',
            'image.mimes' => 'केवल jpeg, png, jpg, र webp प्रकारका फोटो मात्र स्वीकार्य छन्',
            'image.max' => 'फोटोको आकार 200KB भन्दा सानो हुनु पर्छ',
        ]);

        // Try to store the product and handle any exceptions
        try {
            // Store the image in 'storage/app/public/product' directory
            $imagePath = $this->image->store('product', 'public'); // Use the public disk

            // Create the product
            ModelsProduct::create([
                'name' => $this->name,
                'price_per_kg' => $this->price_per_kg,
                'status' => $this->status,
                'image' => $imagePath, // Store the path of the uploaded image
            ]);

            // Optional: You can dispatch a success event or handle success
            $this->dispatch('success', title: 'प्रोडक्ट सफलतापूर्वक थपियो');
            $this->resetFields();
        } catch (\Throwable $th) {
            // If there's any error, dispatch an error message
            $this->dispatch('error', title: $th->getMessage());
        }
    }

    // ========delete product=========
    public function delete($id)
    {
        try {
            // Retrieve the product from the database
            $product = ModelsProduct::find($id);

            if ($product) {
                // Get the image path from the product
                $imagePath = $product->image;

                // Check if the image exists and delete it
                if (file_exists(storage_path('app/public/' . $imagePath))) {
                    unlink(storage_path('app/public/' . $imagePath));
                }

                // Delete the product record from the database
                $product->delete();
                $this->dispatch('success', title: 'डाटा मेटाइएको छ।');
            }
        } catch (\Throwable $th) {
            // If there's any error, dispatch an error message
            $this->dispatch('error', title: $th->getMessage());
        }
    }

    // =======edit product===========
    public function edit($id)
    {
        try {
            $product = ModelsProduct::find($id);
            $this->product_id = $id;
            $this->name = $product->name;
            $this->price_per_kg = $product->price_per_kg;
            $this->status = $product->status;
            $this->dispatch('editModal');
        } catch (\Throwable $th) {
            // If there's any error, dispatch an error message
            $this->dispatch('error', title: $th->getMessage());
        }
    }
    public function updateProduct()
    {
        try {
            // Retrieve the product from the database
            $product = ModelsProduct::findOrFail($this->product_id);

            // Validate the incoming request data
            $this->validate([
                'name' => ['required'],
                'price_per_kg' => ['required'],
                'status' => ['required'],
                'image' => 'nullable|max:2024|mimes:png,jpg,jpeg,webp',
            ], [
                'name.required' => 'प्रोडक्टको नाम आवश्यक छ',
                'price_per_kg.required' => 'प्रति किलो मूल्य आवश्यक छ',
                'status.required' => 'स्थिति चयन गर्नुहोस्',
                'image.image' => 'कृपया एक मान्य फोटो अपलोड गर्नुहोस्',
                'image.mimes' => 'केवल jpeg, png, jpg, र webp प्रकारका फोटो मात्र स्वीकार्य छन्',
                'image.max' => 'फोटोको आकार 200KB भन्दा सानो हुनु पर्छ',
            ]);

            // If a new image is uploaded, delete the old one and store the new one
            if ($this->image) {
                // Delete the old image from storage
                if ($product->image && file_exists(storage_path('app/public/' . $product->image))) {
                    unlink(storage_path('app/public/' . $product->image));
                }

                // Store the new image
                $imagePath = $this->image->store('product', 'public');
            } else {
                // If no new image is uploaded, retain the old image path
                $imagePath = $product->image;
            }

            // Update the product data in the database
            $product->update([
                'name' => $this->name,
                'price_per_kg' => $this->price_per_kg,
                'status' => $this->status,
                'image' => $imagePath, // Store the path of the uploaded or existing image
            ]);

            // Dispatch success event or message
            $this->dispatch('success', title: 'प्रोडक्ट सफलतापूर्वक अपडेट गरियो');
            $this->resetFields();
        } catch (\Throwable $th) {
            // Dispatch error if any exception occurs
            $this->dispatch('error', title: $th->getMessage());
        }
    }
}
