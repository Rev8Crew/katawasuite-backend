<?php

namespace Modules\KatawaCore\v2\Modules\Tools;

use Exception;

final class GamePath
{
    protected string $separator;

    protected string $gamePath;

    protected static ?GamePath $instance = null;

    public static function getInstance(): self
    {
        if (static::$instance === null) {
            static::$instance = new self();
        }

        return static::$instance;
    }

    public function getDirSeparator(): string
    {
        return $this->separator;
    }

    public function getRealPath(): string
    {
        return $this->gamePath.$this->getDirSeparator();
    }

    public function win(string $path)
    {
        return str_replace('\\', '/', $path);
    }

    public function exists(string $path, bool $dir = false)
    {
        return $dir ? is_dir($path) : is_file($path);
    }

    public function getBackgroundPath(): string
    {
        return $this->getRealPath().'background'.$this->getDirSeparator();
    }

    public function getBackgroundFile(string $file): string
    {
        $path = $this->getBackgroundPath().$file;

        if (! $this->exists($path)) {
            throw new Exception('File '.$path.' doesnt\'t exist');
        }

        return $path;
    }

    public function getBackgroundEventPath(): string
    {
        return $this->getBackgroundPath().'event'.$this->getDirSeparator();
    }

    public function getBackgroundEventFile(string $file): string
    {
        $path = $this->getBackgroundEventPath().$file;

        return $path;
    }

    public function getForegroundPath(): string
    {
        return $this->getRealPath().'foreground'.$this->getDirSeparator();
    }

    public function getForegroundSubPath($subPath = ''): string
    {
        $path = $this->getForegroundPath().$subPath.$this->getDirSeparator();

        return $path;
    }

    public function getForegroundSubClosePath($subPath = ''): string
    {
        return $this->getForegroundPath().$subPath.$this->getDirSeparator().'close'.$this->getDirSeparator();
    }

    public function getForegroundSubSuperClosePath($subPath = ''): string
    {
        return $this->getForegroundPath().$subPath.$this->getDirSeparator().'superclose'.$this->getDirSeparator();
    }

    public function getSoundPath(): string
    {
        return $this->getRealPath().'sound'.$this->getDirSeparator();
    }

    public function getSfxPath(string $path): string
    {
        return $this->getSoundPath().'sfx'.$this->getDirSeparator().$path;
    }

    public function setGamePath(string $gamePath): GamePath
    {
        $this->gamePath = $gamePath;

        return $this;
    }

    public function setSeparator(string $separator = DIRECTORY_SEPARATOR): GamePath
    {
        $this->separator = $separator;

        return $this;
    }
}
