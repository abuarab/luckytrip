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
        Schema::create('airport_translations', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('airport_id');
            $table->foreign('airport_id')->references('id')->on('airports')->onDelete('cascade');
            $table->string('language_code', 2);
            $table->string('name', 60);
            $table->text('description');
            $table->text('terms_and_conditions')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('airport_translations');
    }
};
