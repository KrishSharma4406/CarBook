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
        Schema::create('contact_pages', function (Blueprint $table) {
            $table->id();

            // Hero section
            $table->string('hero_title')->nullable();
            $table->string('hero_background')->nullable();

            // Contact page headings
            $table->string('contact_subtitle')->nullable();
            $table->string('contact_title')->nullable();

            // Contact details
            $table->string('contact_address')->nullable();
            $table->string('contact_phone')->nullable();
            $table->string('contact_email')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_pages');
    }
};
