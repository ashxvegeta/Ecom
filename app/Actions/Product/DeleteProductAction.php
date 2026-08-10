<?php

namespace App\Actions\Product;
use App\Models\Product;
use App\Repositories\Contracts\ProductRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;




class DeleteProductAction
{
   

    public function __construct(ProductRepositoryInterface $repository)
    {
        $this->productRepository = $repository;
    }

    public function execute(Product $product): void
    {
        DB::transaction(function () use ($product) {
        // Images delete
        $imagePaths = $product->productImages()->pluck('image_path')->toArray();
        $product->productImages()->delete();
        Storage::disk('public')->delete($imagePaths);
        $this->productRepository->deleteProduct($product);
        });
        Cache::forget('products.listing');
        Cache::forget('products.featured');
    }

    
}