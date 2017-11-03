<?php

namespace App\Toodo\Union;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class UnionController extends Controller
{
    public function address(Request $request)
    {
        if ($request->isMethod('get')) {
            return view('address2', [
                'userId' => $request->input('userId'),
                'tradeNo' => $request->input('tradeNo'),
                'goodsName' => $request->input('goodsName'),
                'retailId' => 10000,
            ]);
        }

        if ($request->isMethod('post')) {
            $this->validate($request, [
                'name' => 'required',
                'phone' => 'required',
                'address' => 'required',
            ]);
            $userId = $request->input('userId');
            $tradeNo = $request->input('tradeNo');
            $goodsName = $request->input('goodsName');
            $name = $request->input('name');
            $phone = $request->input('phone');
            $address = $request->input('address');

            $tradeNo = $tradeNo ? $tradeNo : '1';
            $goodsName = $goodsName ? $goodsName : '测试名称';

            $add = TdoAddress::findOrNew($tradeNo);
            $add->fill([
                'tradeNo' => $tradeNo,
                'goodsName' => $goodsName,
                'userId' => $userId ? $userId : 1,
                'name' => $name,
                'phone' => $phone,
                'address' => $address,
            ]);
            $add->save();

            $msg = "收货地址：$name $phone $address";
            return view('address', [
                'userId' => $userId,
                'tradeNo' => $tradeNo,
                'goodsName' => $goodsName,
                'msg' => $msg,
            ]);
        }
    }
}
