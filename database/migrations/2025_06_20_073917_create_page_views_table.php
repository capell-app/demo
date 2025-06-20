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
        Schema::dropIfExists('page_views');
    }

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('page_views', function (Blueprint $table): void {
            $table->id();
            $table->string('url');
            $table->char('session_id', 64);
            $table->foreignId('site_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('language_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('page_id')->nullable()->constrained()->onDelete('cascade');
            $table->unsignedSmallInteger('visits')->default(1);
            $table->foreignId('user_id')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('viewed_at')->nullable()->index();
            $table->unique(['url', 'session_id']);
            $table->index(['site_id', 'page_id', 'language_id', 'session_id']);
        });
    }
};
