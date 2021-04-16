<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserChangeLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_change_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id')->comment('所屬員工');
            $table->string('type')->comment('異動類型');
            $table->date('date')->comment('異動日期');
            $table->text('note')->nullable()->comment('異動註記');
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
        Schema::dropIfExists('user_change_logs');
    }
}
