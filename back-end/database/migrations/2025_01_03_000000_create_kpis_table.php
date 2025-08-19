<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('kpis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vendor_id')->constrained('users')->onDelete('cascade');
            $table->string('metric');
            $table->integer('score');
            $table->timestamp('recorded_at')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('kpis'); }
};
