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
        Schema::create('driver_applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->date('dob')->nullable();
            $table->string('city');
            $table->string('state')->nullable();
            $table->string('postal_code')->nullable();
            $table->text('address')->nullable();
            
            // Driving details
            $table->string('license_number');
            $table->date('license_expiry')->nullable();
            $table->integer('experience_years')->default(1);
            $table->string('license_document')->nullable();
            
            // Vehicle details
            $table->string('vehicle_type')->default('Sedan');
            $table->string('vehicle_make_model');
            $table->string('vehicle_year')->nullable();
            $table->string('vehicle_number');
            
            // Additional info
            $table->text('message')->nullable();
            
            // Admin management
            $table->string('status')->default('pending'); // pending, contacted, approved, rejected
            $table->text('admin_notes')->nullable();
            $table->timestamp('contacted_at')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('driver_applications');
    }
};
