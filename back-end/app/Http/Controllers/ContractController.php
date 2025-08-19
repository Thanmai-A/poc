<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Contract;

class ContractController extends Controller
{
    public function index() { return response()->json(Contract::all()); }

    public function store(Request $request) {
        $data = $request->validate([
            'vendor_id'=>'required|exists:users,id',
            'title'=>'required|string',
            'terms'=>'nullable|string',
            'start_date'=>'required|date',
            'end_date'=>'required|date|after_or_equal:start_date',
        ]);
        $c = Contract::create($data);
        return response()->json($c,201);
    }

    public function update(Request $request, $id) {
        $c = Contract::findOrFail($id);
        $c->update($request->all());
        return response()->json($c);
    }

    public function delete($id) { Contract::delete($id); return response()->json(['message'=>'deleted']); }
}
