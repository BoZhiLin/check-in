<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalaryLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salary_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('salary_id')->comment('所屬薪資資料');
            $table->unsignedInteger('user_id')->comment('所屬員工');
            $table->decimal('before_salary', 8, 2)->comment('原薪資');
            $table->decimal('after_salary', 8, 2)->comment('異動後薪資');
            $table->text('note')->nullable()->comment('異動原因');
            $table->timestamps();
            $table->softDeletes();

            $table->index([
                'salary_id',
                'user_id'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('salary_logs');
    }
}
