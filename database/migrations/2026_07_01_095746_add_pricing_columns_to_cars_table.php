<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('cars', function (Blueprint $table) {

        $table->decimal('rent_per_hour',10,2)->after('color');

        $table->decimal('rent_per_day',10,2)->change();

        $table->decimal('rent_per_month',10,2)->after('rent_per_day');

        $table->decimal('fuel_surcharge',10,2)->default(3)->after('rent_per_month');

    });
}

public function down()
{
    Schema::table('cars', function (Blueprint $table) {

        $table->dropColumn([
            'rent_per_hour',
            'rent_per_month',
            'fuel_surcharge'
        ]);

    });
}
};
