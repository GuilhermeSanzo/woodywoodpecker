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
        Schema::table('books', function (Blueprint $blueprint) {
            $blueprint->unsignedBigInteger('views_count')->default(0)->after('stock');
        });

        Schema::table('authors', function (Blueprint $blueprint) {
            $blueprint->unsignedBigInteger('views_count')->default(0)->after('biography');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('books', function (Blueprint $blueprint) {
            $blueprint->dropColumn('views_count');
        });

        Schema::table('authors', function (Blueprint $blueprint) {
            $blueprint->dropColumn('views_count');
        });
    }
};
