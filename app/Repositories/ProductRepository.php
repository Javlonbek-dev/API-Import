<?php

namespace App\Repositories;

use App\Interfaces\ProductRepositoryInterface;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

class ProductRepository implements ProductRepositoryInterface
{

    public function getAll(): Collection
    {
        return Product::all();
    }
    public function getById($id)
    {
        return Product::find($id);
    }

    public function create(array $data)
    {
        return Product::create($data);
    }

    public function update(array $data, int $id)
    {
        $product = Product::findOrFail($id);
        $product->update($data);
        return $product;
    }
    public function delete(int $id)
    {
        $product = Product::findOrFail($id);
        return $product->delete();
    }
}
