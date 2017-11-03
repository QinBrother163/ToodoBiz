<?php
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Toodo\Biz{
/**
 * App\Toodo\Biz\TdoAddress
 *
 * @property string $tradeNo
 * @property string $goodsName
 * @property int $userId
 * @property string $name
 * @property string $phone
 * @property string $address
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Biz\TdoAddress whereAddress($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Biz\TdoAddress whereGoodsName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Biz\TdoAddress whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Biz\TdoAddress wherePhone($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Biz\TdoAddress whereTradeNo($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Biz\TdoAddress whereUserId($value)
 */
	class TdoAddress extends \Eloquent {}
}

namespace App\Toodo\Trade{
/**
 * App\Toodo\Trade\TdoOrderData
 *
 * @property string $tradeNo 交易号
 * @property string $retailId 渠道编号
 * @property string $orderNo 输入订单号
 * @property int $userId 买家的用户编号
 * @property int $storeId 门店编号
 * @property string $storeName 门店名称
 * @property int $totalAmount 订单金额/分
 * @property string $subject 订单标题
 * @property string $body 订单描述
 * @property string $goodsDetail 订单包含的商品列表信息
 * @property string $extendParams 业务扩展参数
 * @property string $extUserInfo 买家额外信息
 * @property string $payTimeout 最晚付款时间
 * @property int $payAmount 买家实付金额/分
 * @property int $receiptAmount 实收金额/分
 * @property string $serialNo 支付流水号
 * @property int $tradeStatus 交易状态
 * @property string $payTime 交易支付时间
 * @property string $sendPayTime 打款给卖家的时间
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Trade\TdoOrderData whereBody($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Trade\TdoOrderData whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Trade\TdoOrderData whereExtUserInfo($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Trade\TdoOrderData whereExtendParams($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Trade\TdoOrderData whereGoodsDetail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Trade\TdoOrderData whereOrderNo($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Trade\TdoOrderData wherePayAmount($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Trade\TdoOrderData wherePayTime($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Trade\TdoOrderData wherePayTimeout($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Trade\TdoOrderData whereReceiptAmount($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Trade\TdoOrderData whereRetailId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Trade\TdoOrderData whereSendPayTime($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Trade\TdoOrderData whereSerialNo($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Trade\TdoOrderData whereStoreId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Trade\TdoOrderData whereStoreName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Trade\TdoOrderData whereSubject($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Trade\TdoOrderData whereTotalAmount($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Trade\TdoOrderData whereTradeNo($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Trade\TdoOrderData whereTradeStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Trade\TdoOrderData whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Toodo\Trade\TdoOrderData whereUserId($value)
 */
	class TdoOrderData extends \Eloquent {}
}

namespace App{
/**
 * App\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $remember_token
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Passport\Client[] $clients
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Passport\Token[] $tokens
 * @method static \Illuminate\Database\Query\Builder|\App\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User wherePassword($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereRememberToken($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

