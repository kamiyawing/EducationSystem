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
        Schema::create('deliveries', function (Blueprint $table) {
            $table->id();
            $table->string('title');                    // 配信タイトル
            $table->text('description')->nullable();    // 配信説明（任意）
            $table->string('thumbnail')->nullable();    // サムネイル画像のパス（任意）
            $table->timestamp('start_time')->nullable();  // 配信開始時間（任意）
            $table->timestamp('end_time')->nullable();    // 配信終了時間（任意）
            $table->string('video_path')->nullable();     // 動画ファイルのパス（任意）
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('deliveries');
    }
};
