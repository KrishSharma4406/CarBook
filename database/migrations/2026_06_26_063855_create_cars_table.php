<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cars', function (Blueprint $table) {

            $table->id();

            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            $table->string('car_name');

            $table->string('brand');

            $table->string('model');

            $table->string('registration_number');

            $table->year('manufacturing_year');

            $table->string('fuel_type');

            $table->string('transmission');

            $table->string('color');

            $table->decimal('rent_per_day',10,2);

            $table->text('description')->nullable();

            $table->string('image')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};