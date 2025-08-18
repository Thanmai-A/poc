<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Message;
class MessageController extends Controller {
    public function index(){ $u = auth()->user(); if($u->role==='admin') return Message::latest()->get(); return Message::where('from_user_id',$u->id)->orWhere('to_user_id',$u->id)->latest()->get(); }
    public function store(Request $r){ $data = $r->validate(['to_user_id'=>'nullable|exists:users,id','channel'=>'required|in:rfq,compliance,general','subject'=>'required|string','body'=>'required|string']); $data['from_user_id']=auth()->id(); $data['status']='open'; return response()->json(Message::create($data),201); }
    public function update(Request $r,$id){ $m = Message::findOrFail($id); $m->update($r->only('subject','body','status')); return response()->json($m); }
    public function destroy($id){ Message::findOrFail($id)->delete(); return response()->json(['message'=>'Deleted']); }
}
