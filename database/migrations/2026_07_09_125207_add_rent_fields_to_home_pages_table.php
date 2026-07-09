<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('home_pages', function (Blueprint $table) {
            $table->string('rent_title')->nullable();
            $table->string('rent_step_1_icon')->nullable();
            $table->string('rent_step_1_title')->nullable();
            $table->string('rent_step_2_icon')->nullable();
            $table->string('rent_step_2_title')->nullable();
            $table->string('rent_step_3_icon')->nullable();
            $table->string('rent_step_3_title')->nullable();
            $table->string('rent_button_text')->nullable();
            $table->string('rent_button_url')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('home_pages', function (Blueprint $table) {
            $table->dropColumn([
                'rent_title',
                'rent_step_1_icon',
                'rent_step_1_title',
                'rent_step_2_icon',
                'rent_step_2_title',
                'rent_step_3_icon',
                'rent_step_3_title',
                'rent_button_text',
                'rent_button_url',
            ]);
        });
    }
};
