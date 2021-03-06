<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTdoOrderDatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tdo_order_datas', function (Blueprint $table) {

//            $table->string('tradeNo')->comment('交易号')->primary();
//            $table->string('retailId')->comment('渠道编号');
//            $table->string('orderNo')->comment('输入订单号');
//            $table->unsignedInteger('userId')->comment('买家的用户编号');
//            $table->unsignedInteger('storeId')->comment('门店编号');
//            $table->string('storeName')->comment('门店名称')->nullable();
//            $table->integer('totalAmount')->comment('订单金额/分');
//            $table->string('subject')->comment('订单标题')->nullable();
//            $table->string('body')->comment('订单描述')->nullable();
//            $table->text('goodsDetail')->comment('订单包含的商品列表信息');
//            $table->text('extendParams')->comment('业务扩展参数')->nullable();
//            $table->text('extUserInfo')->comment('买家额外信息')->nullable();
//            $table->dateTime('payTimeout')->comment('最晚付款时间');
//            $table->integer('payAmount')->comment('买家实付金额/分')->nullable();
//            $table->integer('receiptAmount')->comment('实收金额/分')->nullable();
//            $table->string('serialNo')->comment('支付流水号')->nullable();
//            $table->integer('tradeStatus')->comment('交易状态');
//            $table->dateTime('payTime')->comment('交易支付时间')->nullable();
//            $table->dateTime('sendPayTime')->comment('打款给卖家的时间')->nullable();
            $table->string('Id')->comment('订单编号')->primary();
            $table->string('OrderNo')->comment('输入订单号');
            $table->double('Amount')->comment('订单金额/分');
            $table->string('SerialNumber')->comment('序列号')->nullable();
            $table->string('PassportId')->comment('护照身份证');
            $table->unsignedInteger('GameId')->comment('游戏编号')->nullable();
            $table->unsignedInteger('PayStatus')->comment('交易状态');
            $table->text('Signature')->comment('签名');
            $table->dateTime('CreateDate')->comment('创建日期');
            $table->string('DeviceId')->comment('设备编号')->nullable();
            $table->unsignedInteger('UserId')->comment('买家的用户编号');
            $table->unsignedInteger('ShopId')->comment('商店编号');
            $table->unsignedInteger('ExpiryDate')->comment('截止日期');
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
        Schema::dropIfExists('tdo_order_datas');
    }
}
