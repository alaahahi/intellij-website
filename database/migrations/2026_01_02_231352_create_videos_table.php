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
        Schema::create('videos', function (Blueprint $table) {
            $table->id();
            $table->string('project_route')->index(); // route name مثل 'accounting-system'
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('video_url'); // رابط YouTube أو Vimeo
            $table->string('thumbnail')->nullable(); // رابط صورة مصغرة مخصصة
            $table->string('duration')->nullable(); // مدة الفيديو (مثال: '10:30')
            $table->integer('order')->default(0); // ترتيب العرض
            $table->boolean('is_active')->default(true); // تفعيل/تعطيل الفيديو
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('videos');
    }
};
