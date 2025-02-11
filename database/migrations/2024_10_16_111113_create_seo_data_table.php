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
        Schema::create('seo_data', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('url', 500)->unique()->camment('Url для');
            $table->string('img', 500)->nullable()->comment('Изображение');
            $table->string('seo_title')->comment('SEO заголовок');
            $table->string('seo_description')->nullable()->comment('SEO описание');
            $table->string('page_title')->nullable()->comment('SEO заголовок');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seo_data');
    }
};
