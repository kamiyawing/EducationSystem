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
        Schema::create('curriculum_progress', function (Blueprint $table) {
            $table->id();

            // リレーションに合わせたカラム名
            $table->unsignedBigInteger('curriculum_id');
            $table->unsignedBigInteger('user_id');

            // 進捗状況を tinyint で記録（初期値付き）
            $table->tinyInteger('clear_flg')->default(0);

            $table->timestamps();

            // 外部キー制約
            $table->foreign('curriculum_id')
                  ->references('id')
                  ->on('curriculums')
                  ->onDelete('cascade');

            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('curriculum_progress');
    }
};
