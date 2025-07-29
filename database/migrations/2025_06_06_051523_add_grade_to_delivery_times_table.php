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
        Schema::table('delivery_times', function (Blueprint $table) {
            $table->string('grade')->nullable()->after('delivery_to'); // 学年のカラムを追加
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('delivery_times', function (Blueprint $table) {
            $table->dropColumn('grade'); // 追加したカラムを削除
        });
    }

};
