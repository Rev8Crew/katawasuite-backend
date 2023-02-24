<?php

namespace Modules\Vk\Http\Controllers;

use App\Models\Common\Response;
use Carbon\Carbon;
use Http;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VkController extends Controller
{
    /**
     *  Получаем все записи со стены сообщества в ВК (https://vk.com/katawa.suite)
     * @return Response
     */
    public function wall(): Response
    {
        $response = Response::make();

        $news = Http::get('https://api.vk.com/api.php', [
            'oauth' => 1,
            'access_token' => config('vk.access_token'),
            'method' => 'wall.get',
            'owner_id' => config('vk.wall_id'),
            'count' => 10,
            'v' => '5.131',
            'filter' => 'owner',
            'domain' => config('vk.domain'),
        ]);

        return $response->withData(collect($news->json()['response']['items'])->map(function ($item) {
            return [
                'id' => $item['id'],
                'date' => Carbon::parse($item['date'])->translatedFormat('d F Y'),
                'text' => $item['text'],
            ];
        }));
    }
}
