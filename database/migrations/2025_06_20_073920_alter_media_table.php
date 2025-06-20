<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function down(): void
    {
        Schema::table('media', function (Blueprint $table): void {
            $table->dropColumn('uuid');
        });
    }

    public function up(): void
    {
        Schema::table('media', function (Blueprint $table): void {
            $table->uuid()->nullable()->index()->after('id');
        });
    }
};
