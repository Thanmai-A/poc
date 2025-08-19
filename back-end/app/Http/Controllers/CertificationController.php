<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Certification;

class CertificationController extends Controller
{
    public function index() { return response()->json(Certification::all()); }

    public function store(Request $request) {
        $data = $request->validate([
            'vendor_id'=>'required|exists:users,id',
            'type'=>'required|string',
            'expiry_date'=>'required|date',
        ]);
        $c = Certification::create($data);
        return response()->json($c,201);
    }

    public function update(Request $request,$id) {
        $c = Certification::findOrFail($id);
        $c->update($request->all());
        return response()->json($c);
    }

    public function delete($id) { Certification::delete($id); return response()->json(['message'=>'deleted']); }
}
