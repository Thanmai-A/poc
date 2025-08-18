<?php
 
namespace App\Http\Controllers;
 
use App\Models\User;

use Illuminate\Http\Request;
 
class PublicVendorController extends Controller

{

    // 📌 READ: Get all vendors

    public function getVendors()

    {

        $vendors = User::where('role', 'vendor')->get(); // ✅ quotes around 'role'

        return response()->json($vendors);

    }
 
    // 📌 CREATE: Register a new vendor

    public function createVendor(Request $request)
{
    try {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'company_name' => 'nullable|string|max:255',
        ]);
 
        $vendor = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']), // 🔑 hash password
            'role' => 'vendor',
            'status' => 'pending', // default until approved
        ]);
 
        return response()->json([
            'message' => 'Vendor created successfully',
            'vendor'  => $vendor
        ], 201);
 
    } catch (\Exception $e) {
        return response()->json([
            'error' => 'Failed to create vendor',
            'details' => $e->getMessage()
        ], 500);
    }
}
 
    // 📌 UPDATE: Update vendor info

    public function updateVendor(Request $request, $id)

    {

        $vendor = User::where('role', 'vendor')->findOrFail($id);
 
        $validated = $request->validate([

            'name'   => 'sometimes|string|max:255',

            'email'  => 'sometimes|email|unique:users,email,' . $vendor->id,

            'status' => 'sometimes|string|in:pending,approved,rejected',

        ]);
 
        $vendor->update($validated);
 
        return response()->json($vendor);

    }
 
    // 📌 DELETE: Remove a vendor

    public function deleteVendor($id)

    {

        $vendor = User::where('role', 'vendor')->findOrFail($id);

        $vendor->delete();
 
        return response()->json(['message' => 'Vendor deleted successfully']);

    }

}

 