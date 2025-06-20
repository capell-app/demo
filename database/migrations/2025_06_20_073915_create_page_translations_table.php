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
        Schema::dropIfExists('page_translations');
    }

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('page_translations', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('page_id')->constrained()->cascadeOnDelete();
            $table->foreignId('language_id')->constrained()->cascadeOnDelete();
            $table->string('title')->nullable();
            $table->string('slug');
            $table->longText('content')->nullable();
            $table->json('contents')->nullable();
            $table->json('meta')->nullable();
            $table->json('actions')->nullable();
            $table->userstamps();
            $table->timestamps();
            $table->unique(['page_id', 'language_id']);
        });
    }
};
