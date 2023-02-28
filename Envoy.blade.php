@setup
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();
@endsetup

@servers(['production' => [env('DEPLOY_USER') . '@' . env('DEPLOY_HOST')]])

@task('deploy', ['on' => 'production'])
cd {{ env('DEPLOY_PATH') }}
git pull
make command_prod 'composer i && php artisan migrate --force && php artisan optimize'
@endtask

@task('deploy_docker', ['on' => 'production'])
cd {{ env('DEPLOY_PATH') }}
docker-compose -f docker-compose.prod.yml restart web
@endtask

@task('deploy_build', ['on' => 'production'])
cd {{ env('DEPLOY_PATH') }}
docker-compose -f docker-compose.prod.yml build
@endtask

