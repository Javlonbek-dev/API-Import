<?php

namespace App\Http\Controllers;

use App\Http\Requests\BranchRequest;
use App\Models\Branch;

/**
 * @group Branch
 *
 * APIs related to branch
 */
class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @response {
     *      "data": [
     *          {
     *              "id": 1,
     *              "name": "BrandName1",
     *              "branches_count": 5,
     *              "image": "images/branch1.jpg"
     *          },
     *          {
     *              "id": 2,
     *              "name": "BrandName2",
     *              "branches_count": 3,
     *              "image": "images/branch2.jpg"
     *          },
     *          ...
     *      ]
     *  }
     */

    public function index()
    {
        return Branch::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @bodyParam name string required The name of the branch. Example: Ishonch
     * @bodyParam image string required The image of the branch. Example: "images/1713348086.jpg"
     * @bodyParam region string required The region of the branch. Example: "Toshkent"
     * @bodyParam district string required The district of the branch. Example: "Chilanzor"
     *
     * @response 201 {
     *    "message": "Branch created successfully"
     * }
     */
    public function store(BranchRequest $request)
    {
        return Branch::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @urlParam id int required The ID of the branch. Example:1
     *
     * @response {
     *      "id": 1,
     *      "name": "BranchName",
     *      "region": "Region",
     *      "district": "District",
     *      "image": "images/branch3.jpg"
     *  }
     */
    public function show(string $id)
    {
        return Branch::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @urlParam id int required The ID of the brand. Example:1
     *
     * @bodyParam name string required The name of the branch. Example: Ishonch
     * @bodyParam image string required The image of the branch. Example: "images/1713348086.jpg"
     * @bodyParam region string required The region of the branch. Example: "Qahqadaryo"
     * @bodyParam district string required The district of the branch. Example: "Kitob"
     *
     *
     * @response {
     *    "message": "Branch updated successfully"
     * }
     */
    public function update(BranchRequest $request, string $id)
    {
        $branch = Branch::findOrFail($id);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $branch->image = 'images/' . $imageName;
        }

        $branch->name = $request->input('name');
        $branch->region = $request->input('region');
        $branch->district = $request->input('district');
        $branch->save();

        return response()->json(['message' => 'Branch updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @urlParam id int required The ID of the branch. Example:1
     *
     * @response {
     *    "message": "Branch deleted successfully"
     * }
     */
    public function destroy(string $id)
    {
        return Branch::destroy($id);
    }
}
