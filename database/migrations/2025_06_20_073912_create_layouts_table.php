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
        Schema::dropIfExists('layouts');
    }

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('layouts', function (Blueprint $table): void {
            $table->id();
            $table->string('name');
            $table->foreignId('theme_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('site_id')->nullable()->constrained()->nullOnDelete();
            $table->string('key', 128);
            $table->string('group', 64)->nullable();
            $table->json('containers')->nullable();
            $table->json('widgets')->nullable();
            $table->json('meta')->nullable();
            $table->json('admin')->nullable();
            $table->unsignedInteger('order')->default(0)->index();
            $table->boolean('default')->index()->default(0);
            $table->boolean('status')->index()->default(1);
            $table->userstamps();
            $table->timestamps();
            $table->unique(['key', 'deleted_at']);
            $table->softDeletes();
        });
    }
};
