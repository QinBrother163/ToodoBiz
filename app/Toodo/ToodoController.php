<?php

namespace App\Toodo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ToodoController extends Controller
{
    protected $appId = '9998';
    protected $appSecret = 'BnCUM4FG00sbOXnOHPb0N8ekc2y';

    protected function biz($bizOut, $token = '')
    {
        $response = [
            'code' => 0,
            'msg' => '调用成功',
            'subCode' => '',
            'subMsg' => '',
            'timestamp' => date('Y-m-d H:i:s'),
            'sign' => '',
            'bizContent' => json_encode($bizOut),
            'token' => $token,
        ];
        $response['sign'] = ResponseBody::signCode($response, $this->appSecret);
        return $response;
    }

    public function toodo(Request $request)
    {
        //return $request->getContent();
        {   //! 输入参数检查
            $subCode = 0;
            $subMsg = '';

            if ($subCode == 0 && !isset($request['appId'])) {
                $subCode = 1;
                $subMsg = 'not set input param appId';
            }
            if ($subCode == 0 && !isset($request['method'])) {
                $subCode = 2;
                $subMsg = 'not set input param method';
            }
            if ($subCode == 0 && !isset($request['timestamp'])) {
                $subCode = 3;
                $subMsg = 'not set input param timestamp';
            }
            if ($subCode == 0 && !isset($request['signCode'])) {
                $subCode = 4;
                $subMsg = 'not set input param signCode';
            }
            if ($subCode == 0 && !isset($request['bizContent'])) {
                $subCode = 5;
                $subMsg = 'not set input param bizContent';
            }

            if ($subCode != 0) {
                return [
                    'code' => 10001, 'msg' => '输入参数缺失',
                    'subCode' => $subCode, 'subMsg' => $subMsg,
                ];
            }
        }

        $appId = $request['appId'];
        if ($appId != $this->appId) {
            return [
                'code' => 10002,
                'msg' => '找不到指定appId应用',
            ];
        }

        $md5 = RequestBody::signCode($request, $this->appSecret);
        $sign = $request['signCode'];

        if ($sign != $md5) {
            return [
                'code' => 10003,
                'msg' => '输入参数签名错误',
                'md5' => $md5,
                'sign' => $sign,
            ];
        }
        return $this->doMethod($request);
    }

    protected function doMethod($request)
    {
        $method = $request['method'];
        return [
            'code' => 10004,
            'msg' => '找不到指定method的方法',
        ];
    }

}
