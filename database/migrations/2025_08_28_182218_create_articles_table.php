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
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Başlık
            $table->text('content'); // İçerik
            $table->integer('user_id'); // Yazar ID
            $table->unsignedBigInteger('category_id'); // Kategori ID
            $table->string('image')->nullable(); // Makale resmi
            $table->integer('likes')->default(0); // Beğeni sayısı
            $table->integer('comments')->default(0); // Yorum sayısı
            $table->timestamps(); // Oluşturulma ve güncellenme
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); // Yazar
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade'); // Kategori ID
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
