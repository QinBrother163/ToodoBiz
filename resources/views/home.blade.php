<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', '飞奔游戏') }}</title>
    <link href="{{ asset('css/element-ui.css') }}" rel="stylesheet">
    {{--<script src="../../node_modules/echarts/dist/echarts.min.js" type="text/javascript"></script>--}}
    <script>
        window.Laravel = {csrfToken: '{{ csrf_token() }}'};
    </script>
    <style type="text/css">
        .el-row {
            margin-bottom: 20px;
        }

        .el-col {
            border-radius: 4px;
        }

        .bg-purple-dark {
            background: #99a9bf;
        }

        .bg-purple {
            background: #d3dce6;
        }

        .bg-purple-light {
            background: #e5e9f2;
        }

        .grid-content {
            border-radius: 4px;
            min-height: 36px;
        }

        .row-bg {
            padding: 10px 0;
            background-color: #f9fafc;
        }

        .selected_condition_style span{
            margin-left: 15px;
        }
        .selected_condition_style a{
            text-decoration: none;
            color: #000;
        }
        .selected_condition_style a:hover{
            color: #ff0000;
        }
        /*------------------------------*/

    </style>
</head>
<body>
<div id="app">
    <el-row>
        <el-col :span="24">
            <div class="grid-content bg-purple">
                <!-- Authentication Links -->
                @if (Auth::guest())
                    <span><a href="{{ route('login') }}">Login</a></span>
                    <span><a href="{{ route('register') }}">Register</a></span>
                @else

                    <span><a>Welcome, {{ Auth::user()->name }}</a></span>
                    <span>
                            <a href="{{ route('logout') }}"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                  style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </span>
                @endif
            </div>
        </el-col>
    </el-row>

    <el-row>
        <el-col :span="1">
            <div class="grid-content"></div>
        </el-col>
        <el-col :span="22">
            <trade-order></trade-order>
        </el-col>
        <el-col :span="1">
            <div class="grid-content"></div>
        </el-col>
    </el-row>
</div>
<script src="{{ asset('js/app.js?v='.md5_file(public_path('js/app.js'))) }}"></script>
</body>
</html>