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
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('title');                         // Заголовок страницы
            $table->string('slug')->unique();                // ЧПУ: privacy, about
            $table->longText('content')->nullable();         // Текст страницы (HTML)
            $table->string('meta_title')->nullable();        // SEO: title
            $table->string('meta_description')->nullable();  // SEO: description
            $table->boolean('is_published')->default(true);  // Показывать на сайте
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};
