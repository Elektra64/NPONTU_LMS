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
    Schema::create('course_category_mapping', function (Blueprint $table) {
        $table->foreignId('course_id')->constrained('courses')->onDelete('cascade');
        $table->foreignId('category_id')->constrained('course_categories')->onDelete('cascade');
        $table->primary(['course_id', 'category_id']);
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
