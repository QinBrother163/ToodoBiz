<?php

namespace App\Toodo\Trade;

use Illuminate\Database\Eloquent\Model;


class TdoEdouserData extends Model
{
    protected $fillable_ = [
        'tradeNo',
        'retailId',
        'orderNo',
        'userId',
        'storeId',
        'storeName',
        'totalAmount',
        'subject',
        'body',
        'goodsDetail',
        'extendParams',
        'extUserInfo',
        'payTimeout',
        'payAmount',
        'receiptAmount',
        'serialNo',
        'tradeStatus',
        'payTime',
        'sendPayTime',
        'created_at'
    ];

    protected $primaryKey = 'tradeNo';
    public $incrementing = false;

    protected $hidden_=[
        'extendParams',
        'extUserInfo',
        'payTimeout',
        'payAmount',
        'receiptAmount',
        'serialNo',
        'sendPayTime',
        'updated_at',
    ];
}
