@setup
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();
@endsetup

@servers(['production' => [env('DEPLOY_USER') . '@' . env('DEPLOY_HOST')]])

@task('deploy', ['on' => 'production'])
cd {{ env('DEPLOY_PATH') }}
git pull
make install_prod
make artisan migrate
make artisan optimize
@endtask

@task('deploy_with_docker', ['on' => 'production'])
cd {{ env('DEPLOY_PATH') }}
git pull
make install_prod
make artisan migrate
make artisan optimize
make down
make up_prod
@endtask

