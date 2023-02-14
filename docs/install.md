## WSL
c:\windows\system32\drivers\etc\hosts
- 127.0.0.1 katawa.local
- 127.0.0.1 phpmyadmin.katawa.local
- 127.0.0.1 rabbitmq.katawa.local

## Install
- sudo apt install apache2-utils
- cp .env.example .env
- make install
- make init

## PhpMyAdmin
1. Веб-интерфейс
```
https://phpmyadmin.katawa.local
server ${DB_HOST}
user ${DB_USERNAME}
password ${DB_PASSWORD}
```
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


## MySQL - если проблемы
```shell
docker-compose exec mysql bash
mysql -u root
CREATE USER 'admin'@'%' IDENTIFIED BY 'admin';
grant all on *.* to 'admin'@'%';
exit
exit
```
