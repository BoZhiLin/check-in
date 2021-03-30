<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('名稱');
            $table->string('username')->unique()->comment('帳戶');
            $table->string('password')->comment('密碼');
            $table->dateTime('last_login_at')->nullable()->comment('上次登入時間');
            $table->boolean('is_active')->default(true)->comment('啟用狀態');
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
        Schema::dropIfExists('admin_users');
    }
}
