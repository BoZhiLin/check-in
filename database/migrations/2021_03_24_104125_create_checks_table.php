<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChecksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('checks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->comment('所屬用戶');
            $table->date('date')->nullable()->comment('日期');
            $table->time('started_time')->nullable()->comment('簽到時間');
            $table->time('ended_time')->nullable()->comment('簽退時間');
            $table->integer('duration')->default(0)->comment('工作時長(秒)');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('checks');
    }
}
