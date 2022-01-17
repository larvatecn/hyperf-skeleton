<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @see     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */

namespace App\Model\Traits;

use Hyperf\Utils\Fluent;

/**
 * @mixin \Hyperf\DbConnection\Model\Model
 * @property \Hyperf\Utils\Fluent $settings
 */
trait HasSettingsProperty
{
    /**
     * 保存设置.
     */
    public function setSettingsAttribute(array $settings)
    {
        $this->attributes['settings'] = json_encode($settings);
    }

    /**
     * 获取设置属性.
     */
    public function getSettingsAttribute(): Fluent
    {
        return new Fluent($this->getSettings());
    }

    /**
     * 获取设置.
     */
    public function getSettings(): array
    {
        return \array_replace_recursive(\defined('static::DEFAULT_SETTINGS') ? \constant('static::DEFAULT_SETTINGS') : [], \json_decode($this->attributes['settings'] ?? '{}', true) ?? []);
    }
}
