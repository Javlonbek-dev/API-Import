<?php

namespace App\Http\Controllers;

use App\Http\Requests\BrandRequest;
use App\Models\Brand;

/**
 * @group Brand
 *
 * APIs related to brands
 */
class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @response {
     *      "data": [
     *          {
     *              "id": 1,
     *              "name": "BrandName1",
     *              "image": "images/brand1.jpg"
     *          },
     *          {
     *              "id": 2,
     *              "name": "BrandName2",
     *              "image": "images/brand2.jpg"
     *          },
     *          ...
     *      ]
     *  }
     */

    public function index()
    {
        return Brand::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @bodyParam name string required The name of the brand. Example: Ishonch
     * @bodyParam image string required The image of the brand. Example: "images/1713348086.jpg"
     *
     * @response 201 {
     *    "message": "Brand created successfully"
     * }
     */
    public function store(BrandRequest $request)
    {

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
        }


        $brand = new Brand();
        $brand->name = $request->input('name');
        $brand->image = isset($imageName) ? 'images/' . $imageName : null;
        $brand->save();

        return $brand;
    }

    /**
     * Display the specified resource.
     *
     * @urlParam id int required The ID of the brand. Example:1
     *
     * @response {
     *      "id": 1,
     *      "name": "BrandName",
     *      "image": "images/brand.jpg"
     *  }
     */
    public function show($id)
    {
        $brand = Brand::findOrFail($id);
        return response()->json($brand);
    }

    /**
     * Update the specified resource in storage.
     *
     * @urlParam id int required The ID of the brand. Example:1
     *
     * @bodyParam name string required The name of the brand. Example: Texnomart
     * @bodyParam image string required The image of the brand. Example: "images/1713348086.jpg"
     *
     *
     * @response {
     *    "message": "Brand updated successfully"
     * }
     */
    public function update(BrandRequest $request, $id)
    {
        $brand = Brand::findOrFail($id);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $brand->image = 'images/' . $imageName;
        }

        $brand->name = $request->input('name');
        $brand->save();

        return response()->json(['message' => 'Brand updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @urlParam id int required The ID of the brand. Example:1
     *
     * @response {
     *    "message": "Brand deleted successfully"
     * }
     */

    public function destroy($id)
    {
        $brand = Brand::findOrFail($id);
        $brand->delete();

        return response()->json(['message' => 'Brand deleted successfully']);
    }

    /**
     * Get the count of branches per brand in the specified region.
     *
     * Retrieves the count of branches per brand within the specified region.
     *
     * @group Brand
     * @urlParam region string required The region to filter by.Example:Toshkent
     * @response {
     *     "data": [
     *         {
     *             "id": 1,
     *             "name": "BrandName1",
     *             "branches_count": 5
     *         },
     *         {
     *             "id": 2,
     *             "name": "BrandName2",
     *             "branches_count": 3
     *         },
     *         ...
     *     ]
     * }
     */

    public function branchesPerBrandInRegion($region)
    {
        $brandsWithBranchCount = Brand::withCount(['branches' => function ($query) use ($region) {
            $query->where('region', $region);
        }])->get(['id', 'name']);

        return response()->json($brandsWithBranchCount);
    }
}
