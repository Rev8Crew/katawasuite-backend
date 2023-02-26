<?php

namespace Modules\KatawaCore\v2\Modules\GameModel;

use Modules\KatawaCore\v2\KatawaCore;
use Modules\KatawaCore\v2\Modules\Configs\Config;
use Modules\KatawaCore\v2\Modules\Tools\GamePath;
use Modules\KatawaCore\v2\Modules\Tools\Tools;

class MusicModel extends Model
{
    public const COMMAND = "music";
    public string $duration = '';
    public string $src;
    public string $command;

    public function parse(): MusicModel
    {
        foreach ([KatawaCore::ARG_THIRD, KatawaCore::ARG_FOURTH] as $key) {
            $duration = $this->line->get($key);

            if (is_numeric($duration)) {
                $this->duration = Tools::endWithS($duration);
                break;
            }
        }

        $src = $this->line->get(KatawaCore::ARG_SECOND);
        $this->src = $this->getMusicPath($src);

        $this->command = $this->line->get(KatawaCore::ARG_FIRST);

        return parent::parse();
    }

    public function stop(): MusicModel
    {
        $this->command = self::COMMAND;
        $this->src = '~';

        $duration = $this->line->get(KatawaCore::ARG_FOURTH);

        if ($duration) {
            $this->duration = Tools::endWithS($duration);
        }

        return $this;
    }

    public function compile(): string
    {
        return $this->command . ' ' . $this->src . ' ' . 'easy' . ' ' . $this->duration;
    }

    public function getMusicPath(string $string) {

        foreach (Config::getInstance()->getConfigValue('music_replace') as $key => $value) {
            $string = str_replace($key, $value, $string);
        }

        return $string;
    }
}
