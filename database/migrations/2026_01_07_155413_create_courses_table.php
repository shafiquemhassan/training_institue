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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('title', 150);
            $table->string('slug', 180)->unique();
            $table->text('excerpt');
            $table->longText('description');
            $table->string('thumbnail');       // public/courses/...
            $table->string('featured_image');  // public/courses/...
            $table->string('meta_title', 180);
            $table->text('meta_description');
            $table->dateTime('published_at');
            $table->boolean('status')->default(true);
            $table->string('video_url');
            $table->foreignId('created_by')
                  ->nullable()
                  ->constrained('users')
                  ->nullOnDelete();
            $table->timestamps();
            $table->index(['status','published_at']);
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
