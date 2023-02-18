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

@task('restart_docker', ['on' => 'production'])
cd {{ env('DEPLOY_PATH') }}
make restart_prod
@endtask

