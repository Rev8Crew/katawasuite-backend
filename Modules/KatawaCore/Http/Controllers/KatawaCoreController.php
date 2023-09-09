<?php

namespace Modules\KatawaCore\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\KatawaCore\v2\KatawaCore;

class KatawaCoreController extends Controller
{
    public function json(): \Illuminate\Http\JsonResponse
    {
        $separator = PHP_EOL;

        $content = request()->getContent();
        $lines = explode($separator, $content);

        return response()->json($lines);
    }

    public function convert(string $short)
    {
        $in = request()->all();

        if (! in_array($short, ['sc', 'ks', 'cp', 'misha_route', 'ksa'])) {
            abort(404);
        }

        $katawa = new KatawaCore($short);
        $katawa->getLines()->fromArray($in);

        $parsed = $katawa->parse();

        //dd(Tools::getDebugCollection());
        return response($parsed, 200, ['Content-Type' => 'text/plain']);
    }
}
