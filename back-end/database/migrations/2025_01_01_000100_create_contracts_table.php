<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('contracts', function (Blueprint $t) {
            $t->id(); $t->unsignedBigInteger('vendor_id'); $t->string('title'); $t->string('file_path'); $t->integer('version')->default(1); $t->date('start_date')->nullable(); $t->date('end_date')->nullable(); $t->json('tags')->nullable(); $t->unsignedBigInteger('uploaded_by'); $t->string('status')->default('active'); $t->date('expiry_date')->nullable(); $t->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('contracts'); }
};
