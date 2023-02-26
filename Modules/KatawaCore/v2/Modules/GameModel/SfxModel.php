<?php

namespace Modules\KatawaCore\v2\Modules\GameModel;

use Modules\KatawaCore\v2\KatawaCore;
use Modules\KatawaCore\v2\Modules\Configs\Config;
use Modules\KatawaCore\v2\Modules\Tools\GamePath;
use Modules\KatawaCore\v2\Modules\Tools\Tools;

class SfxModel extends Model
{
    public const COMMAND = 'sfx';

    public const EXTENSION = '.ogg';

    public string $path;

    public function parse(): SfxModel
    {
        $path = $this->line->get(KatawaCore::ARG_SECOND);
        $this->path = $this->replaceSfx($path);

        return parent::parse();
    }

    public function compile(): string
    {
        return self::COMMAND.' '.Tools::quoted('sfx/'.$this->path.self::EXTENSION);
    }

    public function replaceSfx($path): string
    {
        // Значит уже передан нормальный звук, поэтому ничего менять не надо
        if (strpos($path, '.ogg') !== false) {
            $path = str_replace('.ogg', '', $path);
            $path = str_replace('/', '_', $path);
        }
        //$path = str_replace("_", "/", $path);

        foreach (Config::getInstance()->getConfigValue('sfx_replace') as $key => $value) {
            $path = str_replace($key, $value, $path);
        }

        $gamePath = GamePath::getInstance();
        if (! $gamePath->exists($gamePath->getSfxPath($path.'.ogg')) && ! $gamePath->exists($gamePath->getSfxPath($path.'.mp3'))) {
            Tools::exitWithError('Sfx not exists',
                $gamePath->getSfxPath($path.'.ogg'),
                $this->line->implode(' ')
            );
        }

        return $path;
    }
}
