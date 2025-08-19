<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vendor_id')->constrained('users')->onDelete('cascade');
            $table->string('title');
            $table->text('terms')->nullable();
            $table->date('start_date');
            $table->date('end_date');
            $table->enum('status',['draft','active','expired'])->default('draft');
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('contracts'); }
};
