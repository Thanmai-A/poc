<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('messages', function (Blueprint $t) {
            $t->id(); $t->unsignedBigInteger('from_user_id'); $t->unsignedBigInteger('to_user_id')->nullable(); $t->enum('channel',['rfq','compliance','general'])->default('general'); $t->string('subject'); $t->text('body'); $t->enum('status',['open','closed'])->default('open'); $t->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('messages'); }
};
