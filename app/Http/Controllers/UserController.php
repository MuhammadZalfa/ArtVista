<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Function to show the list of users
    public function index()
    {
        $users = User::paginate(10);  // You can adjust the pagination number
        return view('admin.table', compact('users'));
    }

    // Function to create a new user
    public function create(Request $request)
{
    try {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|unique:users,username|max:255',
            'email' => 'required|email|unique:users,email|max:255',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'name' => $validated['name'],
            'username' => $validated['username'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'access_level' => 'user',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'User added successfully!'
        ]);

    } catch (\Illuminate\Validation\ValidationException $e) {
        return response()->json([
            'success' => false,
            'errors' => $e->errors()
        ], 422);

    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Error adding user'
        ], 500);
    }
}


public function profile()
{
    $user = auth()->user()->loadCount(['likes', 'albums', 'photos']);
    return view('profile', compact('user'));
}
    // Function to show the edit user form
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return response()->json($user);
    }
    

    // Function to update the user
    public function update(Request $request, $id)
{
    try {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8',
        ]);

        $user = User::findOrFail($id);
        $user->name = $validated['name'];
        $user->email = $validated['email'];

        if ($request->filled('password')) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        return response()->json(['success' => true, 'message' => 'User updated successfully']);
    } catch (\Exception $e) {
        return response()->json(['success' => false, 'message' => $e->getMessage()], 422);
    }
}
public function destroy($id)
{
    try {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json([
            'success' => true,
            'message' => 'User deleted successfully!'
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Error deleting user'
        ], 500);
    }
}
}
