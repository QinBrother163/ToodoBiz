<?php

namespace App\Toodo\Biz;

use Illuminate\Database\Eloquent\Model;

class TdoAddress extends Model
{
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable = [
        'tradeNo',
        'goodsName',
        'userId',
        'name',
        'phone',
        'address',
    ];
    protected $primaryKey = 'tradeNo';
}
