<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('materials', function (Blueprint $table) {
            $table->id();
            $table->foreignId('source_id')->nullable()->constrained()->nullOnDelete()->cascadeOnUpdate();
            $table->string('feed_id')->nullable();
            $table->string('title');
            $table->longText('description')->nullable();
            $table->longText('body')->nullable();
            $table->string('author')->nullable();
            $table->boolean('is_displayed')->default(0);
            $table->string('slug')->unique();
            $table->string('url')->unique();
            $table->unsignedBigInteger('duration')->nullable();
            $table->string('image_url')->nullable();
            $table->unsignedBigInteger('views')->default(0);
            $table->unsignedBigInteger('clicks')->default(0);
            $table->unsignedBigInteger('redirects')->default(0);
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materials');
    }
};
