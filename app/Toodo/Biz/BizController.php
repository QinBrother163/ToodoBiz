<?php

namespace App\Toodo\Biz;

use App\Toodo\ToodoController;
use App\Toodo\Trade\TdoOrderData;
use Illuminate\Http\Request;


class BizController extends ToodoController
{
    protected function doMethod($request)
    {
        $method = $request['method'];
        if ($method == '/toodo/biz/order') return $this->order($request);

        return [
            'code' => 10004,
            'msg' => '找不到指定method的方法',
        ];
    }

    protected function order($request)
    {
        $bizContent = $request['bizContent'];
        /* @var $bizOrder TdoOrderData */
        $bizOrder = json_decode($bizContent);
        if (empty($bizOrder) || empty($bizOrder->tradeNo)) {
            return [
                'code' => 11020,
                'msg' => '上传订单信息',
                'subCode' => 2,
                'subMsg' => '输入参数错误',
            ];
        }

        $order = TdoOrderData::find($bizOrder->tradeNo);
        if ($order) {
            return [
                'code' => 11020,
                'msg' => '上传订单信息',
                'subCode' => 1,
                'subMsg' => '订单号已存在',
            ];
        }

        $order = new TdoOrderData();
        $order->fill((array)$bizOrder);
        $order->save();
        return $this->biz('success');
    }

    public function address(Request $request)
    {
//        $this->validate($request, [
//            'userId' => 'required',
//            'tradeNo' => 'required',
//            'goodsName' => 'required',
//        ]);
        if ($request->isMethod('get')) {
            return view('address', [
                'userId' => $request->input('userId'),
                'tradeNo' => $request->input('tradeNo'),
                'goodsName' => $request->input('goodsName'),
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
