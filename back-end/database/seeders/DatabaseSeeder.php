<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Contract;
use App\Models\Kpi;
use App\Models\Certification;
use App\Models\Message;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Disable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Truncate child tables first
        Message::truncate();
        Certification::truncate();
        Kpi::truncate();
        Contract::truncate();
        User::truncate();

        // Re-enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Seed users
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'status' => 'approved'
        ]);

        $proc = User::create([
            'name' => 'Procurement',
            'email' => 'proc@example.com',
            'password' => Hash::make('password'),
            'role' => 'procurement',
            'status' => 'approved'
        ]);

        $finance = User::create([
            'name' => 'Finance',
            'email' => 'finance@example.com',
            'password' => Hash::make('password'),
            'role' => 'finance',
            'status' => 'approved'
        ]);

        $vendor = User::create([
            'name' => 'Vendor A',
            'email' => 'vendor@example.com',
            'password' => Hash::make('password'),
            'role' => 'vendor',
            'status' => 'approved',
            'company_name' => 'Acme Co'
        ]);

        // Seed related data
        Contract::create([
            'vendor_id' => $vendor->id,
            'title' => 'IT Support',
            'terms' => 'Standard terms',
            'start_date' => date('Y-m-d'),
            'end_date' => date('Y-m-d', strtotime('+1 year')),
            'status' => 'active'
        ]);

        Kpi::create([
            'vendor_id' => $vendor->id,
            'metric' => 'On-time delivery',
            'score' => 85,
            'recorded_at' => now()
        ]);

        Certification::create([
            'vendor_id' => $vendor->id,
            'type' => 'ISO9001',
            'expiry_date' => date('Y-m-d', strtotime('+6 months')),
            'status' => 'approved'
        ]);

        Message::create([
            'sender_id' => $admin->id,
            'receiver_id' => $vendor->id,
            'content' => 'Welcome to the portal'
        ]);
    }
}
