<?php

namespace Modules\KatawaCore\v2\Modules\Tools;

use Illuminate\Support\Collection;

class Lines
{
    public Collection $lines;

    protected string $delimiter;

    public function __construct(string $delimiter = PHP_EOL)
    {
        $this->lines = collect();
        $this->delimiter = $delimiter;
    }

    public function fromArray(array $input)
    {
        return $this->parse(implode($this->delimiter, $input));
    }

    public function parse(string $str): Lines
    {
        /** Разбиваем строку на коллекцию */
        collect(explode($this->delimiter, $str))->each(function (string $line, $key) {
            // Создаем коллекцию под ключ
            $this->lines->put($key, collect());

            $addQuote = isset($line[0]) && $line[0] === '"' ? '|' : '';
            collect(Tools::explode($line))->each(function (string $word) use ($addQuote, $key) {
                /** @var Collection $collection */
                $collection = $this->lines->get($key);

                $collection->push($addQuote.$word);
                $addQuote = '';
            });
        });

        $this->lines = $this->lines->values();

        return $this;
    }

    public function get(): Collection
    {
        return $this->lines;
    }
}
