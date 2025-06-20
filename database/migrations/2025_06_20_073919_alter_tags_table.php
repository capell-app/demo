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
        Schema::table('tags', function (Blueprint $table): void {
            $table->dropColumn(['featured', 'status']);

            if (DB::getDriverName() !== 'sqlite') {
                $table->dropForeign(['site_id']);
            }

            $table->dropColumn('site_id');
        });
    }

    public function up(): void
    {
        Schema::table('tags', function (Blueprint $table): void {
            $table->boolean('featured')->index()->default(0);
            $table->boolean('status')->index()->default(1);
            $table->foreignId('site_id')->nullable()->constrained()->nullOnDelete();
        });
    }
};
