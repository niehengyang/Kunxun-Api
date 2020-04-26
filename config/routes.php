<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://doc.hyperf.io
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf-cloud/hyperf/blob/master/LICENSE
 */

use Hyperf\HttpServer\Router\Router;

Router::addRoute(['GET', 'POST', 'HEAD'], '/', 'App\Controller\IndexController@index');

/** 命令行工具的路由*/
Router::addGroup("/artisan/", function (){
    Router::addRoute("GET", "menu", "App\Controller\Web\PermissionController@menuList");
});

//登录
Router::addGroup("/auth/login/", function(){
    Router::addRoute("POST","web", "App\Controller\AuthController@webLogin");
});

/** 权限路由 */

Router::addGroup("/permission/",function(){
    Router::addRoute("POST", "create", "App\Controller\Web\PermissionController@store");
});

/** 带中间件的路由 */
Router::addGroup("/web/",function(){
//ex :     Router::post("auth/logout","App\Controller\Api\AuthController@index");

    Router::addRoute("GET", "menu", "App\Controller\Web\PermissionController@webMenuList");

},["middleware" => [App\Middleware\WebAuthMiddleware::class]]);
