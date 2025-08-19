<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function getMessage()
    {
        if(Auth::user()->role !== 'admin') {
            return \response()->json(['error' => 'Forbidden'], 403);
        } 
        return response()->json(Message::all()); }

    public function createMessage(Request $request)
    {
        if(Auth::user()->role !== 'admin') {
            return \response()->json(['error' => 'Forbidden'], 403);
        }
        $data = $request->validate([
            'sender_id'=>'required|exists:users,id',
            'receiver_id'=>'required|exists:users,id',
            'content'=>'required|string',
        ]);
        $m = Message::create($data);
        return response()->json($m,201);
    }

    public function deleteMessage($id)
    {
        if(Auth::user()->role !== 'admin') {
            return \response()->json(['error' => 'Forbidden'], 403);
        }
         Message::delete($id); 
         return response()->json(['message'=>'deleted']); 
    }
}
