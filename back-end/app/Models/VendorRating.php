<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class VendorRating extends Model { protected $fillable = ['vendor_id','rated_by','delivery_time','quality','responsiveness','comment']; }
