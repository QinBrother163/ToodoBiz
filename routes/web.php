<?php


Route::get('/', function () {
    return view('welcome');
});

Route::auth();
Route::any('register', function () {
    return '暂时不支持账号注册，请联系管理员。';
});
//$this->get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
//$this->post('register', 'Auth\RegisterController@register');

Route::get('/home', 'HomeController@index')->name('home');
Route::any('/gxgd/address', '\App\Toodo\Biz\BizController@address');
Route::any('/union/address', '\App\Toodo\Union\UnionController@address');

//管理员接口
Route::get('/toodo/trade/order','\App\Toodo\Trade\TdoOrderController@order');