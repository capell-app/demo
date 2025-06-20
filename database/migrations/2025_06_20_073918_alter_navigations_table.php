<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function down(): void
    {
        if (Schema::hasColumn('navigations', 'language_id')) {
            Schema::table('navigations', function (Blueprint $table): void {
                $table->dropColumn('language_id');
            });
        }

        if (Schema::hasColumn('navigations', 'site_id')) {
            Schema::table('navigations', function (Blueprint $table): void {
                $table->dropColumn('site_id');
            });
        }

        if (Schema::hasColumn('navigations', 'meta')) {
            Schema::table('navigations', function (Blueprint $table): void {
                $table->dropColumn('meta');
            });
        }

        if (Schema::hasColumn('navigations', 'created_by')) {
            Schema::table('navigations', function (Blueprint $table): void {
                $table->dropColumn('created_by');
            });
        }

        if (Schema::hasColumn('navigations', 'updated_by')) {
            Schema::table('navigations', function (Blueprint $table): void {
                $table->dropColumn('updated_by');
            });
        }

        if (Schema::hasColumn('navigations', 'deleted_at')) {
            Schema::table('navigations', function (Blueprint $table): void {
                $table->dropSoftDeletes();
            });
        }

        $sm = Schema::getConnection()->getDoctrineSchemaManager();
        $indexesFound = $sm->listTableIndexes('navigations');

        $indexesToCheck = [
            'navigations_handle_unique',
            'navigations_handle_site_id_language_id_unique',
        ];

        foreach ($indexesToCheck as $currentIndex) {
            if (array_key_exists($currentIndex, $indexesFound)) {
                Schema::table('navigations', function (Blueprint $table) use ($currentIndex): void {
                    $table->dropForeign($currentIndex);
                });
            }
        }
    }

    public function up(): void
    {
        Schema::table('navigations', function (Blueprint $table): void {
            if (! Schema::hasColumn('navigations', 'language_id')) {
                $table->foreignId('language_id')->nullable()->constrained()->cascadeOnDelete();
            }

            if (! Schema::hasColumn('navigations', 'site_id')) {
                $table->foreignId('site_id')->nullable()->constrained()->cascadeOnDelete();
            }

            if (! Schema::hasColumn('navigations', 'meta')) {
                $table->json('meta')->nullable();
            }

            $table->userstamps();

            $table->dropUnique('navigations_handle_unique');

            $table->index(['site_id', 'language_id']);

            $table->unique(['handle', 'site_id', 'language_id']);

            $table->softDeletes();
        });
    }
};
