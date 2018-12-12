<?php

use Illuminate\Routing\Router;

Admin::registerAuthRoutes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index');

    $router->resource('blogTypes', BlogTypeController::class);
    $router->resource('articles', ArticleController::class);
    $router->resource('users', UserController::class);
    $router->get('articles/{article}/comments', 'CommentController@aindex')->name('comment.aindex');
    $router->get('comments/today', 'CommentController@today')->name('comment.today');

    //个人简历展示页和修改页
    $router->get('mys/{my}', 'MyController@show')->name('my.show');
    $router->get('mys/{my}/edit', 'MyController@edit')->name('my.edit');
    $router->put('mys/{my}', 'MyController@update')->name('my.update');

});
