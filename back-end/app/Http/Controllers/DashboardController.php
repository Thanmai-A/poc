<?php
namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Contract;
use App\Models\Certification;
use App\Models\Kpi;

class DashboardController extends Controller
{
    public function index() {
        return response()->json([
            'total_vendors' => User::where('role','vendor')->count(),
            'active_contracts' => Contract::where('status','active')->count(),
            'expired_certifications' => Certification::where('expiry_date','<',now())->count(),
            'avg_rating' => Kpi::avg('score') ?? 0,
        ]);
    }
}
