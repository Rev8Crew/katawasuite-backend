<?php

namespace App\Modules\KatawaParser\v2\Modules\GameModel;

use App\Modules\KatawaParser\v2\KatawaCore;
use App\Modules\KatawaParser\v2\Modules\Configs\Config;
use App\Modules\KatawaParser\v2\Modules\Tools\GamePath;
use App\Modules\KatawaParser\v2\Modules\Tools\Tools;

class EventModel extends ModelWith
{
    public const COMMAND = 'bg';
    public const EXTENSION = '.jpg';
    public string $path;

    public function parse(): EventModel
    {
        $path = $this->line->get(KatawaCore::ARG_SECOND);

        // TODO: fix
        $path = str_replace(array('_std', 'other_iwanako_start'), array('', 'other_iwanako_nosnow'), $path);

        $this->path = Tools::quoted($this->getSrcPath($path . self::EXTENSION));

        return $this;
    }

    public function getSrcPath($src) : string {
        $gamePath = GamePath::getInstance();

        $srcPng = str_replace('.jpg', '.png', $src);

        foreach ($this->getEventsPath($src) as $paths) {
            if ($gamePath->exists($paths['path'])) {
                if ($paths['config_value']) {
                    return "event/" . $paths['config_value']. "/" . $src;
                }

                return 'event/' . $src;
            }
        }

        foreach ($this->getEventsPath($srcPng) as $paths) {
            if ($gamePath->exists($paths['path'])) {
                if ($paths['config_value']) {
                    return "event/" . $paths['config_value']. "/" . $src;
                }

                return 'event/' . $src;
            }
        }

        dd(
            '[Event Model] File not found',
            $this->getEventsPath($src),
            $this->getEventsPath($srcPng),
            $this->line->implode(' '),
            $src
        );
    }

    public function compile(): string
    {
        $output = self::COMMAND.' '.$this->path;

        $parent = parent::compile();
        if ($parent) {
            $output .= ' ' .$parent;
        }
        return $output;
    }

    private function getEventsPath( $path ) : array {
        $gamePath = GamePath::getInstance();

        $paths = [];

        $paths[] = [
            'path' => $gamePath->getBackgroundEventFile( $path ),
            'config_value' => ''
        ];

        foreach (Config::getInstance()->getConfigValue('events_lookup_path') as $item) {
            $paths[] = [
                'path' => $gamePath->getBackgroundEventFile( $item . '/' . $path),
                'config_value' => $item
            ];
        }

        return $paths;
    }
}
