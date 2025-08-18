<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Contract;
class ContractController extends Controller {
    public function index(){ return Contract::with('vendor:id,name')->orderBy('updated_at','desc')->get(); }
    public function store(Request $r){
        $data = $r->validate(['vendor_id'=>'required|exists:users,id','title'=>'required','file'=>'required|file|mimes:pdf,doc,docx','start_date'=>'nullable|date','end_date'=>'nullable|date','tags'=>'nullable']);
        $path = $r->file('file')->store('contracts','public');
        $c = Contract::create(['vendor_id'=>$data['vendor_id'],'title'=>$data['title'],'file_path'=>$path,'version'=>1,'start_date'=>$data['start_date']??null,'end_date'=>$data['end_date']??null,'tags'=>isset($data['tags'])?json_encode($data['tags']):null,'uploaded_by'=>auth()->id(),'status'=>'active','expiry_date'=>$data['end_date']??null]);
        return response()->json($c,201);
    }
    public function show($id){ return Contract::with('vendor:id,name')->findOrFail($id); }
    public function uploadNewVersion(Request $r,$id){ $c = Contract::findOrFail($id); $r->validate(['file'=>'required|file|mimes:pdf,doc,docx']); $path = $r->file('file')->store('contracts','public'); $c->version += 1; $c->file_path=$path; $c->save(); return response()->json($c); }
    public function update(Request $r,$id){ $c = Contract::findOrFail($id); $c->update($r->only('title','start_date','end_date','tags','status')); return response()->json($c); }
    public function destroy($id){ Contract::findOrFail($id)->delete(); return response()->json(['message'=>'Deleted']); }
    public function myContracts(){ return Contract::where('vendor_id',auth()->id())->orderBy('updated_at','desc')->get(); }
}
