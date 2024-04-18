<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

/**
 * @group User
 *
 * APIs related to users
 */
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @response \Illuminate\Http\Response
     */
    public function index()
    {
        return User::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @bodyParam name string required The name of the user. Example: John Doe
     * @bodyParam email string required The email of the user. Example: john@example.com
     * @bodyParam phone string required The phone number of the user. Example: 1234567890
     * @bodyParam password string required The password of the user. Example: password123
     *
     * @response 201 {
     *    "message": "User created successfully"
     * }
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'password' => 'required'
        ]);

        User::create($request->all());
        return response()->json(['message' => 'User created successfully'], 201);
    }

    /**
     * Display the specified resource.
     *
     * @urlParam id int required The ID of the user. Example:1
     *
     * @response \Illuminate\Http\Response
     */
    public function show(string $id)
    {
        $user = User::findOrFail($id);
        return response()->json($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @urlParam id string required The ID of the user. Example:1
     *
     * @bodyParam name string required The name of the user. Example: John Doe
     * @bodyParam email string required The email of the user. Example: john@example.com
     * @bodyParam phone string required The phone number of the user. Example: 9945214620
     * @bodyParam password string required The password of the user. Example: password1234
     *
     *
     * @response {
     *    "message": "User updated successfully"
     * }
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);
        $user->update($request->all());

        return response()->json(['message' => 'User updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @urlParam id int required The ID of the user. Example:1
     *
     * @response {
     *    "message": "User deleted successfully"
     * }
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json(['message' => 'User deleted successfully']);
    }
}
