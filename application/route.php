<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
use think\Route;
Route::get('index', 'index/Index/index'); //网站首页
Route::get('about', 'index/About/about'); //关于我们
Route::get('honor', 'index/About/honor'); //关于我们
Route::get('honor1/:p', 'index/About/honor'); //关于我们
Route::get('show', 'index/About/show'); //关于我们
Route::get('news', 'index/News/news'); //新闻资讯
Route::get('newsn/:id', 'index/News/newsn'); //新闻资讯
Route::get('newsy/:id/:p', 'index/News/newsn'); //新闻资讯
Route::get('newsa/:id', 'index/News/newsa'); //新闻资讯
Route::get('product', 'index/Product/product'); 
Route::get('products/:p', 'index/Product/product'); 
Route::get('productl/:id', 'index/Product/productl');
Route::get('producta/:id', 'index/Product/producta');
Route::get('productz/:id/:p', 'index/Product/productl'); 	
Route::get('solution', 'index/Solution/solution'); //工程案例
Route::get('solutiona/:id', 'index/Solution/solutiona'); //工程案例
Route::get('solutions/:p', 'index/Solution/solution'); //工程案例
Route::get('contact', 'index/Contact/contact'); //联系我们
Route::post('contact', 'index/Contact/contact'); //联系我们
// Route::post('contact', 'admin/Demo/mail'); //联系我们
Route::post('search', 'index/Search/search'); //搜索

Route::get('main', 'admin/Product/index'); 
Route::get('admin/Product/index', 'admin/Product/index'); 
Route::get('new', 'admin/Newsa/index'); 
Route::get('admin/Newsa/index', 'admin/Newsa/index'); 

return [
    '__pattern__' => [
        'name' => '\w+',
    ],
    '[hello]'     => [
        ':id'   => ['index/hello', ['method' => 'get'], ['id' => '\d+']],
        ':name' => ['index/hello', ['method' => 'post']],
    ],

];
