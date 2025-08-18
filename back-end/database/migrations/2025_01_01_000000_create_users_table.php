<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('users', function (Blueprint $t) {
            $t->id(); $t->string('name'); $t->string('email')->unique(); $t->timestamp('email_verified_at')->nullable(); $t->string('password'); $t->enum('role',['admin','procurement','finance','vendor'])->default('vendor'); $t->enum('status',['pending','approved','rejected'])->default('approved'); $t->rememberToken(); $t->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('users'); }
};
