<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id')->comment('所屬用戶');
            $table->unsignedInteger('wallet_id')->comment('所屬錢包');
            $table->string('leave_type')->comment('假別');
            $table->string('type')->comment('異動類型');
            $table->integer('value')->default(0)->comment('異動額度');
            $table->integer('before')->default(0)->comment('異動前額度');
            $table->integer('after')->default(0)->comment('異動後額度');
            $table->text('link')->nullable()->comment('附屬資料');
            $table->timestamps();
            $table->softDeletes();

            $table->index([
                'user_id',
                'leave_type'
            ]);
        });

        // 打亂初始ID。
        DB::unprepared('ALTER TABLE `transactions` AUTO_INCREMENT = ' . mt_rand(100000, 200000) . ';');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
