<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;




class PublicVendorController extends Controller
{
    public function getVendors()
    {
        if(Auth::user()->role !== 'admin') {
            return \response()->json(['error' => 'Forbidden'], 403);
        }
        
        return response()->json(User::where('role','vendor')->get());
    }

    public function createVendor(Request $request)
    {
        if(Auth::user()->role !== 'admin') {
            return \response()->json(['error' => 'Forbidden'], 403);
        }
        
        $data = $request->validate([
            'name'=>'required|string',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|string|min:6',
            'company_name'=>'nullable|string',
        ]);
        $data['name'] = $data['name'];
        $data['password'] = bcrypt($data['password']);
        $data['role'] = 'vendor';
        $data['email'] = $data['email'];
        $vendor = User::create($data);
        return response()->json(['meaasge' => 'Vendor created successfully','vendor' => $vendor]);
    }

    public function updateVendor(Request $request, $id)
    {
        if(Auth::user()->role !== 'admin') {
            return \response()->json(['error' => 'Forbidden'], 403);
        }
        $vendor = User::where('role','vendor')->findOrFail($id);
        $data = $request->validate([
            'name'=>'sometimes|string',
            'email'=>'sometimes|email|unique:users,email,'.$vendor->id,
            'password'=>'nullable|string|min:6',
            'company_name'=>'nullable|string',
            'status'=>'sometimes|in:pending,approved,rejected',
        ]);
        if(isset($data['password'])) $data['password'] = bcrypt($data['password']);
        $vendor->update($data);
        return response()->json($vendor);
    }

    public function deleteVendor($id)
    {
        if(Auth::user()->role !== 'admin') {
            return \response()->json(['error' => 'Forbidden'], 403);
        }
        $vendor = User::where('role','vendor')->findOrFail($id);
        $vendor->delete();
        return response()->json(['message'=>'deleted']);
    }
}
