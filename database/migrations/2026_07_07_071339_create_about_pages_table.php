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
        Schema::create('about_pages', function (Blueprint $table) {
            $table->id();
            
            // Hero section
            $table->string('hero_title')->nullable();
            $table->string('hero_background')->nullable();
            
            // About section
            $table->string('about_subtitle')->nullable();
            $table->string('about_title')->nullable();
            $table->text('about_description')->nullable();
            $table->string('about_image')->nullable();
            
            // CTA section
            $table->string('cta_title')->nullable();
            $table->string('cta_button_text')->nullable();
            $table->string('cta_button_url')->nullable();
            $table->string('cta_background')->nullable();
            
            // Testimonials
            $table->string('testimonial_subtitle')->nullable();
            $table->string('testimonial_title')->nullable();
            
            // Counters
            $table->integer('counter_1_number')->nullable();
            $table->string('counter_1_label')->nullable();
            $table->integer('counter_2_number')->nullable();
            $table->string('counter_2_label')->nullable();
            $table->integer('counter_3_number')->nullable();
            $table->string('counter_3_label')->nullable();
            $table->integer('counter_4_number')->nullable();
            $table->string('counter_4_label')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('about_pages');
    }
};
