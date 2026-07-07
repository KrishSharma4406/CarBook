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
        Schema::create('services_pages', function (Blueprint $table) {
            $table->id();

            // Hero section
            $table->string('hero_title')->nullable();
            $table->string('hero_background')->nullable();

            // Services header
            $table->string('services_subtitle')->nullable();
            $table->string('services_title')->nullable();

            // Service 1
            $table->string('service_1_icon')->nullable();
            $table->string('service_1_title')->nullable();
            $table->text('service_1_desc')->nullable();

            // Service 2
            $table->string('service_2_icon')->nullable();
            $table->string('service_2_title')->nullable();
            $table->text('service_2_desc')->nullable();

            // Service 3
            $table->string('service_3_icon')->nullable();
            $table->string('service_3_title')->nullable();
            $table->text('service_3_desc')->nullable();

            // Service 4
            $table->string('service_4_icon')->nullable();
            $table->string('service_4_title')->nullable();
            $table->text('service_4_desc')->nullable();

            // CTA Section
            $table->string('cta_title')->nullable();
            $table->string('cta_button_text')->nullable();
            $table->string('cta_button_url')->nullable();
            $table->string('cta_background')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services_pages');
    }
};
