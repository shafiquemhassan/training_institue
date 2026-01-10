<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('ccategory', function (Blueprint $table) {
            $table->id();
            $table->string('title', 150);
            $table->string('slug', 180)->unique();
            $table->text('description')->nullable();
            $table->string('thumbnail')->nullable(); // path on 'public' disk -> ccategory/...
            $table->string('meta_title', 180)->nullable();
            $table->text('meta_description')->nullable();
            $table->boolean('status')->default(true);
            // track creator
            $table->foreignId('created_by')
                  ->nullable()
                  ->constrained('users')
                  ->nullOnDelete();
            $table->timestamps();

            $table->index(['status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ccategory');
    }
};