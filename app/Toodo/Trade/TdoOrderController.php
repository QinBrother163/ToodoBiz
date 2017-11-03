<?php

namespace App\Toodo\Trade;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;


class TdoOrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function order(Request $request)
    {
        $size = $request->input('size', 15, 10, 20);
        //$amount = $request->input('amount');

        $begin = $request->input('begin');
        $end = $request->input('end');
        //$import = $request->input('import');//输入
        ///$OrderNo = $request->input('options');//选项

        $amount_list_arge = $request->input("amount_list_arge");
        $order_status_args = $request->input('order_status_args');
        $registerUserArgs = $request->input('registerUserArgs');

        $appTrue = '';
        $amountNumber5 = '5';//金额个数长度
        $amountNumber4 = '4';
        $amountNumber3 = '3';
        $amountNumber2 = '2';
        $amountNumber1 = '1';

        $verifyStatus5 = '5';//支付状态 【5 已成功】【1 未成功】【10 不限】
        $verifyStatus1 = '1';
        $verifyStatus10 = '10';

        if ($registerUserArgs) {// 注册用户 返回数据
            $paginate = TdoEdouserData::orderBy($registerUserArgs)->paginate($size);
            return $paginate;
        }

        if (($begin == 'NaN-NaN-NaN') && ($end == 'NaN-NaN-NaN')) {
            $begin = null;
            $end = null;
        }


        if ($order_status_args && $amount_list_arge && ($begin && $end)) {

            $amount_arr_list = explode(' ', $amount_list_arge);
            $begin = date('Y-m-d', strtotime($begin));
            $end = date('Y-m-d', strtotime($end));
            $end = date('Y-m-d', strtotime('+1 day', strtotime($end)));

            if (count($amount_arr_list) == $amountNumber5) {
                $arr_list_0 = $amount_arr_list[0];
                $arr_list_1 = $amount_arr_list[1];
                $arr_list_2 = $amount_arr_list[2];
                $arr_list_3 = $amount_arr_list[3];
                $arr_list_4 = $amount_arr_list[4];

                if ($order_status_args == $verifyStatus5) {
                    $paginate = TdoOrderData::whereIn('Amount', [$arr_list_0, $arr_list_1, $arr_list_2, $arr_list_3, $arr_list_4])->
                    where('PayStatus', $order_status_args)->
                    whereBetween('CreateDate', [$begin, $end])->
                    orderBy('CreateDate')->paginate($size);

                    $paginate_chart0 = TdoOrderData::whereIn('Amount', [$arr_list_0])->
                    where('PayStatus', $order_status_args)->
                    whereBetween('CreateDate', [$begin, $end])->
                    groupBy('date')->
                    orderBy('date', 'ASC')->
                    get([
                        DB::raw("DATE(CreateDate) as date"),
                        DB::raw("COUNT(*) as val")
                    ]);

                    $paginate_chart1 = TdoOrderData::whereIn('Amount', [$arr_list_1])->
                    where('PayStatus', $order_status_args)->
                    whereBetween('CreateDate', [$begin, $end])->
                    groupBy('date')->
                    orderBy('date', 'ASC')->
                    get([
                        DB::raw("DATE(CreateDate) as date"),
                        DB::raw("COUNT(*) as val")
                    ]);

                    $paginate_chart2 = TdoOrderData::whereIn('Amount', [$arr_list_2])->
                    where('PayStatus', $order_status_args)->
                    whereBetween('CreateDate', [$begin, $end])->
                    groupBy('date')->
                    orderBy('date', 'ASC')->
                    get([
                        DB::raw("DATE(CreateDate) as date"),
                        DB::raw("COUNT(*) as val")
                    ]);

                    $paginate_chart3 = TdoOrderData::whereIn('Amount', [$arr_list_3])->
                    where('PayStatus', $order_status_args)->
                    whereBetween('CreateDate', [$begin, $end])->
                    groupBy('date')->
                    orderBy('date', 'ASC')->
                    get([
                        DB::raw("DATE(CreateDate) as date"),
                        DB::raw("COUNT(*) as val")
                    ]);

                    $paginate_chart4 = TdoOrderData::whereIn('Amount', [$arr_list_4])->
                    where('PayStatus', $order_status_args)->
                    whereBetween('CreateDate', [$begin, $end])->
                    groupBy('date')->
                    orderBy('date', 'ASC')->
                    get([
                        DB::raw("DATE(CreateDate) as date"),
                        DB::raw("COUNT(*) as val")
                    ]);
                    return array($paginate,$paginate_chart0,$paginate_chart1,$paginate_chart2,$paginate_chart3,$paginate_chart4);
                } elseif ($order_status_args == $verifyStatus1) {
                    $paginate = TdoOrderData::whereIn('Amount', [$arr_list_0, $arr_list_1, $arr_list_2, $arr_list_3, $arr_list_4])->where('PayStatus', $order_status_args)->whereBetween('CreateDate', [$begin, $end])->orderBy('CreateDate')->paginate($size);

                    $paginate_chart0 = TdoOrderData::whereIn('Amount', [$arr_list_0])->
                    where('PayStatus', $order_status_args)->
                    whereBetween('CreateDate', [$begin, $end])->
                    groupBy('date')->
                    orderBy('date', 'ASC')->
                    get([
                        DB::raw("DATE(CreateDate) as date"),
                        DB::raw("COUNT(*) as val")
                    ]);

                    $paginate_chart1 = TdoOrderData::whereIn('Amount', [$arr_list_1])->
                    where('PayStatus', $order_status_args)->
                    whereBetween('CreateDate', [$begin, $end])->
                    groupBy('date')->
                    orderBy('date', 'ASC')->
                    get([
                        DB::raw("DATE(CreateDate) as date"),
                        DB::raw("COUNT(*) as val")
                    ]);

                    $paginate_chart2 = TdoOrderData::whereIn('Amount', [$arr_list_2])->
                    where('PayStatus', $order_status_args)->
                    whereBetween('CreateDate', [$begin, $end])->
                    groupBy('date')->
                    orderBy('date', 'ASC')->
                    get([
                        DB::raw("DATE(CreateDate) as date"),
                        DB::raw("COUNT(*) as val")
                    ]);

                    $paginate_chart3 = TdoOrderData::whereIn('Amount', [$arr_list_3])->
                    where('PayStatus', $order_status_args)->
                    whereBetween('CreateDate', [$begin, $end])->
                    groupBy('date')->
                    orderBy('date', 'ASC')->
                    get([
                        DB::raw("DATE(CreateDate) as date"),
                        DB::raw("COUNT(*) as val")
                    ]);

                    $paginate_chart4 = TdoOrderData::whereIn('Amount', [$arr_list_4])->
                    where('PayStatus', $order_status_args)->
                    whereBetween('CreateDate', [$begin, $end])->
                    groupBy('date')->
                    orderBy('date', 'ASC')->
                    get([
                        DB::raw("DATE(CreateDate) as date"),
                        DB::raw("COUNT(*) as val")
                    ]);

                    return array($paginate,$paginate_chart0,$paginate_chart1,$paginate_chart2,$paginate_chart3,$paginate_chart4);
                } elseif ($order_status_args == $verifyStatus10) {
                    $paginate = TdoOrderData::whereIn('Amount', [$arr_list_0, $arr_list_1, $arr_list_2, $arr_list_3, $arr_list_4])->
                    whereBetween('CreateDate', [$begin, $end])->orderBy('CreateDate')->paginate($size);

                    $paginate_chart0 = TdoOrderData::whereIn('Amount', [$arr_list_0])->
                    whereBetween('CreateDate', [$begin, $end])->
                    groupBy('date')->
                    orderBy('date', 'ASC')->
                    get([
                        DB::raw("DATE(CreateDate) as date"),
                        DB::raw("COUNT(*) as val")
                    ]);

                    $paginate_chart1 = TdoOrderData::whereIn('Amount', [$arr_list_1])->
                    whereBetween('CreateDate', [$begin, $end])->
                    groupBy('date')->
                    orderBy('date', 'ASC')->
                    get([
                        DB::raw("DATE(CreateDate) as date"),
                        DB::raw("COUNT(*) as val")
                    ]);

                    $paginate_chart2 = TdoOrderData::whereIn('Amount', [$arr_list_2])->
                    whereBetween('CreateDate', [$begin, $end])->
                    groupBy('date')->
                    orderBy('date', 'ASC')->
                    get([
                        DB::raw("DATE(CreateDate) as date"),
                        DB::raw("COUNT(*) as val")
                    ]);

                    $paginate_chart3 = TdoOrderData::whereIn('Amount', [$arr_list_3])->
                    whereBetween('CreateDate', [$begin, $end])->
                    groupBy('date')->
                    orderBy('date', 'ASC')->
                    get([
                        DB::raw("DATE(CreateDate) as date"),
                        DB::raw("COUNT(*) as val")
                    ]);

                    $paginate_chart4 = TdoOrderData::whereIn('Amount', [$arr_list_4])->
                    whereBetween('CreateDate', [$begin, $end])->
                    groupBy('date')->
                    orderBy('date', 'ASC')->
                    get([
                        DB::raw("DATE(CreateDate) as date"),
                        DB::raw("COUNT(*) as val")
                    ]);

                    return array($paginate,$paginate_chart0,$paginate_chart1,$paginate_chart2,$paginate_chart3,$paginate_chart4);
                }

            } elseif (count($amount_arr_list) == $amountNumber4) {
                $arr_list_0 = $amount_arr_list[0];
                $arr_list_1 = $amount_arr_list[1];
                $arr_list_2 = $amount_arr_list[2];
                $arr_list_3 = $amount_arr_list[3];
                if ($order_status_args == $verifyStatus5) {
                    $paginate = TdoOrderData::whereIn('Amount', [$arr_list_0, $arr_list_1, $arr_list_2, $arr_list_3])->
                    where('PayStatus', $order_status_args)->whereBetween('CreateDate', [$begin, $end])->orderBy('CreateDate')->paginate($size);

                    $paginate_chart0 = TdoOrderData::whereIn('Amount', [$arr_list_0])->
                    where('PayStatus', $order_status_args)->
                    whereBetween('CreateDate', [$begin, $end])->
                    groupBy('date')->
                    orderBy('date', 'ASC')->
                    get([
                        DB::raw("DATE(CreateDate) as date"),
                        DB::raw("COUNT(*) as val")
                    ]);
                    $paginate_chart1 = TdoOrderData::whereIn('Amount', [$arr_list_1])->
                    where('PayStatus', $order_status_args)->
                    whereBetween('CreateDate', [$begin, $end])->
                    groupBy('date')->
                    orderBy('date', 'ASC')->
                    get([
                        DB::raw("DATE(CreateDate) as date"),
                        DB::raw("COUNT(*) as val")
                    ]);

                    $paginate_chart2 = TdoOrderData::whereIn('Amount', [$arr_list_2])->
                    where('PayStatus', $order_status_args)->
                    whereBetween('CreateDate', [$begin, $end])->
                    groupBy('date')->
                    orderBy('date', 'ASC')->
                    get([
                        DB::raw("DATE(CreateDate) as date"),
                        DB::raw("COUNT(*) as val")
                    ]);

                    $paginate_chart3 = TdoOrderData::whereIn('Amount', [$arr_list_3])->
                    where('PayStatus', $order_status_args)->
                    whereBetween('CreateDate', [$begin, $end])->
                    groupBy('date')->
                    orderBy('date', 'ASC')->
                    get([
                        DB::raw("DATE(CreateDate) as date"),
                        DB::raw("COUNT(*) as val")
                    ]);
                    \Log::info($paginate_chart0);
                    return array($paginate,$paginate_chart0,$paginate_chart1,$paginate_chart2,$paginate_chart3);

                } elseif ($order_status_args == $verifyStatus1) {
                    $paginate = TdoOrderData::whereIn('Amount', [$arr_list_0, $arr_list_1, $arr_list_2, $arr_list_3])->
                    where('PayStatus', $order_status_args)->whereBetween('CreateDate', [$begin, $end])->orderBy('CreateDate')->paginate($size);

                    $paginate_chart0 = TdoOrderData::whereIn('Amount', [$arr_list_0])->
                    where('PayStatus', $order_status_args)->
                    whereBetween('CreateDate', [$begin, $end])->
                    groupBy('date')->
                    orderBy('date', 'ASC')->
                    get([
                        DB::raw("DATE(CreateDate) as date"),
                        DB::raw("COUNT(*) as val")
                    ]);

                    $paginate_chart1 = TdoOrderData::whereIn('Amount', [$arr_list_1])->
                    where('PayStatus', $order_status_args)->
                    whereBetween('CreateDate', [$begin, $end])->
                    groupBy('date')->
                    orderBy('date', 'ASC')->
                    get([
                        DB::raw("DATE(CreateDate) as date"),
                        DB::raw("COUNT(*) as val")
                    ]);

                    $paginate_chart2 = TdoOrderData::whereIn('Amount', [$arr_list_2])->
                    where('PayStatus', $order_status_args)->
                    whereBetween('CreateDate', [$begin, $end])->
                    groupBy('date')->
                    orderBy('date', 'ASC')->
                    get([
                        DB::raw("DATE(CreateDate) as date"),
                        DB::raw("COUNT(*) as val")
                    ]);

                    $paginate_chart3 = TdoOrderData::whereIn('Amount', [$arr_list_3])->
                    where('PayStatus', $order_status_args)->
                    whereBetween('CreateDate', [$begin, $end])->
                    groupBy('date')->
                    orderBy('date', 'ASC')->
                    get([
                        DB::raw("DATE(CreateDate) as date"),
                        DB::raw("COUNT(*) as val")
                    ]);

                    return array($paginate,$paginate_chart0,$paginate_chart1,$paginate_chart2,$paginate_chart3);
                } elseif ($order_status_args == $verifyStatus10) {
                    $paginate = TdoOrderData::whereIn('Amount', [$arr_list_0, $arr_list_1, $arr_list_2, $arr_list_3])->
                    whereBetween('CreateDate', [$begin, $end])->orderBy('CreateDate')->paginate($size);

                    $paginate_chart0 = TdoOrderData::whereIn('Amount', [$arr_list_0])->
                    whereBetween('CreateDate', [$begin, $end])->
                    groupBy('date')->
                    orderBy('date', 'ASC')->
                    get([
                        DB::raw("DATE(CreateDate) as date"),
                        DB::raw("COUNT(*) as val")
                    ]);

                    $paginate_chart1 = TdoOrderData::whereIn('Amount', [$arr_list_1])->
                    whereBetween('CreateDate', [$begin, $end])->
                    groupBy('date')->
                    orderBy('date', 'ASC')->
                    get([
                        DB::raw("DATE(CreateDate) as date"),
                        DB::raw("COUNT(*) as val")
                    ]);

                    $paginate_chart2 = TdoOrderData::whereIn('Amount', [$arr_list_2])->
                    whereBetween('CreateDate', [$begin, $end])->
                    groupBy('date')->
                    orderBy('date', 'ASC')->
                    get([
                        DB::raw("DATE(CreateDate) as date"),
                        DB::raw("COUNT(*) as val")
                    ]);

                    $paginate_chart3 = TdoOrderData::whereIn('Amount', [$arr_list_3])->
                    whereBetween('CreateDate', [$begin, $end])->
                    groupBy('date')->
                    orderBy('date', 'ASC')->
                    get([
                        DB::raw("DATE(CreateDate) as date"),
                        DB::raw("COUNT(*) as val")
                    ]);

                    return array($paginate,$paginate_chart0,$paginate_chart1,$paginate_chart2,$paginate_chart3);
                }
            } elseif (count($amount_arr_list) == $amountNumber3) {
                $arr_list_0 = $amount_arr_list[0];
                $arr_list_1 = $amount_arr_list[1];
                $arr_list_2 = $amount_arr_list[2];
                if ($order_status_args == $verifyStatus5) {
                    $paginate = TdoOrderData::whereIn('Amount', [$arr_list_0, $arr_list_1, $arr_list_2])->
                    where('PayStatus', $order_status_args)->whereBetween('CreateDate', [$begin, $end])->orderBy('CreateDate')->paginate($size);

                    $paginate_chart0 = TdoOrderData::whereIn('Amount', [$arr_list_0])->
                    where('PayStatus', $order_status_args)->
                    whereBetween('CreateDate', [$begin, $end])->
                    groupBy('date')->
                    orderBy('date', 'ASC')->
                    get([
                        DB::raw("DATE(CreateDate) as date"),
                        DB::raw("COUNT(*) as val")
                    ]);

                    \Log::info($order_status_args);

                    $paginate_chart1 = TdoOrderData::whereIn('Amount', [$arr_list_1])->
                    where('PayStatus', $order_status_args)->
                    whereBetween('CreateDate', [$begin, $end])->
                    groupBy('date')->
                    orderBy('date', 'ASC')->
                    get([
                        DB::raw("DATE(CreateDate) as date"),
                        DB::raw("COUNT(*) as val")
                    ]);

                    $paginate_chart2 = TdoOrderData::whereIn('Amount', [$arr_list_2])->
                    where('PayStatus', $order_status_args)->
                    whereBetween('CreateDate', [$begin, $end])->
                    groupBy('date')->
                    orderBy('date', 'ASC')->
                    get([
                        DB::raw("DATE(CreateDate) as date"),
                        DB::raw("COUNT(*) as val")
                    ]);

                    return array($paginate,$paginate_chart0,$paginate_chart1,$paginate_chart2);

                } elseif ($order_status_args == $verifyStatus1) {
                    $paginate = TdoOrderData::whereIn('Amount', [$arr_list_0, $arr_list_1, $arr_list_2])->
                    where('PayStatus', $order_status_args)->whereBetween('CreateDate', [$begin, $end])->orderBy('CreateDate')->paginate($size);

                    $paginate_chart0 = TdoOrderData::whereIn('Amount', [$arr_list_0])->
                    where('PayStatus', $order_status_args)->
                    whereBetween('CreateDate', [$begin, $end])->
                    groupBy('date')->
                    orderBy('date', 'ASC')->
                    get([
                        DB::raw("DATE(CreateDate) as date"),
                        DB::raw("COUNT(*) as val")
                    ]);

                    $paginate_chart1 = TdoOrderData::whereIn('Amount', [$arr_list_1])->
                    where('PayStatus', $order_status_args)->
                    whereBetween('CreateDate', [$begin, $end])->
                    groupBy('date')->
                    orderBy('date', 'ASC')->
                    get([
                        DB::raw("DATE(CreateDate) as date"),
                        DB::raw("COUNT(*) as val")
                    ]);

                    $paginate_chart2 = TdoOrderData::whereIn('Amount', [$arr_list_2])->
                    where('PayStatus', $order_status_args)->
                    whereBetween('CreateDate', [$begin, $end])->
                    groupBy('date')->
                    orderBy('date', 'ASC')->
                    get([
                        DB::raw("DATE(CreateDate) as date"),
                        DB::raw("COUNT(*) as val")
                    ]);

                    return array($paginate,$paginate_chart0,$paginate_chart1,$paginate_chart2);
                } elseif ($order_status_args == $verifyStatus10) {
                    $paginate = TdoOrderData::whereIn('Amount', [$arr_list_0, $arr_list_1, $arr_list_2])->
                    whereBetween('CreateDate', [$begin, $end])->orderBy('CreateDate')->paginate($size);

                    $paginate_chart0 = TdoOrderData::whereIn('Amount', [$arr_list_0])->
                    whereBetween('CreateDate', [$begin, $end])->
                    groupBy('date')->
                    orderBy('date', 'ASC')->
                    get([
                        DB::raw("DATE(CreateDate) as date"),
                        DB::raw("COUNT(*) as val")
                    ]);

                    $paginate_chart1 = TdoOrderData::whereIn('Amount', [$arr_list_1])->
                    whereBetween('CreateDate', [$begin, $end])->
                    groupBy('date')->
                    orderBy('date', 'ASC')->
                    get([
                        DB::raw("DATE(CreateDate) as date"),
                        DB::raw("COUNT(*) as val")
                    ]);

                    $paginate_chart2 = TdoOrderData::whereIn('Amount', [$arr_list_2])->
                    whereBetween('CreateDate', [$begin, $end])->
                    groupBy('date')->
                    orderBy('date', 'ASC')->
                    get([
                        DB::raw("DATE(CreateDate) as date"),
                        DB::raw("COUNT(*) as val")
                    ]);

                    return array($paginate,$paginate_chart0,$paginate_chart1,$paginate_chart2);
                }
            } elseif (count($amount_arr_list) == $amountNumber2) {
                $arr_list_0 = $amount_arr_list[0];
                $arr_list_1 = $amount_arr_list[1];
                if ($order_status_args == $verifyStatus5) {
                    $paginate = TdoOrderData::whereIn('Amount', [$arr_list_0, $arr_list_1])->
                    where('PayStatus', $order_status_args)->whereBetween('CreateDate', [$begin, $end])->orderBy('CreateDate')->paginate($size);

                    $paginate_chart0 = TdoOrderData::whereIn('Amount', [$arr_list_0])->
                    where('PayStatus', $order_status_args)->
                    whereBetween('CreateDate', [$begin, $end])->
                    groupBy('date')->
                    orderBy('date', 'ASC')->
                    get([
                        DB::raw("DATE(CreateDate) as date"),
                        DB::raw("COUNT(*) as val")
                    ]);

                    $paginate_chart1 = TdoOrderData::whereIn('Amount', [$arr_list_1])->
                    where('PayStatus', $order_status_args)->
                    whereBetween('CreateDate', [$begin, $end])->
                    groupBy('date')->
                    orderBy('date', 'ASC')->
                    get([
                        DB::raw("DATE(CreateDate) as date"),
                        DB::raw("COUNT(*) as val")
                    ]);

                    return array($paginate,$paginate_chart0,$paginate_chart1);
                } elseif ($order_status_args == $verifyStatus1) {
                    $paginate = TdoOrderData::whereIn('Amount', [$arr_list_0, $arr_list_1])->
                    where('PayStatus', $order_status_args)->whereBetween('CreateDate', [$begin, $end])->orderBy('CreateDate')->paginate($size);

                    $paginate_chart0 = TdoOrderData::whereIn('Amount', [$arr_list_0])->
                    where('PayStatus', $order_status_args)->
                    whereBetween('CreateDate', [$begin, $end])->
                    groupBy('date')->
                    orderBy('date', 'ASC')->
                    get([
                        DB::raw("DATE(CreateDate) as date"),
                        DB::raw("COUNT(*) as val")
                    ]);

                    $paginate_chart1 = TdoOrderData::whereIn('Amount', [$arr_list_1])->
                    where('PayStatus', $order_status_args)->
                    whereBetween('CreateDate', [$begin, $end])->
                    groupBy('date')->
                    orderBy('date', 'ASC')->
                    get([
                        DB::raw("DATE(CreateDate) as date"),
                        DB::raw("COUNT(*) as val")
                    ]);

                    return array($paginate,$paginate_chart0,$paginate_chart1);

                } elseif ($order_status_args == $verifyStatus10) {
                    $paginate = TdoOrderData::whereIn('Amount', [$arr_list_0, $arr_list_1])->
                    whereBetween('CreateDate', [$begin, $end])->orderBy('CreateDate')->paginate($size);

                    $paginate_chart0 = TdoOrderData::whereIn('Amount', [$arr_list_0])->
                    whereBetween('CreateDate', [$begin, $end])->
                    groupBy('date')->
                    orderBy('date', 'ASC')->
                    get([
                        DB::raw("DATE(CreateDate) as date"),
                        DB::raw("COUNT(*) as val")
                    ]);

                    $paginate_chart1 = TdoOrderData::whereIn('Amount', [$arr_list_1])->
                    whereBetween('CreateDate', [$begin, $end])->
                    groupBy('date')->
                    orderBy('date', 'ASC')->
                    get([
                        DB::raw("DATE(CreateDate) as date"),
                        DB::raw("COUNT(*) as val")
                    ]);

                    return array($paginate,$paginate_chart0,$paginate_chart1);

                }
            } elseif (count($amount_arr_list) == $amountNumber1) {
                $arr_list_0 = $amount_arr_list[0];
                if ($order_status_args == $verifyStatus5) {
                    $paginate = TdoOrderData::where(['Amount' => $arr_list_0, 'PayStatus' => $order_status_args])->
                    whereBetween('CreateDate', [$begin, $end])->orderBy('CreateDate')->paginate($size);

                    $paginate_chart0 = TdoOrderData::whereIn('Amount', [$arr_list_0])->
                    where('PayStatus', $order_status_args)->
                    whereBetween('CreateDate', [$begin, $end])->
                    groupBy('date')->
                    orderBy('date', 'ASC')->
                    get([
                        DB::raw("DATE(CreateDate) as date"),
                        DB::raw("COUNT(*) as val")
                    ]);
                    return array($paginate,$paginate_chart0);

                } elseif ($order_status_args == $verifyStatus1) {
                    $paginate = TdoOrderData::where(['Amount' => $arr_list_0, 'PayStatus' => $order_status_args])->
                    whereBetween('CreateDate', [$begin, $end])->orderBy('CreateDate')->paginate($size);

                    $paginate_chart0 = TdoOrderData::whereIn('Amount', [$arr_list_0])->
                    where('PayStatus', $order_status_args)->
                    whereBetween('CreateDate', [$begin, $end])->
                    groupBy('date')->
                    orderBy('date', 'ASC')->
                    get([
                        DB::raw("DATE(CreateDate) as date"),
                        DB::raw("COUNT(*) as val")
                    ]);
                    return array($paginate,$paginate_chart0);

                } elseif ($order_status_args == $verifyStatus10) {
                    $paginate = TdoOrderData::whereIn('Amount', [$arr_list_0])->
                    whereBetween('CreateDate', [$begin, $end])->orderBy('CreateDate')->paginate($size);

                    $paginate_chart0 = TdoOrderData::whereIn('Amount', [$arr_list_0])->
                    whereBetween('CreateDate', [$begin, $end])->
                    groupBy('date')->
                    orderBy('date', 'ASC')->
                    get([
                        DB::raw("DATE(CreateDate) as date"),
                        DB::raw("COUNT(*) as val")
                    ]);
                    \Log::info($paginate_chart0);
                    return array($paginate,$paginate_chart0);

                }
            }
        } elseif ($order_status_args && $amount_list_arge) {
            $amount_arr_list = explode(' ', $amount_list_arge);

            if (count($amount_arr_list) == $amountNumber5) {
                $arr_list_0 = $amount_arr_list[0];
                $arr_list_1 = $amount_arr_list[1];
                $arr_list_2 = $amount_arr_list[2];
                $arr_list_3 = $amount_arr_list[3];
                $arr_list_4 = $amount_arr_list[4];

                if ($order_status_args == $verifyStatus5) {
                    $paginate = TdoOrderData::whereIn('Amount', [$arr_list_0, $arr_list_1, $arr_list_2, $arr_list_3, $arr_list_4])->where('PayStatus', $order_status_args)->orderBy('CreateDate')->paginate($size);
                    return array($paginate,$appTrue);
                } elseif ($order_status_args == $verifyStatus1) {
                    $paginate = TdoOrderData::whereIn('Amount', [$arr_list_0, $arr_list_1, $arr_list_2, $arr_list_3, $arr_list_4])->where('PayStatus', $order_status_args)->orderBy('CreateDate')->paginate($size);
                    return array($paginate,$appTrue);
                } elseif ($order_status_args == $verifyStatus10) {
                    $paginate = TdoOrderData::whereIn('Amount', [$arr_list_0, $arr_list_1, $arr_list_2, $arr_list_3, $arr_list_4])->orderBy('CreateDate')->paginate($size);
                    return array($paginate,$appTrue);
                }

            } elseif (count($amount_arr_list) == $amountNumber4) {
                $arr_list_0 = $amount_arr_list[0];
                $arr_list_1 = $amount_arr_list[1];
                $arr_list_2 = $amount_arr_list[2];
                $arr_list_3 = $amount_arr_list[3];
                if ($order_status_args == $verifyStatus5) {
                    $paginate = TdoOrderData::whereIn('Amount', [$arr_list_0, $arr_list_1, $arr_list_2, $arr_list_3])->where('PayStatus', $order_status_args)->orderBy('CreateDate')->paginate($size);
                    return array($paginate,$appTrue);
                } elseif ($order_status_args == $verifyStatus1) {
                    $paginate = TdoOrderData::whereIn('Amount', [$arr_list_0, $arr_list_1, $arr_list_2, $arr_list_3])->where('PayStatus', $order_status_args)->orderBy('CreateDate')->paginate($size);
                    return array($paginate,$appTrue);
                } elseif ($order_status_args == $verifyStatus10) {
                    $paginate = TdoOrderData::whereIn('Amount', [$arr_list_0, $arr_list_1, $arr_list_2, $arr_list_3])->orderBy('CreateDate')->paginate($size);
                    return array($paginate,$appTrue);
                }
            } elseif (count($amount_arr_list) == $amountNumber3) {
                $arr_list_0 = $amount_arr_list[0];
                $arr_list_1 = $amount_arr_list[1];
                $arr_list_2 = $amount_arr_list[2];
                if ($order_status_args == $verifyStatus5) {
                    $paginate = TdoOrderData::whereIn('Amount', [$arr_list_0, $arr_list_1, $arr_list_2])->where('PayStatus', $order_status_args)->orderBy('CreateDate')->paginate($size);
                    return array($paginate,$appTrue);
                } elseif ($order_status_args == $verifyStatus1) {
                    $paginate = TdoOrderData::whereIn('Amount', [$arr_list_0, $arr_list_1, $arr_list_2])->where('PayStatus', $order_status_args)->orderBy('CreateDate')->paginate($size);
                    return array($paginate,$appTrue);
                } elseif ($order_status_args == $verifyStatus10) {
                    $paginate = TdoOrderData::whereIn('Amount', [$arr_list_0, $arr_list_1, $arr_list_2])->orderBy('CreateDate')->paginate($size);
                    return array($paginate,$appTrue);
                }
            } elseif (count($amount_arr_list) == $amountNumber2) {
                $arr_list_0 = $amount_arr_list[0];
                $arr_list_1 = $amount_arr_list[1];
                if ($order_status_args == $verifyStatus5) {
                    $paginate = TdoOrderData::whereIn('Amount', [$arr_list_0, $arr_list_1])->where('PayStatus', $order_status_args)->orderBy('CreateDate')->paginate($size);
                    return array($paginate,$appTrue);
                } elseif ($order_status_args == $verifyStatus1) {
                    $paginate = TdoOrderData::whereIn('Amount', [$arr_list_0, $arr_list_1])->where('PayStatus', $order_status_args)->orderBy('CreateDate')->paginate($size);
                    return array($paginate,$appTrue);
                } elseif ($order_status_args == $verifyStatus10) {
                    $paginate = TdoOrderData::whereIn('Amount', [$arr_list_0, $arr_list_1])->orderBy('CreateDate')->paginate($size);
                    return array($paginate,$appTrue);
                }
            } elseif (count($amount_arr_list) == $amountNumber1) {
                $arr_list_0 = $amount_arr_list[0];
                if ($order_status_args == $verifyStatus5) {
                    $paginate = TdoOrderData::where(['Amount' => $arr_list_0, 'PayStatus' => $order_status_args])->orderBy('CreateDate')->paginate($size);
                    return array($paginate,$appTrue);
                } elseif ($order_status_args == $verifyStatus1) {
                    $paginate = TdoOrderData::where(['Amount' => $arr_list_0, 'PayStatus' => $order_status_args])->orderBy('CreateDate')->paginate($size);
                    return array($paginate,$appTrue);
                } elseif ($order_status_args == $verifyStatus10) {
                    $paginate = TdoOrderData::where('Amount', $arr_list_0)->orderBy('CreateDate')->paginate($size);
                    return array($paginate,$appTrue);
                }
            }
        }

        $paginate_chart = TdoOrderData::whereBetween('CreateDate', ['1900-1-1', '9999-12-31'])->
        groupBy('date')->
        orderBy('date', 'DESC')->
        get([
            DB::raw("DATE(CreateDate) as date"),
            DB::raw("COUNT(*) as val")
        ]);
        $paginate = TdoOrderData::orderBy('OrderNo')->paginate($size);
        return array($paginate,$appTrue);
    }
}
