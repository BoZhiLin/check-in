<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeavesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leaves', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->comment('所屬用戶');
            $table->date('date')->nullable()->comment('日期');
            $table->string('type')->comment('假別');
            $table->time('started_time')->nullable()->comment('開始時間');
            $table->time('ended_time')->nullable()->comment('結束時間');
            $table->integer('duration')->default(0)->comment('休假時長(秒)');
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
        Schema::dropIfExists('leaves');
    }
}
