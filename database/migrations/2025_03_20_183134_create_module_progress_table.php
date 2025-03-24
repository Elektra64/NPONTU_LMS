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
    Schema::create('module_progress', function (Blueprint $table) {
        $table->id();
        $table->foreignId('enrollment_id')->constrained('enrollments')->onDelete('cascade');
        $table->foreignId('module_id')->constrained('modules')->onDelete('cascade');
        $table->boolean('completed')->default(false);
        $table->timestamp('completion_date')->nullable();
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('module_progress');
    }
};
