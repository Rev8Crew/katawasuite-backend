@setup
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();
@endsetup

@servers(['production' => [env('DEPLOY_USER') . '@' . env('DEPLOY_HOST')]])

@task('deploy', ['on' => 'production'])
cd {{ env('DEPLOY_PATH') }}
git pull
docker-compose -f docker-compose.prod.yml exec web composer install --ansi --prefer-dist
{{--make artisan_prod "migrate --force"--}}
docker-compose -f docker-compose.prod.yml exec web "php artisan migrate --force"
docker-compose -f docker-compose.prod.yml exec web php artisan optimize
make ps
@endtask

@task('deploy_with_docker', ['on' => 'production'])
cd {{ env('DEPLOY_PATH') }}
git pull
make install_prod
make artisan_prod migrate --force
make artisan_prod optimize
make down
make up_prod
@endtask

