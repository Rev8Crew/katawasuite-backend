@setup
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();
@endsetup

@servers(['production' => [env('DEPLOY_USER') . '@' . env('DEPLOY_HOST')]])

@task('deploy', ['on' => 'production'])
cd {{ env('DEPLOY_PATH') }}
export SENTRY_DEPLOY_START=$(date +%s);
git pull
make command_prod 'composer i && php artisan migrate --force && php artisan optimize'
export SENTRY_RELEASE_VERSION=$(git --git-dir .git log --pretty="%h" -n1 HEAD)
export SENTRY_URL="{{ env('DEPLOY_SENTRY_URL') }}"
export SENTRY_AUTH_TOKEN="{{ env('DEPLOY_SENTRY_TOKEN') }}"
export SENTRY_ORG="{{ env('DEPLOY_SENTRY_ORG') }}"
export SENTRY_PROJECT="{{ env('DEPLOY_SENTRY_PROJECT') }}"
export ENVIRONMENT="{{ env('APP_ENV') }}"
export SENTRY_DEPLOY_END=$(date +%s);
sentry-cli --url $SENTRY_URL --auth-token $SENTRY_AUTH_TOKEN releases -o $SENTRY_ORG new -p $SENTRY_PROJECT $SENTRY_RELEASE_VERSION;
sentry-cli --url $SENTRY_URL --auth-token $SENTRY_AUTH_TOKEN releases -o $SENTRY_ORG set-commits --auto $SENTRY_RELEASE_VERSION;
sentry-cli --url $SENTRY_URL --auth-token $SENTRY_AUTH_TOKEN deploys new -o $SENTRY_ORG -p $SENTRY_PROJECT -r $SENTRY_RELEASE_VERSION -e $ENVIRONMENT -n "$SENTRY_RELEASE_NAME" -t $((SENTRY_DEPLOY_END-SENTRY_DEPLOY_START));
@endtask

@task('deploy_docker', ['on' => 'production'])
cd {{ env('DEPLOY_PATH') }}
{{--make up_prod--}}
export SENTRY_DEPLOY_START=$(date +%s);
docker-compose -f docker-compose.prod.yml restart web
docker-compose -f docker-compose.prod.yml restart queue
docker-compose -f docker-compose.prod.yml restart cron
docker-compose -f docker-compose.prod.yml restart horizon
export SENTRY_RELEASE_VERSION=$(git --git-dir .git log --pretty="%h" -n1 HEAD)
export SENTRY_URL="{{ env('DEPLOY_SENTRY_URL') }}"
export SENTRY_AUTH_TOKEN="{{ env('DEPLOY_SENTRY_TOKEN') }}"
export SENTRY_ORG="{{ env('DEPLOY_SENTRY_ORG') }}"
export SENTRY_PROJECT="{{ env('DEPLOY_SENTRY_PROJECT') }}"
export ENVIRONMENT="{{ env('APP_ENV') }}"
export SENTRY_DEPLOY_END=$(date +%s);
sentry-cli --url $SENTRY_URL --auth-token $SENTRY_AUTH_TOKEN releases -o $SENTRY_ORG new -p $SENTRY_PROJECT $SENTRY_RELEASE_VERSION;
sentry-cli --url $SENTRY_URL --auth-token $SENTRY_AUTH_TOKEN releases -o $SENTRY_ORG set-commits --auto $SENTRY_RELEASE_VERSION;
sentry-cli --url $SENTRY_URL --auth-token $SENTRY_AUTH_TOKEN deploys new -o $SENTRY_ORG -p $SENTRY_PROJECT -r $SENTRY_RELEASE_VERSION -e $ENVIRONMENT -n "$SENTRY_RELEASE_NAME" -t $((SENTRY_DEPLOY_END-SENTRY_DEPLOY_START));
@endtask

@task('deploy_build', ['on' => 'production'])
cd {{ env('DEPLOY_PATH') }}
docker-compose -f docker-compose.prod.yml build
@endtask

