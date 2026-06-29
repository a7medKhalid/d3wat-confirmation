<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('confirmations', function (Blueprint $table) {
            $table->string('status', 20)->default('visited')->after('mode');
            $table->timestamp('visited_at')->nullable()->after('status');
            $table->timestamp('responded_at')->nullable()->after('visited_at');
        });

        DB::table('confirmations')
            ->whereNotNull('confirmed_at')
            ->update([
                'status' => 'confirmed',
                'visited_at' => DB::raw('confirmed_at'),
                'responded_at' => DB::raw('confirmed_at'),
            ]);

        Schema::table('confirmations', function (Blueprint $table) {
            $table->timestamp('confirmed_at')->nullable()->change();
            $table->index('status');
            $table->index('visited_at');
        });
    }

    public function down(): void
    {
        Schema::table('confirmations', function (Blueprint $table) {
            $table->dropIndex(['status']);
            $table->dropIndex(['visited_at']);
            $table->dropColumn(['status', 'visited_at', 'responded_at']);
        });
    }
};
