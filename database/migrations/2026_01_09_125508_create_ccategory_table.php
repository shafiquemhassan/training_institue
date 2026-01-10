<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('ccategory_course', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained('courses')->cascadeOnDelete();
            $table->foreignId('ccategory_id')->constrained('ccategory')->cascadeOnDelete();
            $table->unique(['course_id','ccategory_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ccategory_course');
    }
};
