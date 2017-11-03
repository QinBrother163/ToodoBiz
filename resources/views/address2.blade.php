<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>我的收货地址</title>
    <link href="{{ asset('css/element-ui.css') }}" rel="stylesheet">
    <script>
        window.Laravel = {csrfToken: '{{ csrf_token() }}'};
    </script>
</head>
<body>
<div id="app">
    <trade-address></trade-address>
</div>
<script src="{{ asset('js/address.js?v='.md5_file(public_path('js/address.js'))) }}"></script>
</body>
</html>