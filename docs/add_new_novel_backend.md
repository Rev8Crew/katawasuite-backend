# Добавление новой новеллы через backend (@deprecated)

## Шаги
 - Создать новую папку в public/games/test
 - В файле config/filesystems.php добавить линки 
```php 
'links' => [
   public_path('games/test/background') => public_path('games/ks/background'),
   public_path('games/test/font') => public_path('games/ks/background'),
   public_path('games/test/foreground') => public_path('games/ks/background'),
   public_path('games/test/sound') => public_path('games/ks/background'),
   public_path('games/test/video') => public_path('games/ks/background'),
   ] 
```
 - Скопировать оставшиеся файли из games/ks в новую папку + скопировать папку scripts
 - thumbnail.png превью картинки
 - thumbnail-high.png - фон новеллы
 - Создаем конфиг в app/Modules/KatawaParser/v2/Configs из default.php
