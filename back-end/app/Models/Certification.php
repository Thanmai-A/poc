<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Certification extends Model { protected $fillable = ['vendor_id','name','issued_on','expires_on','file_path']; protected $casts=['issued_on'=>'date','expires_on'=>'date']; }
