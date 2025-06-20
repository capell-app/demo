<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function down(): void
    {
        Schema::table('authentication_log', function (Blueprint $table): void {
            $table->dropColumn('last_seen_at');
        });
    }

    public function up(): void
    {
        Schema::table('authentication_log', function (Blueprint $table): void {
            $table->timestamp('last_seen_at')->nullable();
        });

        DB::table('authentication_log')->update([
            'last_seen_at' => DB::raw('CASE WHEN login_at > logout_at THEN login_at ELSE logout_at END'),
        ]);
    }
};
