<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('course_category', function (Blueprint $table) {
            $table->foreignId('course_id')->constrained()->references('id')->on('courses')->onDelete('cascade');
            $table->foreignId('category_id')->constrained()->onDelete('cascade')->references('id')->on('categories')->onDelete('cascade');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_category_mapping');
    }
};
