<?php

namespace App\Repositories;

use App\Helpers\NumberHelper;
use App\Models\Product;
use App\Repositories\Interfaces\ProductRepositoryInterface;

class ProductRepository implements ProductRepositoryInterface
{
    public function all($entries, $keyword)
    {
        $query = Product::latest();
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
            $product->product_qty = NumberHelper::toNepaliNumber($product->product_qty);
            
            // Add a custom "count" column in Nepali
            $product->nepali_count = NumberHelper::toNepaliNumber($key + 1); // +1 to start count from 1
            
            return $product;
        });
        return $products;
    }
}
