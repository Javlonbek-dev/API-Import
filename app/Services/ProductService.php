<?php

namespace App\Services;

use App\Interfaces\ProductRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class ProductService
{
    public function __construct(protected ProductRepositoryInterface $productRepository)
    {
    }

    public function getAll():Collection
    {
       return $this->productRepository->getAll();
    }

    public function getId($id)
    {
        $productId = $this->productRepository->getById($id);
        if (is_null($productId)) {
            return response()->json(['message' => 'Product not found'], 404);
        }
        return $productId;
    }

    public function update(int $id, $data)
    {
        return $this->productRepository->update($data, $id);
    }

}
