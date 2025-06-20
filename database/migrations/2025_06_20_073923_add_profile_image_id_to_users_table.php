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
        if (Schema::hasColumn('users', 'profile_image_id')) {
            if (DB::getDriverName() !== 'sqlite') {
                Schema::table('users', function (Blueprint $table): void {
                    $table->dropForeign(['profile_image_id']);
                });
            }

            Schema::table('users', function (Blueprint $table): void {
                $table->dropColumn('profile_image_id');
            });
        }
    }

    public function up(): void
    {
        Schema::table('users', function (Blueprint $table): void {
            if (! Schema::hasColumn('users', 'profile_image_id')) {
                $table->foreignId('profile_image_id')->nullable()->constrained('media')->nullOnDelete();
            }
        });
    }
};
