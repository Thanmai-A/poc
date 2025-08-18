<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
class PublicVendorController extends Controller {
    public function register(Request $r){
        $data = $r->validate(['name'=>'required','email'=>'required|email|unique:users,email','password'=>'required|min:6']);
        $v = User::create(['name'=>$data['name'],'email'=>$data['email'],'password'=>bcrypt($data['password']),'role'=>'vendor','status'=>'pending']);
        return response()->json(['message'=>'Registered','id'=>$v->id],201);
    }
    public function index(){ return User::where('role','vendor')->get(); }
    public function show($id){ return User::where('role','vendor')->findOrFail($id); }
    public function update(Request $r,$id){ $v = User::where('role','vendor')->findOrFail($id); $v->update($r->only('name','email','status')); return response()->json($v); }
    public function destroy($id){ $v = User::where('role','vendor')->findOrFail($id); $v->delete(); return response()->json(['message'=>'Deleted']); }
}
