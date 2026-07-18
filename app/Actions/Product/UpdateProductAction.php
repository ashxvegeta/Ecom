<?php

namespace App\Actions\Product;
use App\Models\Product;
use App\Repositories\Contracts\ProductRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;




class UpdateProductAction
{
   

    public function __construct(ProductRepositoryInterface $repository)
    {
        $this->productRepository = $repository;
    }

    public function execute(Product $product, array $data, array $images = [], array $categoryIds = []): Product
    {
        return DB::transaction(function () use ($product, $data, $images, $categoryIds) {

           
            $product = $this->productRepository->updateProduct($product, [
                'name'              => $data['name'],
                'brand_id'          => $data['brand_id'],
                'short_description' => $data['short_description'] ?? null,
                'description'       => $data['description'] ?? null,
                'status'            => $data['status'],
                'featured'          => $data['featured'] ?? 0,
            ]);
            // Additional logic for images and categories can be added here
        

             $product->productItems()->first()->update([
                'sku' => $data['sku'],
                'price' => $data['price'],
                'stock' => $data['stock'],
                'status' => 1,
            ]);
            // Categories
            if(!empty($categoryIds)) {
                $product->categories()->sync($categoryIds);
            }

            // Product Images
            if (!empty($images)) {

             // Step 1 — pehle paths variable mein save karo
            $imagepath =  $product->productImages()->pluck('image_path')->toArray();
                //  Step 2 — ab DB se delete karo
                $product->productImages()->delete();

                // Step 3 — ab storage se delete karo
                Storage::disk('public')->delete($imagepath);
                     
                foreach($images as $index => $image){
                      //insert new images
                    $path = $image->store('products', 'public');
                    $product->productImages()->create([
                        'image_path' => $path,
                        'sort_order' => $index + 1,
                    ]);
                }
            }

            return $product;
        });
    }
}