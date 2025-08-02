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
        Schema::create('delivery_times', function (Blueprint $table) {
            $table->id();

            // リレーションと整合性を保つ
            $table->unsignedBigInteger('curriculum_id');

            // モデルに合わせて命名した時刻カラム
            $table->dateTime('start_time')->nullable(false);
            $table->dateTime('end_time')->nullable(false);

            $table->timestamps();

            // 外部キー制約（カリキュラム削除時に連動）
            $table->foreign('curriculum_id')
                  ->references('id')
                  ->on('curriculums')
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
        Schema::dropIfExists('delivery_times');
    }
};
