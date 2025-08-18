<?php
namespace App\Http\Controllers;
use App\Models\{User,Contract,Certification,VendorRating};
use Illuminate\Support\Facades\DB;
class DashboardController extends Controller {
    public function adminMetrics(){ return ['totalVendors'=>User::where('role','vendor')->count(),'pendingVendors'=>User::where('role','vendor')->where('status','pending')->count(),'activeContracts'=>Contract::count(),'expiringCerts'=>Certification::whereDate('expires_on','<=',now()->addDays(30))->count(),'avg_rating'=>VendorRating::avg(DB::raw('(delivery_time+quality+responsiveness)/3'))]; }
    public function financeMetrics(){ return ['renewals30'=>Contract::whereDate('end_date','<=',now()->addDays(30))->count(),'tcv'=>120000]; }
}
