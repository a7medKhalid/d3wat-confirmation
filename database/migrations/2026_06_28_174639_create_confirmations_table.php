<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('confirmations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('confirmation_session_id')->nullable()->constrained()->nullOnDelete();
            $table->string('phone', 20)->nullable();
            $table->string('name')->nullable();
            $table->string('visitor_key', 64)->nullable();
            $table->string('mode', 20);
            $table->timestamp('confirmed_at');
            $table->string('ip_address', 45)->nullable();
            $table->timestamps();

            $table->unique(['confirmation_session_id', 'visitor_key']);
            $table->unique('phone');
            $table->index('confirmation_session_id');
            $table->index('mode');
            $table->index('confirmed_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('confirmations');
    }
};
