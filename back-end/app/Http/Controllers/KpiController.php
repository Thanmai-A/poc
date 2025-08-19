<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Kpi;

class KpiController extends Controller
{
    public function index() { return response()->json(Kpi::all()); }

    public function store(Request $request) {
        $data = $request->validate([
            'vendor_id'=>'required|exists:users,id',
            'metric'=>'required|string',
            'score'=>'required|numeric|min:0|max:100',
            'recorded_at'=>'sometimes|date',
        ]);
        $k = Kpi::create($data);
        return response()->json($k,201);
    }

    public function update(Request $request,$id) {
        $k = Kpi::findOrFail($id);
        $k->update($request->all());
        return response()->json($k);
    }

    public function delete($id) { Kpi::delete($id); return response()->json(['message'=>'deleted']); }
}
