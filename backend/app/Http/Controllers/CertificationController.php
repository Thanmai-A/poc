<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Certification;
class CertificationController extends Controller {
    public function index($vendorId){ return Certification::where('vendor_id',$vendorId)->get(); }
    public function store(Request $r,$vendorId){ $data = $r->validate(['name'=>'required','issued_on'=>'nullable|date','expires_on'=>'nullable|date|after:issued_on','file'=>'nullable|file|mimes:pdf,jpg,jpeg,png']); $path = $r->hasFile('file') ? $r->file('file')->store('certs','public') : null; $data['vendor_id']=$vendorId; $data['file_path']=$path; $c = Certification::create($data); return response()->json($c,201); }
    public function update(Request $r,$id){ $c = Certification::findOrFail($id); $c->update($r->only('name','issued_on','expires_on')); return response()->json($c); }
    public function destroy($id){ Certification::findOrFail($id)->delete(); return response()->json(['message'=>'Deleted']); }
    public function myCerts(){ return Certification::where('vendor_id',auth()->id())->get(); }
}
