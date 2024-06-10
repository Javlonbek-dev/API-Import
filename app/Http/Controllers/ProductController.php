<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductStoreRequest;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Routing\Controller;

class ProductController extends Controller
{
    public function __construct(protected ProductService $productService)
    {
    }

    public function index()
    {
        $products = Product::all();
        return response()->json($products);
    }

    public function store(ProductStoreRequest $request)
    {
        $product = Product::create($request->all());

        return response()->json($product, 201);
    }

    public function show($id)
    {
        $product = $this->productService->getId($id);

        return response()->json($product);
    }

    public function update(ProductStoreRequest $request, int $id)
    {
        $productId = $this->productService->getId($id);
        $product = $this->productService->update($id, $request->all());

        return response()->json($product);
    }

    public function destroy($id)
    {
        $product = $this->productService->getId($id);
        return $product->delete();
    }

}
