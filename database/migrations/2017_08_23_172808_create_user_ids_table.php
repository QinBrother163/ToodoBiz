<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserIdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tdo_edouser_datas', function (Blueprint $table) {
            $table->string('UserId')->comment('订单编号')->primary();
            $table->string('NickName')->comment('全家e动用户');
            $table->string('PassportId')->comment('护照身份证');
            $table->string('RetailId')->comment('零售编号');
            $table->string('Items')->comment('项目');
            $table->string('bizContent')->comment('商务内容');
            $table->unsignedInteger('buyHand')->comment('买手');
            $table->string('phone')->comment('电话')->nullable();
            $table->unsignedInteger('vipGrade')->comment('贵宾等级');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tdo_edouser_datas');
    }
}
