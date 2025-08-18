<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
class AuthController extends Controller {
    public function login(Request $request){
        $credentials = $request->only('email','password');
        if(! $token = auth()->attempt($credentials)){
            return response()->json(['error'=>'Unauthorized'],401);
        }
        $u = auth()->user();
        return response()->json([
            'access_token'=>$token,
            'token_type'=>'bearer',
            'user'=>[
                'id'=>$u->id,'
                name'=>$u->name,
                'email'=>$u->email,
                'role'=>$u->role
                ]]);
    }
    public function me(){ return response()->json(auth()->user()); }
    public function logout(){ auth()->logout(); return response()->json(['message'=>'Logged out']); }
}
