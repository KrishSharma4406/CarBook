<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rides', function (Blueprint $table) {

            $table->id();

            $table->foreignId('user_id')
                ->constrained()
                ->onDelete('cascade');

            $table->string('pickup_location');

            $table->string('destination');

            $table->date('travel_date');

            $table->time('travel_time');

            $table->integer('available_seats');

            $table->decimal('fare',8,2);

            $table->string('vehicle_name');

            $table->string('vehicle_number');

            $table->text('description')->nullable();

            $table->enum('status',['active','completed','cancelled'])
                ->default('active');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rides');
    }
};