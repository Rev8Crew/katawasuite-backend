<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use JsonMachine\Items;

class ImportPhpDbCommand extends Command
{
    protected $signature = 'import:php-db';

    protected $description = 'Command description';

    public function handle(): void
    {
        $file = base_path('h91184_katawa_suite.json');

        if (!\File::exists($file)) {
            $this->error("Can't find dump file");
            return;
        }

        $data = Items::fromFile($file);

        DB::beginTransaction();
        foreach ($data as $datum) {

            if ($datum->type !== 'table') {
                continue;
            }

            foreach ($datum->data as $item) {
                $item = (array)$item;

                if ($datum->name === 'users') {
                    unset($item['image_id']);
                }

                if ($datum->name === 'games') {
                    unset($item['team_id']);
                }

                if (isset($item['user_id']) && ($item['user_id'] === '428' || $item['user_id'] === '269')) {
                    continue;
                }

                DB::table($datum->name)->insert( (array)$item);
            }
        }

        DB::commit();
    }
}
