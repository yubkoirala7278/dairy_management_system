<?php

namespace App\Repositories;

use App\Helpers\NumberHelper;
use App\Models\Cart;
use App\Models\Product;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductRepository implements ProductRepositoryInterface
{
    public function all($entries, $keyword, $status = null)
    {
        if ($status) {
            $query = Product::where('status', $status)->latest();
        } else {
            $query = Product::latest();
        }

        // Apply keyword filter
        if ($keyword) {
            $query->where(function ($q) use ($keyword) {
                $q->where('name', 'like', '%' . $keyword . '%');
            });
        }

        // Limit results per page
        $products = $query->paginate($entries);
        $products->getCollection()->transform(function ($product, $key) {
            // Convert numbers to Nepali
            $product->price_per_kg = NumberHelper::toNepaliNumber($product->price_per_kg);

            // Add a custom "count" column in Nepali
            $product->nepali_count = NumberHelper::toNepaliNumber($key + 1); // +1 to start count from 1

            return $product;
        });
        return $products;
    }

    public function getMyCartProducts()
    {
        $carts = Cart::with('product')->where('user_id',Auth::user()->id)->latest()->get();
    
        $carts->transform(function ($cart) {
            // Convert price_per_kg to Nepali number
            if (isset($cart->product)) {
                $cart->product->price_per_kg_nepali = NumberHelper::toNepaliNumber($cart->product->price_per_kg);
            }
            return $cart;
        });
    
        return $carts;
    }

    public function getCartSubtotal()
    {
        $userId = Auth::id(); // Get the authenticated user's ID
    
        // Query to get the subtotal
        $subTotal = Cart::where('user_id', $userId)
            ->join('products', 'carts.product_id', '=', 'products.id')
            ->sum(DB::raw('carts.cart_count * products.price_per_kg'));

            $subTotal = NumberHelper::toNepaliNumber($subTotal);
    
        return $subTotal;
    }

    public function getCartInfo() {
        $myCarts = Cart::with('product')
            ->where('user_id', Auth::user()->id)
            ->latest()
            ->get();
    
        // Modify the collection to add Nepali number format for 'cart_count'
        $myCarts->transform(function ($cart) {
            // Convert price_per_kg to Nepali number
            $cart->cart_count_nepali = NumberHelper::toNepaliNumber($cart->cart_count);
            return $cart;
        });
    
        return $myCarts; // Return the modified collection
    }
    
    
}
