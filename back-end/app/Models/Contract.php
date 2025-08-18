<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Contract extends Model {
    protected $fillable = ['vendor_id','title','file_path','version','start_date','end_date','tags','uploaded_by','status','expiry_date'];
    protected $casts = ['tags'=>'array','start_date'=>'date','end_date'=>'date','expiry_date'=>'date'];
    public function vendor(){ return $this->belongsTo(User::class,'vendor_id'); }
    public function uploader(){ return $this->belongsTo(User::class,'uploaded_by'); }
}
