<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logs', function (Blueprint $table) {
            $table->text('ip')->comment('操作IP');
            $table->text('action')->comment('動作');
            $table->text('device')->nullable()->comment('user-agent');
            $table->text('post')->comment('post');
            $table->text('get')->comment('get');
            $table->text('session')->nullable()->comment('session');
            $table->text('response')->nullable()->comment('response');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('logs');
    }
}
