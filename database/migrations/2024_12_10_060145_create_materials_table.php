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
            $table->string('title');
            $table->string('description');
            $table->string('body');
            $table->string('author')->nullable();
            $table->boolean('is_displayed');
            $table->string('slug');
            $table->string('url');
            $table->string('image_url');
            $table->unsignedBigInteger('views');
            $table->unsignedBigInteger('clicks');
            $table->unsignedBigInteger('redirects');
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
