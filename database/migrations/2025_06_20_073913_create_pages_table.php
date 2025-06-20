<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pages');
    }

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pages', function (Blueprint $table): void {
            $table->id();
            $table->string('name');
            $table->foreignId('type_id')->constrained();
            $table->foreignId('layout_id')->constrained();
            $table->foreignId('site_id')->constrained()->cascadeOnDelete();
            $table->uuid('parent_uuid')->nullable()->constrained('pages', 'uuid')->nullOnDelete()->cascadeOnUpdate();
            $table->json('meta')->nullable();
            $table->json('admin')->nullable();
            $table->json('settings')->nullable();
            $table->publishDates();
            $this->draftsCreateSchema($table);
            $table->unsignedInteger('order')->default(0);
            $table->nestedSet();
            $table->userstamps();
            $table->timestamps();
            $table->softDeletes();
            $table->index(['site_id', 'type_id']);
            $table->index(['site_id', 'order']);
        });
    }

    private function draftsCreateSchema(Blueprint $table): void
    {
        $uuid = config('drafts.column_names.uuid', 'uuid');
        $publishedAt = config('drafts.column_names.published_at', 'published_at');
        $isPublished = config('drafts.column_names.is_published', 'is_published');
        $isCurrent = config('drafts.column_names.is_current', 'is_current');
        $publisherMorphName = config('drafts.column_names.publisher_morph_name', 'publisher');

        $table->uuid($uuid)->index(); // custom not nullable
        $table->timestamp($publishedAt)->nullable();
        $table->boolean($isPublished)->default(false);
        $table->boolean($isCurrent)->default(false);
        $table->nullableMorphs($publisherMorphName);

        $table->index([$uuid, $isPublished, $isCurrent]);
    }
};
