<?php

declare(strict_types=1);

namespace App\Middleware;

use Larva\Settings\SettingsRepository;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class ApiAuthMiddleware implements MiddlewareInterface
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * @var SettingsRepository
     */
    protected $settingsRepository;

    /**
     * 构造方法
     * @param ContainerInterface $container
     * @param SettingsRepository $settingsRepository
     */
    public function __construct(ContainerInterface $container, SettingsRepository $settingsRepository)
    {
        $this->container = $container;
        $this->settingsRepository = $settingsRepository;
    }

    /**
     * @param ServerRequestInterface $request
     * @param RequestHandlerInterface $handler
     * @return ResponseInterface
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        if (! $this->isAuth($request)) {
            return $this->container->get(\Hyperf\HttpServer\Contract\ResponseInterface::class)->raw('Forbidden')->withStatus(401);
        }
        return $handler->handle($request);
    }

    /**
     * 用户是否经过认证
     */
    public function isAuth(ServerRequestInterface $request): bool
    {
        $token = $request->getHeader('Authorization');
        if (isset($token[0]) && !empty($token[0])) {
            return $this->settingsRepository->get('api.auth_key') == $token[0];
        }
        return false;
    }
}