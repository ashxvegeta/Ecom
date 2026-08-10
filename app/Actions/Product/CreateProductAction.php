<?php

namespace App\Actions\Product;
use App\Repositories\Contracts\ProductRepositoryInterface;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use Illuminate\Support\Facades\Cache;
// 4. Finally, we will create a service class that will use the ProductRepository to perform the actual business logic for creating a product. This class will be responsible for handling any additional logic that is needed when creating a product, such as generating a unique slug, handling images, and attaching categories.
class CreateProductAction
{
   

    public function __construct(ProductRepositoryInterface $repository)
    {
        $this->productRepository = $repository;
    }

    public function execute(array $data,array $images = [],array $categoryIds  = []): Product
    {
        return DB::transaction(function () use ($data, $images, $categoryIds) {

           
            $product = $this->productRepository->createProduct($data);
            // Additional logic for images and categories can be added here
            $product->productItems()->create([
                'sku' => $data['sku'],
                'price' => $data['price'],
                'stock' => $data['stock'],
                'status' => 1,
            ]);
            // categories attachment
            if (!empty($categoryIds)) {
                $product->categories()->attach($categoryIds);
            }
            // image save
            if (!empty($images)) {
                foreach ($images as $index => $image) {
                    $path = $image->store('products', 'public');
                    $product->productImages()->create([
                        'image_path' => $path,
                        'sort_order' => $index + 1,
                    ]);
                }
            }
            return $product;
        });
        Cache::forget('products.listing');
        Cache::forget('products.featured');
    }
}