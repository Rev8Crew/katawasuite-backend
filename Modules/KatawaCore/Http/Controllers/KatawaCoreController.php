<?php

namespace Modules\KatawaCore\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\KatawaCore\v2\KatawaCore;
use Illuminate\Support\Str;

class KatawaCoreController extends Controller
{
    public function json(): \Illuminate\Http\JsonResponse
    {
        $separator = PHP_EOL;

        $content = request()->getContent();
        $lines = explode($separator, $content);

        return response()->json($lines);
    }

    /**
     *  def mods_names():
     *      store.rik = Character(displayStrings.name_rik, color="FFFAFA")
     *      store.sak = Character(displayStrings.name_sak, color="F4A460")
     *
     *  displayDict['ru'].name_so = u"Соня"
     *  displayDict['ru'].name_so_ = u"Девушка"
     *  displayDict['ru'].name_hit = u"Хитоми"
     * @return \Illuminate\Support\Collection
     */
    public function getCharacters(): \Illuminate\Support\Collection
    {
        $separator = PHP_EOL;

        $content = request()->getContent();
        $lines = explode($separator, $content);

        if (Str::contain($content, "displayDict['ru'].name_") === false) {
            abort(404);
        }

        $re = '/.*\.name_(.*)\s=.*\"(.*)\"/m';
        $characterNames = collect($lines)
            ->filter(fn (string $line) => Str::contain($line, "displayDict['ru'].name_"))
            ->mapWithKeys(function (string $line) use($re) {
                $matches = [];
                preg_match_all($re, trim($line), $matches, PREG_SET_ORDER, 0);

                return [$matches[0][0] => $matches[0][1]];
            });

        # store.rik = Character(displayStrings.name_rik, color="FFFAFA")
        $re = '/.*\.name_(.*)\,\s.*\"(.*)\".*/m';
        $characterColors = collect($lines)
            ->filter(fn (string $line) => Str::contain($line, 'Character(displayStrings.name_'))
            ->mapWithKeys(function (string $line) use($re) {
                $matches = [];
                preg_match_all($re, trim($line), $matches, PREG_SET_ORDER, 0);

                return [$matches[0][0] => $matches[0][1]];
            });

        return $characterNames
            ->map(fn(string $character, string $key) => $characterColors->get($key) ?
                "<font color='$characterColors->get($key)'>$character</font>" : $character
            );
    }

    public function convert(string $short)
    {
        $in = request()->all();

        if (!in_array($short, ['sc', 'ks', 'cp', 'misha_route', 'ksa'])) {
            abort(404);
        }

        $katawa = new KatawaCore($short);
        $katawa->getLines()->fromArray($in);

        $parsed = $katawa->parse();

        //dd(Tools::getDebugCollection());
        return response($parsed, 200, ['Content-Type' => 'text/plain']);
    }
}
