<?php
namespace App\Http\Controllers;
use App\Models\User;
class ProcurementController extends Controller {
    public function pending(){ return User::where('role','vendor')->where('status','pending')->get(); }
    public function approve($id){ return $this->set($id,'approved'); }
    public function reject($id){ return $this->set($id,'rejected'); }
    private function set($id,$status){ $v = User::where('role','vendor')->findOrFail($id); $v->status=$status; $v->save(); return response()->json(['message'=>ucfirst($status)]); }
}
