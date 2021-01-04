<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCheckInRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('check_in_records', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->comment('所屬用戶');
            $table->string('status')->comment('狀態');
            $table->timestamp('sign_in_at')->nullable()->comment('簽到時間');
            $table->timestamp('sign_out_at')->nullable()->comment('簽退時間');
            $table->double('duration')->default(0)->comment('總時長');
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
        Schema::dropIfExists('check_in_records');
    }
}
