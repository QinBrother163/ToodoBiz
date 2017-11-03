<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>飞奔游戏</title>
    <script>
        window.Laravel = {csrfToken: '{{ csrf_token() }}'};
    </script>
</head>
<body>
<div id="app">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">填写收货信息</div>
                    <div class="panel-body">
                        <p>* 您已成功订购：<span style="color: green;font-weight: bold">{{ $goodsName }}</span></p>
                        <p>* 订单号：<span style="color: red">{{ $tradeNo }}</span></p>
                        @if(empty($msg))
                            <p>* 请补全下面信息给小双哦</p>
                        @endif
                    </div>
                    <div class="panel-body">
                        @if(empty($msg))
                            <form class="form-horizontal" role="form" method="POST" action="#">
                                {{ csrf_field() }}

                                <input type="hidden" id="userId" name="userId" value="{{ $userId }}">
                                <input type="hidden" id="tradeNo" name="tradeNo" value="{{ $tradeNo }}">
                                <input type="hidden" id="goodsName" name="goodsName" value="{{ $goodsName }}">

                                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                    <label for="name" class="col-md-4 control-label">收货人</label>

                                    <div class="col-md-6">
                                        <input id="name" type="text" class="form-control" name="name"
                                               value="{{ old('name') }}" required autofocus>

                                        @if ($errors->has('name'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                                    <label for="address" class="col-md-4 control-label">地址</label>

                                    <div class="col-md-6">
                                        <input id="address" type="text" class="form-control" name="address"
                                               value="{{ old('address') }}" required autofocus>

                                        @if ($errors->has('address'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                                    <label for="phone" class="col-md-4 control-label">电话</label>

                                    <div class="col-md-6">
                                        <input id="phone" type="tel" class="form-control" name="phone"
                                               value="{{ old('phone') }}" required
                                               pattern="^(0|86|17951)?(13[0-9]|15[012356789]|17[0678]|18[0-9]|14[57])[0-9]{8}">

                                        @if ($errors->has('phone'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-4">
                                        <button type="submit" class="btn btn-primary">
                                            保存
                                        </button>
                                    </div>
                                </div>
                            </form>
                        @else
                            {{ $msg }}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{--<script src="{{ asset('js/address.js') }}"></script>--}}
</body>
</html>