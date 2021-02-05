<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('姓名');
            $table->string('username')->unique()->comment('代號');
            $table->string('password')->comment('密碼');
            $table->string('gender')->comment('性別');
            $table->string('phone')->nullable()->comment('聯絡電話');
            $table->date('report_date')->nullable()->comment('報到日');
            $table->text('remark')->nullable()->comment('備註');
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
        Schema::dropIfExists('users');
    }
}
