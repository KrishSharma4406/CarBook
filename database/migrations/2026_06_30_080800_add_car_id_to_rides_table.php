<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('rides', function (Blueprint $table) {

            $table->foreignId('car_id')
                ->after('user_id')
                ->constrained()
                ->cascadeOnDelete();
        });
    }

    public function down()
    {
        Schema::table('rides', function (Blueprint $table) {

            $table->dropForeign(['car_id']);
            $table->dropColumn('car_id');
        });
    }
};
