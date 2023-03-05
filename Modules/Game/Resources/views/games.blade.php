@php
    /**
     * @var \App\Modules\Game\Models\Game $game
     */
@endphp
    <!DOCTYPE html>
<html lang="ru">
<head>
    <title>{{ default_title_prefix('VNDS Online') }}</title>
    <meta charset="utf-8">
    <meta name="author" content="VaYurik [aka DOOMer]">
    <meta name="description" content="Интерпретатор VNDS">
    <link id="favicon" rel="icon" href="{{ asset('assets/games/images/vnds.png') }}">

    <script src="{{ asset('assets/games/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('assets/games/js/jquery.smoke.effect.js') }}"></script>
    <script src="{{ uncache('assets/games/js/functions.js') }}"></script>
    <script src="{{ uncache('assets/games/js/vnds.class.js') }}"></script>
    <script src="{{ uncache('assets/games/js/katawa_suite.js') }}"></script>

    <link rel="stylesheet" href="{{ asset('assets/games/css/styles.css') }}">

    <!-- Yandex.Metrika counter -->
    <script type="text/javascript" >
        (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
            m[i].l=1*new Date();
            for (var j = 0; j < document.scripts.length; j++) {if (document.scripts[j].src === r) { return; }}
            k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
        (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

        ym(89389417, "init", {
            clickmap:true,
            trackLinks:true,
            accurateTrackBounce:true,
            webvisor:true,
            ecommerce:"dataLayer"
        });
    </script>
    <noscript><div><img src="https://mc.yandex.ru/watch/89389417" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
    <!-- /Yandex.Metrika counter -->

    <script>
        window.laravel = {};
        window.laravel.url = '{{asset('')}}'
        window.laravel.game = '{{ $game->short }}'
        window.laravel.token = '{{ csrf_token() }}'
        window.laravel.game_id = '{{ $game->id }}'

        const katawa = new KatawaSuite( window.laravel.url, window.laravel.game, window.laravel.token, window.laravel.game_id,  $)

        window.laravel.katawa = katawa
        window.k = katawa
        window.$k = katawa
        window.laravel.katawa.load();

        window.laravel.set_onbeforeunload = function(){
            return true;
        };

        // function requestWithUrl(url) {
        //     return $.get( addAssetUrl(url))
        // }
        // function requestWithAjax(url, params = {}) {
        //     return $.get( addAssetUrl(url) )
        // }
        //
        // function addAssetUrl(value) {
        //     if (value.indexOf(laravel.url) !== -1) {
        //         return value;
        //     }
        //
        //     // value = String(value)
        //     // if (value.indexOf('games_list') === -1) {
        //     //     value = value.replace('games', 'game_assets')
        //     //     value = value.replace( laravel.game, laravel.game + '/' + laravel.mode)
        //     // }
        //
        //     return laravel.url + value
        // }

        function enableIOSAudio() {
            let array = ['music', 'sound', 'sfx']

            for (let id in array) {
                let elem = document.getElementById(array[id])
                elem.src = '//katawa-suite.com/test.mp3'
                elem.muted = true;
                elem.play()

                setTimeout( (elem) => {
                    elem.pause()
                    elem.muted = false
                }, 100, elem)
            }
        }

    </script>
</head>

<body>
<noscript>
    <p>Включите JavaScript!</p>
</noscript>
<audio id="music" preload="auto"></audio>
<audio id="sound" preload="auto"></audio>
<audio id="sfx" preload="auto"></audio>
<section id="main_screen">
    <h2>Выберите игру</h2>
    <section id="main_menu"></section>
</section>
<section id="game_screen" class="centered">
    <div id="overlay"></div>
    <video id="video" width="100%" height="100%" preload="auto"></video>
    <div id="background"></div>
    <div id="relay"></div>
    <section id="sprites"></section>
    <section id="game_menu" class="centered">
        <button id="game_menu_start">Начать</button>
        <button id="game_menu_cont">Продолжить</button>
        <button id="game_menu_save">Сохранить</button>
        <button id="game_menu_load">Загрузить</button>
        <button id="game_menu_delete">Удалить</button>
        <button id="game_menu_config">Настройки</button>
        <button id="game_menu_exit">Выйти из игры</button>
    </section>
    <section id="choice_menu" class="centered"></section>
    <section id="config_menu" class="centered">
        <h2>Настройки</h2>
        <label for="config_menu_text_size">Размер шрифта</label>
        <input type="range" min="0" max="2" step="1" value="0" id="config_menu_text_size">
        <div>
            <input type="checkbox" id="config_menu_is_fullscreen">
            <label for="config_menu_is_fullscreen">Полноразмерный режим</label>
        </div>
        <div>
            <input type="checkbox" id="config_menu_is_autosave">
            <label for="config_menu_is_autosave">Авто-сохранение</label>
        </div>
        <label for="config_menu_text_speed">Скорость вывода текста</label>
        <input type="range" min="0" max="20" step="1" value="5" id="config_menu_text_speed">
        <label for="config_menu_auto_text_pause">Пауза при авточтении</label>
        <input type="range" min="0" max="20" step="1" value="12" id="config_menu_auto_text_pause">
        <div>
            <input type="checkbox" id="config_menu_is_skip_unread" checked>
            <label for="config_menu_is_skip_unread">Пропускать непрочитанное</label>
        </div>
        <label for="config_menu_sound_volume">Громкость звука</label>
        <input type="range" min="0" max="9" step="1" value="5" id="config_menu_sound_volume">
        <fieldset>
            <div>
                <input type="radio" name="log" value="0" id="config_menu_log_0" checked>
                <label for="config_menu_log_0">консоль отключена</label>
            </div>
            <div>
                <input type="radio" name="log" value="1" id="config_menu_log_1">
                <label for="config_menu_log_1">команды VNDS</label>
            </div>
            <div>
                <input type="radio" name="log" value="2" id="config_menu_log_2">
                <label for="config_menu_log_2">все команды</label>
            </div>
        </fieldset>
        <button id="config_menu_exit">Закрыть</button>
    </section>
    <section id="progress_menu" class="centered">
        <button id="game_menu_save">Сохранить</button>
        <button id="game_menu_load">Загрузить</button>
        <button id="save_load_delete_remove">Удалить сохранения</button>
        <button id="progress_menu_exit">Выйти в главное меню</button>
    </section>
    <section id="save_load_menu">
        <div id="save_load_menu_left"></div>
        <div id="save_load_menu_right"></div>
    </section>
    <section id="message_box">
        <div id="message_box_menu">
            <a href="#" id="message_box_menu_load">Загрузить</a>
            <a href="#" id="message_box_menu_save">Сохранить</a>
            <a href="#" id="message_box_menu_skip">Пропуск</a>
            <a href="#" id="message_box_menu_auto">Авто</a>
            <a href="#" id="message_box_menu_sound">Звук</a>
            <a href="#" id="message_box_menu_menu">Меню</a>
            <a href="#" id="message_box_menu_help">?</a>
            <a href="#" id="message_box_menu_hide">X</a>
        </div>
        <div id="message_box_name"></div>
        <div id="message_box_text"></div>
        <a href="#" id="message_box_next">&#8680;</a>
    </section>
</section>
<section id="info">
    <ul>
        <li>Поддержка PHP: <span id="info_php_enabled"></span></li>
        <li>Экран: <span id="info_screen_resolution"></span></li>
        <li>&nbsp</li>
        <li>Игра: <span id="info_game_name"></span></li>
        <li>Разрешение: <span id="info_game_resolution"></span></li>
        <li>Скрипт: <span id="info_script_name"></span></li>
        <li>Строка: <span id="info_script_line_num"></span></li>
        <li>Цвет фона: <span id="info_bg_color"></span></li>
        <li>Фон: <span id="info_background"></span></li>
        <li>Спрайт: <span id="info_sprites"></span></li>
        <li>Анимация: <span id="info_animation"></span></li>
        <li>Видео: <span id="info_video"></span></li>
        <li>Музыка: <span id="info_music"></span></li>
        <li>Звук: <span id="info_sound"></span></li>
        <li>Звук.эффект: <span id="info_sfx"></span></li>
    </ul>
    <div id="info_show">Инфо</div>
</section>
<!--		<section id="thanks">-->
<!--			&lt;!&ndash;iframe frameborder="0" allowtransparency="true" scrolling="no" src="https://money.yandex.ru/embed/donate.xml?account=41001543226857&quickpay=donate&payment-type-choice=on&mobile-payment-type-choice=on&default-sum=200&targets=%D0%9D%D0%B0+%D1%80%D0%B0%D0%B7%D0%B2%D0%B8%D1%82%D0%B8%D0%B5+%D0%BF%D1%80%D0%BE%D0%B5%D0%BA%D1%82%D0%B0+%D0%B8+%D0%BD%D0%B0+%D0%BF%D0%B5%D1%87%D0%B5%D0%BD%D1%8C%D0%BA%D0%B8&project-name=%D0%9F%D0%B5%D1%80%D0%B5%D0%B2%D0%BE%D0%B4%D1%8B+%D0%B8+%D0%BD%D0%B5+%D1%82%D0%BE%D0%BB%D1%8C%D0%BA%D0%BE&project-site=http%3A%2F%2Fvayurik.ru&button-text=05&successURL=" width="508" height="93"></iframe&ndash;&gt;-->
<!--			<iframe src="https://money.yandex.ru/quickpay/shop-widget?writer=seller&targets=%D0%9D%D0%B0%20%D0%BF%D0%B5%D1%87%D0%B5%D0%BD%D1%8E%D1%88%D0%BA%D0%B8&targets-hint=&default-sum=200&button-text=11&payment-type-choice=on&mobile-payment-type-choice=on&hint=&successURL=&quickpay=shop&account=41001543226857" width="423" height="226" frameborder="0" allowtransparency="true" scrolling="no"></iframe>-->
<!--			<div id="thanks_show">Спасибо!</div>-->
<!--		</section>-->
<section id="version"><a href="versions.txt" target="_blank">Версия 2.6</a></section>
<section id="copy"><a href="https://vk.com/vayurik" target="_blank">&copy; VaYurik</a></section>
<section id="modal_screen">
    <div id="modal_box" class="centered">
        <div id="modal_box_text"></div>
        <button id="modal_box_next">OK</button>
    </div>
</section>
<section id="promo"><a href="#" target="_blank"></a></section>
<section id="cache"></section>

</body>
</html>
