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
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('phone', 14)->nullable();
            $table->string('cell_phone', 15);
            $table->string('email', 100);
            $table->string('homepage', 200)->nullable();
            $table->string('facebook_profile', 200)->nullable();
            $table->string('product_info', 200)->nullable();
            $table->string('gender', 9);
            $table->string('profession', 60);
            $table->text('suggestion')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
