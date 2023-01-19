<?php

namespace Deployer;

require 'recipe/laravel.php';
require 'contrib/rsync.php';

set('application', 'Dawwie');
set('ssh_multiplexing', true);

set('rsync_src', function () {
    return __DIR__;
});
set('http_user', 'www-data');
set('writable_mode', 'chmod');
set('use_relative_symlink', '0');
set('release_name', function () {
    return (string) run('date +"%Y-%m-%d_%H-%M-%S"');
});

add('rsync', [
    'exclude' => [
        '.git',
        '/.env',
        '/storage/',
        '/vendor/',
        '/node_modules/',
        '.github',
        'deploy.php',
    ],
]);
set('repository','git@github.com:mindeavors/dawwie-api.git');
task('deploy:secrets', function () {
    copy(__DIR__ . '/.env.'.getenv('DOT_ENV'),__DIR__ . '/.env');
    upload('.env', get('deploy_path') . '/shared');
});
host('development')
     ->set('hostname', "18.198.187.66")
    ->set("remote_user", "ubuntu")
    ->set('deploy_path', '/var/www/dawwie')
    ->set('labels', ['stage' => 'develpment']);

after('deploy:failed', 'deploy:unlock');
desc('Generating Swagger');
task('artisan:l5-swagger:generate', artisan('l5-swagger:generate', ['showOutput']));
desc('Deploy the application');

task('deploy', [
    'deploy:unlock',
    'deploy:info',
    'deploy:prepare',
//     'deploy:lock',
//    'deploy:release',
    'rsync',
    'deploy:secrets',
    'deploy:shared',
    'deploy:vendors',
    'deploy:writable',
    'artisan:storage:link',
    'artisan:view:cache',
    'artisan:config:cache',
    'artisan:migrate',
    'artisan:queue:restart',
    'deploy:symlink',
    'deploy:unlock',
    'artisan:l5-swagger:generate',
]);
