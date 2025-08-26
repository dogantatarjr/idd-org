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
            $table->unsignedBigInteger('user_id'); // Yazar ID
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); // Yazar
            $table->string('image')->nullable(); // Makale resmi
            $table->integer('likes')->default(0); // Beğeni sayısı
            $table->integer('comments')->default(0); // Yorum sayısı
            $table->string('category')->nullable(); // Kategori
            $table->timestamps(); // Oluşturulma ve güncellenme tarihleri
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
