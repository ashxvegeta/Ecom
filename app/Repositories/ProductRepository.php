<?php
namespace App\Repositories;
use App\Models\Product;
use App\Repositories\Contracts\ProductRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;


// step 2: Now we will create a concrete implementation of the ProductRepositoryInterface. This class will contain the actual logic for interacting with the Product model and performing CRUD operations.
class ProductRepository  implements  ProductRepositoryInterface{

   public function getAllProducts(): Collection
   {
       return Product::all();
   }

   public function getProductById(int $id): ?Product
   {
       return Product::find($id);
   }

    public function createProduct(array $data): Product
    {
        $slug = Str::slug($data['name']);

        if (Product::where('slug', $slug)->exists()) {
            $slug = $slug . '-' . time();
        }

        $product = Product::create([
            'name'              => $data['name'],
            'slug'              => $slug,
            'brand_id'          => $data['brand_id'],
            'short_description' => $data['short_description'] ?? null,
            'description'       => $data['description'] ?? null,
            'status'            => $data['status'],
            'featured'          => $data['featured'] ?? 0,
        ]);

        return $product; // ← ADD KARO YAHAN
    }

    
    
    public function updateProduct(Product $product, array $data): Product
{
    $product->update($data);
    return $product; // ← $product return karo, update() ka result nahi
}

    public function deleteProduct(Product $product): void
    {
            $product->delete();
    }
  

}