## WSL
c:\windows\system32\drivers\etc\hosts
127.0.0.1 katawa.test
127.0.0.1 rabbitmq.katawa.test
127.0.0.1 horizon.katawa.test
127.0.0.1 telescope.katawa.test
127.0.0.1 app.katawa.test

## Install
- sudo apt install apache2-utils
- sudo apt install make
- cp .env.example .env
- make install
- make init

## Tests
- Подключиться к бд постгреса через phpstorm, создать бд katawa-suite-test
- make refresh
- make test

## RabbitMQ
1. Заходим в контейнер
```bash
make shell
```

2. Добавление дефолтной очереди
```bash
php artisan rabbitmq:exchange-declare default
php artisan rabbitmq:queue-declare default
php artisan rabbitmq:queue-bind default default
```

3. Веб-интерфейс
- https://rabbitmq.katawa.local
