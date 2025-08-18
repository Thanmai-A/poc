<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('certifications', function (Blueprint $t) {
            $t->id(); $t->unsignedBigInteger('vendor_id'); $t->string('name'); $t->date('issued_on')->nullable(); $t->date('expires_on')->nullable(); $t->string('file_path')->nullable(); $t->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('certifications'); }
};
