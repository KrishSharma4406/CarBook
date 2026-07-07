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
        Schema::table('home_pages', function (Blueprint $table) {
            // About section
            $table->string('about_subtitle')->nullable();
            $table->string('about_title')->nullable();
            $table->text('about_description')->nullable();
            $table->string('about_image')->nullable();

            // Services section
            $table->string('services_subtitle')->nullable();
            $table->string('services_title')->nullable();

            $table->string('service_1_icon')->nullable();
            $table->string('service_1_title')->nullable();
            $table->text('service_1_desc')->nullable();

            $table->string('service_2_icon')->nullable();
            $table->string('service_2_title')->nullable();
            $table->text('service_2_desc')->nullable();

            $table->string('service_3_icon')->nullable();
            $table->string('service_3_title')->nullable();
            $table->text('service_3_desc')->nullable();

            $table->string('service_4_icon')->nullable();
            $table->string('service_4_title')->nullable();
            $table->text('service_4_desc')->nullable();

            // CTA section
            $table->string('cta_title')->nullable();
            $table->string('cta_button_text')->nullable();
            $table->string('cta_button_url')->nullable();
            $table->string('cta_background')->nullable();

            // Testimonials section headings
            $table->string('testimonial_subtitle')->nullable();
            $table->string('testimonial_title')->nullable();

            // Blog section headings
            $table->string('blog_subtitle')->nullable();
            $table->string('blog_title')->nullable();

            // Counters section
            $table->integer('counter_1_number')->nullable();
            $table->string('counter_1_label')->nullable();

            $table->integer('counter_2_number')->nullable();
            $table->string('counter_2_label')->nullable();

            $table->integer('counter_3_number')->nullable();
            $table->string('counter_3_label')->nullable();

            $table->integer('counter_4_number')->nullable();
            $table->string('counter_4_label')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('home_pages', function (Blueprint $table) {
            $table->dropColumn([
                'about_subtitle', 'about_title', 'about_description', 'about_image',
                'services_subtitle', 'services_title',
                'service_1_icon', 'service_1_title', 'service_1_desc',
                'service_2_icon', 'service_2_title', 'service_2_desc',
                'service_3_icon', 'service_3_title', 'service_3_desc',
                'service_4_icon', 'service_4_title', 'service_4_desc',
                'cta_title', 'cta_button_text', 'cta_button_url', 'cta_background',
                'testimonial_subtitle', 'testimonial_title',
                'blog_subtitle', 'blog_title',
                'counter_1_number', 'counter_1_label',
                'counter_2_number', 'counter_2_label',
                'counter_3_number', 'counter_3_label',
                'counter_4_number', 'counter_4_label',
            ]);
        });
    }
};
