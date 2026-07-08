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
    Schema::table('ride_bookings', function (Blueprint $table) {
        $columnsToDrop = [];
        foreach (['amount', 'payment_method', 'payment_status', 'transaction_id'] as $column) {
            if (Schema::hasColumn('ride_bookings', $column)) {
                $columnsToDrop[] = $column;
            }
        }
        if (!empty($columnsToDrop)) {
            $table->dropColumn($columnsToDrop);
        }
    });
}

public function down(): void
{
    Schema::table('ride_bookings', function (Blueprint $table) {

        $table->decimal('amount',10,2)->nullable();

        $table->string('payment_method')->nullable();

        $table->string('payment_status')->nullable();

        $table->string('transaction_id')->nullable();

    });
}
};
