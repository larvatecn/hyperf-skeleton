<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
use Hyperf\HttpServer\Router\Router;

Router::addRoute(['GET', 'POST', 'HEAD'], '/', 'App\Controller\IndexController@index');

/**
 * Api 接口
 */
Router::addGroup('/api/v1', function () {
    Router::post('/settings', 'App\Controller\Api\V1\SettingsController@store'); //保存系统设置

}, ['middleware' => [\App\Middleware\ApiAuthMiddleware::class]]);