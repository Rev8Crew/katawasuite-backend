<?php

namespace Modules\KatawaCore\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use Modules\KatawaCore\v2\KatawaCore;
use Illuminate\Support\Str;
use Modules\KatawaCore\v2\Modules\Tools\Tools;

/**
 * Trash code here
 */
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCharacters(): \Illuminate\Http\JsonResponse
    {
        $separator = PHP_EOL;

        $content = request()->getContent();
        $lines = explode($separator, $content);

        if (Str::contains($content, "displayDict['ru'].name_") === false) {
            abort(404);
        }

        $re = '/.*\.name_(.*)\s=.*\"(.*)\"/m';

        /** @var Collection $characterNames */
        $characterNames = collect($lines)
            ->filter(fn(string $line) => Str::contains($line, "displayDict['ru'].name_"))
            ->mapWithKeys(function (string $line) use ($re) {
                $matches = [];
                preg_match_all($re, trim($line), $matches, PREG_SET_ORDER, 0);

                return [$matches[0][1] => $matches[0][2]];
            });

        # store.rik = Character(displayStrings.name_rik, color="FFFAFA")
        $re = '/.*\.name_(.*)\,\s.*\"(.*)\".*/m';

        /** @var Collection $characterNames */
        $characterColors = collect($lines)
            ->filter(fn(string $line) => Str::contains($line, 'Character(displayStrings.name_'))
            ->mapWithKeys(function (string $line) use ($re) {
                $matches = [];
                preg_match_all($re, trim($line), $matches, PREG_SET_ORDER, 0);

                if (!isset($matches[0][1]) || !isset($matches[0][2])) {
                    $re = '/.*\.name_(.*)\,\s.*/m';
                    preg_match_all($re, trim($line), $matches, PREG_SET_ORDER, 0);
                }

                if (isset($matches[0][2])) {
                    $matches[0][2] = Str::contains($matches[0][2], '#FFFFFF') ? '' : $matches[0][2];
                }

                return [$matches[0][1] => $matches[0][2] ?? ''];
            });

        return response()->json([
            'colors' => $characterNames
                ->map(fn(string $character, string $key) => $characterColors->get($key) ?
                    "<font color='" . $characterColors->get($key) . "'>$character</font>" : $character
                )->map(fn(string $charaWithColor, string $key) => 'var $' . $key.' = "' . $charaWithColor . '"')->values()->implode(PHP_EOL),
            'characters' => $characterNames
        ], 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'], JSON_UNESCAPED_UNICODE);
    }

    public function convert(string $short)
    {
        $in = request()->all();

        if (!in_array($short, ['sc', 'ks', 'cp', 'misha_route', 'ksa', 'letter_to_venus'])) {
            abort(404);
        }

        $katawa = new KatawaCore($short);
        $katawa->getLines()->fromArray($in);

        $parsed = $katawa->parse();

        #\rr\dd(Tools::getDebugCollection());
        return response($parsed, 200, ['Content-Type' => 'text/plain']);
    }
}
