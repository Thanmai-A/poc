<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Certification extends Model
{
    protected $fillable = ['vendor_id','type','expiry_date','file_path','status'];
}
