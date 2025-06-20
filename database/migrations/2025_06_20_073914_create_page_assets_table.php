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
        Schema::dropIfExists('page_assets');
    }

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('page_assets', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('page_id')->constrained()->cascadeOnDelete();
            $table->unsignedInteger('order')->default(0)->index();
            $table->morphs('asset');
            $table->userstamps();
            $table->timestamps();
            $table->unique(['page_id', 'asset_type', 'asset_id'], 'page_resource_index');
        });
    }
};
