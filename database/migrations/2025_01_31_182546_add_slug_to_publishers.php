<?php

declare(strict_types=1);

use App\Models\Publisher;
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
        Schema::table('publishers', function (Blueprint $table) {
            $table->string('slug')->nullable()->after('name');
            $table->unique('name');
        });

        foreach (Publisher::all() as $publisher) {
            $publisher->slug = str($publisher->name)->slug();
            $publisher->save();
        }

        Schema::table('publishers', function (Blueprint $table) {
            $table->string('slug')->unique()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('publishers', function (Blueprint $table) {
            $table->dropColumn('slug');
            $table->dropUnique(['name']);
        });
    }
};
