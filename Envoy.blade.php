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

@task('deploy_with_docker', ['on' => 'production'])
cd {{ env('DEPLOY_PATH') }}
git pull
make install_prod
make artisan_prod migrate --force
make artisan_prod optimize
make down
make up_prod
@endtask

