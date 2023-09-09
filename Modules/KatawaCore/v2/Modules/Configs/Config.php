<?php

namespace Modules\KatawaCore\v2\Modules\Configs;

use Aedart\Config\Traits\ConfigLoaderTrait;
use Illuminate\Contracts\Config\Repository;

final class Config
{
    use ConfigLoaderTrait;

    protected Repository $config;

    protected string $short = '';

    public static ?Config $instance = null;

    public function __construct(string $short)
    {
        $this->getConfigLoader()->setDirectory(module_path('KatawaCore', 'v2/Configs'));
        $this->getConfigLoader()->load();

        $this->short = $short;
        $this->config = $this->getConfigLoader()->getConfig();
    }

    public function getConfigValue(string $value)
    {
        return $this->config->get($this->short.'.'.$value, []);
    }

    public static function getInstance(string $short = ''): Config
    {
        if (self::$instance === null) {
            self::$instance = new self($short);
        }

        return self::$instance;
    }
}
