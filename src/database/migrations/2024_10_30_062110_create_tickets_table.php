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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();  // 整理券の一意なID
            $table->date('event_date');  // イベントの日付
            $table->dateTime('sale_start_time');  // 販売開始時間
            $table->dateTime('end_time');  // 販売終了時間
            $table->string('title');  // 整理券のタイトル
            $table->integer('balance')->default(0);  // 残り枠
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
