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
        Schema::dropIfExists('page_urls');
    }

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('page_urls', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('site_id')->constrained()->cascadeOnDelete();
            $table->foreignId('language_id')->constrained()->cascadeOnDelete();
            $table->foreignId('page_id')->constrained()->cascadeOnDelete();
            $table->text('url')->index();
            $table->json('params')->nullable();
            $table->enum('type', ['alias', 'redirect'])->nullable()->index();
            $table->boolean('status')->index()->default(1);
            $table->userstamps();
            $table->timestamps();
            $table->softDeletes();
            $table->index(['site_id', 'language_id', 'page_id']);
            $table->unique(['url', 'language_id', 'site_id', 'deleted_at']);
        });
    }
};
