<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('curriculums', function (Blueprint $table) {
            $table->boolean('always_delivery_flg')->default(0)->after('grade_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('curriculums', function (Blueprint $table) {
            $table->dropColumn('always_delivery_flg');
        });
    }
};
