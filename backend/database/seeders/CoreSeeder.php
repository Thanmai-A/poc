<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Contract;
use App\Models\VendorRating;
use App\Models\Certification;
class CoreSeeder extends Seeder {
    public function run(): void {
        $admin = User::updateOrCreate(['email'=>'admin@example.com'],['name'=>'Admin','password'=>bcrypt('password123'),'role'=>'admin','status'=>'approved']);
        $proc = User::updateOrCreate(['email'=>'procurement@example.com'],['name'=>'Procurement','password'=>bcrypt('password123'),'role'=>'procurement','status'=>'approved']);
        $fin = User::updateOrCreate(['email'=>'finance@example.com'],['name'=>'Finance','password'=>bcrypt('password123'),'role'=>'finance','status'=>'approved']);
        $vendor = User::updateOrCreate(['email'=>'vendor@example.com'],['name'=>'Vendor Co','password'=>bcrypt('password123'),'role'=>'vendor','status'=>'approved']);
        Contract::create(['vendor_id'=>$vendor->id,'title'=>'Master Services Agreement','file_path'=>'contracts/sample.pdf','version'=>1,'start_date'=>now()->subMonths(5),'end_date'=>now()->addDays(25),'tags'=>json_encode(['IT','MSA']),'uploaded_by'=>$admin->id,'status'=>'active','expiry_date'=>now()->addDays(25)]);
        VendorRating::create(['vendor_id'=>$vendor->id,'rated_by'=>$admin->id,'delivery_time'=>4,'quality'=>5,'responsiveness'=>4,'comment'=>'Solid performance']);
        Certification::create(['vendor_id'=>$vendor->id,'name'=>'ISO 27001','issued_on'=>now()->subYear(),'expires_on'=>now()->addDays(15)]);
    }
}
