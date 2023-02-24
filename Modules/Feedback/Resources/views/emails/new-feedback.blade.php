@php
    /** @var \Modules\Feedback\Entities\Feedback $feedback */
@endphp
<!doctype html>
<html lang="ru">
<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <title>Новый отзыв Katawa Suite</title>
    <meta name="description" content="Новый отзыв Katawa Suite.">
    <style type="text/css">
        a:hover {text-decoration: underline !important;}
    </style>
</head>
<body marginheight="0" topmargin="0" marginwidth="0" style="margin: 0px; background-color: #f2f3f8;" leftmargin="0">
<p>
    Email: {{ $feedback->email }}
    Текст: {{ $feedback->text }}
</p>
</body>
</html>
