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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->text('intro_content')->nullable();
            $table->string('difficulty_level')->nullable();
            $table->timestamp('duration')->nullable();
            $table->enum('status', ['draft', 'published']);
            $table->unsignedBigInteger('created_by')->nullable();
            $table->foreign('created_by')->constrained()->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
