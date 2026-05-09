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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title', 100);
            $table->string('subtitle', 100)->nullable();
            $table->text('description');
            $table->text('image')->nullable();
            $table->foreignId('author_id')->constrained('authors');
            $table->foreignId('genre_id')->constrained('genres');
            $table->foreignId('distributor_id')->constrained('distributors');
            $table->foreignId('publisher_id')->constrained('publishers');
            $table->decimal('price', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
