<?php
declare(strict_types=1);
/**
 * This is NOT a freeware, use is subject to license terms.
 *
 * @copyright Copyright (c) 2010-2099 Jinan Larva Information Technology Co., Ltd.
 */

namespace App\Controller\Api\V1;

use App\Controller\AbstractController;
use App\Request\StoreSettingsRequest;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;
use Larva\Settings\SettingsRepository;

/**
 * 系统设置接口
 * @author Tongle Xu <xutongle@gmail.com>
 */
class SettingsController extends AbstractController
{
    /**
     * @Inject
     */
    protected SettingsRepository $settingsRepository;

    /**
     * 保存设置
     * @param StoreSettingsRequest $request
     * @param ResponseInterface $response
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function store(StoreSettingsRequest $request, ResponseInterface $response): \Psr\Http\Message\ResponseInterface
    {
        $setting = $request->validated();
        $this->settingsRepository->set($setting['key'], $setting['value'], $setting['type']);
        return $response->json([
            $setting['key'] => $setting['value'],
        ]);
    }
}