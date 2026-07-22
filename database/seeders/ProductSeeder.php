<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // Brands
       $apple    = Brand::firstOrCreate(['name' => 'Apple'],    ['status' => 1]);
$samsung  = Brand::firstOrCreate(['name' => 'Samsung'],  ['status' => 1]);
$dell     = Brand::firstOrCreate(['name' => 'Dell'],     ['status' => 1]);
$hp       = Brand::firstOrCreate(['name' => 'HP'],       ['status' => 1]);
$logitech = Brand::firstOrCreate(['name' => 'Logitech'], ['status' => 1]);

        // Categories
    $mobiles     = Category::firstOrCreate(['slug' => 'mobiles'],     ['name' => 'Mobiles',     'status' => 1]);
$laptops     = Category::firstOrCreate(['slug' => 'laptops'],     ['name' => 'Laptops',     'status' => 1]);
$monitors    = Category::firstOrCreate(['slug' => 'monitors'],    ['name' => 'Monitors',    'status' => 1]);
$keyboards   = Category::firstOrCreate(['slug' => 'keyboards'],   ['name' => 'Keyboards',   'status' => 1]);
$accessories = Category::firstOrCreate(['slug' => 'accessories'], ['name' => 'Accessories', 'status' => 1]);



        // Products
        $products = [
            ['name' => 'iPhone 16 Pro',     'brand' => $apple,    'category' => $mobiles,     'price' => 129999, 'stock' => 50,  'sku' => 'APL-IPH16PRO',  'featured' => 1],
            ['name' => 'iPhone 15',         'brand' => $apple,    'category' => $mobiles,     'price' => 79999,  'stock' => 30,  'sku' => 'APL-IPH15',     'featured' => 0],
            ['name' => 'Samsung Galaxy S24','brand' => $samsung,  'category' => $mobiles,     'price' => 89999,  'stock' => 40,  'sku' => 'SAM-S24',       'featured' => 1],
            ['name' => 'Dell Inspiron 15',  'brand' => $dell,     'category' => $laptops,     'price' => 65999,  'stock' => 20,  'sku' => 'DEL-INS15',     'featured' => 1],
            ['name' => 'HP Victus 16',      'brand' => $hp,       'category' => $laptops,     'price' => 72999,  'stock' => 15,  'sku' => 'HP-VIC16',      'featured' => 0],
            ['name' => 'Dell 27" Monitor',  'brand' => $dell,     'category' => $monitors,    'price' => 28999,  'stock' => 25,  'sku' => 'DEL-MON27',     'featured' => 1],
            ['name' => 'Logitech MX Keys',  'brand' => $logitech, 'category' => $keyboards,   'price' => 8999,   'stock' => 60,  'sku' => 'LOG-MXKEYS',    'featured' => 0],
            ['name' => 'Samsung Earbuds',   'brand' => $samsung,  'category' => $accessories, 'price' => 12999,  'stock' => 45,  'sku' => 'SAM-EARBUDS',   'featured' => 1],
        ];

       foreach ($products as $item) {
    $product = Product::firstOrCreate(
        ['slug' => \Illuminate\Support\Str::slug($item['name'])],
        [
            'name'     => $item['name'],
            'brand_id' => $item['brand']->id,
            'status'   => 1,
            'featured' => $item['featured'],
        ]
    );

    // Category attach — sync use karo duplicate avoid karne ke liye
    $product->categories()->sync([$item['category']->id]);

    // ProductItem — firstOrCreate
    $product->productItems()->firstOrCreate(
        ['sku' => $item['sku']],
        [
            'price'  => $item['price'],
            'stock'  => $item['stock'],
            'status' => 1,
        ]
    );
}
    }
}