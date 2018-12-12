<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', [
    'namespace' => 'App\Http\Controllers\Api',
    'middleware' => ['bindings', 'serializer:array']
], function($api) {
    $api->group([
        'middleware' => 'api.throttle',
        'limit' => 50,
        'expires' => 1,
    ], function($api) {
        //首页推荐博客路由
        $api->get('recommend','ArticleController@recommend')->name('api.article.recommend');
        //博客文章分类路由
        $api->get('articles', 'ArticleController@typeIndex')->name('api.article.typeIndex');
        //文章列表
        $api->get('blogTypes/{blogType}/articles', 'ArticleController@index')->name('api.blogType.articles.index');
        //文章详情
        $api->get('articles/{article}', 'ArticleController@show')->name('api.article.show');
        //评论列表
        $api->get('articles/{article}/comments', 'CommentsController@index')->name('api.comments.index');

        //获取注册图片验证码
        $api->post('captchas', 'CaptchasController@store')->name('api.captchas.store');
        //获取手机注册短信验证码
        $api->post('smsCodes', 'SmsCodesController@store')->name('api.smsCodes.store');
        //注册
        $api->post('users', 'UsersController@store')->name('api.users.store');
        //用户登录-->获取token
        $api->post('authorizations', 'AuthorizationsController@store')->name('api.authorizations.store');
        //刷新token
        $api->put('authorizations', 'AuthorizationsController@update')->name('api.authorizations.update');

        //个人简历接口
        $api->get('my', 'MyController@me')->name('api.my.me');

        // 需要 token 验证的接口
        $api->group(['middleware' => 'api.auth'], function($api) {
            // 当前登录用户信息
            $api->get('user', 'UsersController@me')->name('api.user.show');
            // 删除token
            $api->delete('authorizations', 'AuthorizationsController@destroy')->name('api.authorizations.destroy');
            // 评论博客
            $api->post('articles/{article}/comments', 'CommentsController@store')->name('api.comments.store');
        });

    });

});

$api->version('v2', function($api) {
    $api->get('version', function() {
        return response('this is version v2');
    });
});
