<?php
namespace App\Repositories\Contracts;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;  


//step1 first we will create an interface that defines the methods that our repository will implement.
// This interface will be used to type-hint the repository in our controllers and services, allowing us to easily swap out implementations if needed.
interface ProductRepositoryInterface
{
    public function getAllProducts(): Collection;
    public function getProductById(int $id): ?Product;
    public function createProduct(array $data): Product;
    public function updateProduct(Product $product, array $data): Product;
    public function deleteProduct(Product $product): void;
    public function getFilteredProducts(array $filters):LengthAwarePaginator;
    public function getProductBySlug(string $slug): ?Product;
    public function getRelatedProducts(Product $product): ?Collection;

    

    
}