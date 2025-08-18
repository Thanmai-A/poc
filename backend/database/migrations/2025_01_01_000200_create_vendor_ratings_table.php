<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('vendor_ratings', function (Blueprint $t) {
            $t->id(); $t->unsignedBigInteger('vendor_id'); $t->unsignedBigInteger('rated_by'); $t->unsignedTinyInteger('delivery_time'); $t->unsignedTinyInteger('quality'); $t->unsignedTinyInteger('responsiveness'); $t->text('comment')->nullable(); $t->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('vendor_ratings'); }
};
