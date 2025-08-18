<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\VendorRating;
class RatingController extends Controller {
    public function index($vendorId){ return VendorRating::where('vendor_id',$vendorId)->latest()->get(); }
    public function store(Request $r,$vendorId){ $data = $r->validate(['delivery_time'=>'required|integer|min:1|max:5','quality'=>'required|integer|min:1|max:5','responsiveness'=>'required|integer|min:1|max:5','comment'=>'nullable|string']); $data['vendor_id']=$vendorId; $data['rated_by']=auth()->id(); $rating = VendorRating::create($data); return response()->json($rating,201); }
    public function update(Request $r,$id){ $rating = VendorRating::findOrFail($id); $rating->update($r->only('delivery_time','quality','responsiveness','comment')); return response()->json($rating); }
    public function destroy($id){ VendorRating::findOrFail($id)->delete(); return response()->json(['message'=>'Deleted']); }
    public function myRatings(){ return VendorRating::where('vendor_id',auth()->id())->get(); }
}
