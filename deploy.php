<?php
namespace Deployer;

require 'recipe/laravel.php';


set('bin/yarn', function () {
    return (string)run('which yarn');
});
desc('Install Yarn packages');

task('yarn:install', function () {
    if (has('previous_release')) {
        if (test('[ -d {{previous_release}}/node_modules ]')) {
            run('cp -R {{previous_release}}/node_modules {{release_path}}');
        }
    }
    run("cd {{release_path}} && {{bin/yarn}}");
});

task('yarn:production', function () {
    run("cd {{release_path}} && {{bin/yarn}} production-silent");
});
// Configure servers

// Configuration

set('repository', 'https://github.com/nipeharefa/IShoupBuddy');
set('ssh_type', 'native');
set('writable_use_sudo', false);
set('permission_method', 'chmod_777');
set('http_user', 'root');
// set('git_tty', true); // [Optional] Allocate tty for git on first deployment
add('shared_files',
    ['.env', 'resources/assets/js/lib/pusher-conf.js']
);
// add('shared_dirs', []);
// add('writable_dirs', []);
inventory('hosts.yml');

task('upload:env', function () {
    run('yarn production');
})->desc('Environment setup');

desc('Deploy your project');
task('deploy', [
    'deploy:prepare',
    'deploy:lock',
    'deploy:release',
    'deploy:update_code',
    'deploy:shared',
    'yarn:install',
    'yarn:production',
    'deploy:vendors',
    'deploy:writable',
    'artisan:view:clear',
    'artisan:route:cache',
    'artisan:optimize',
    'deploy:symlink',
    'artisan:cache:clear',
    'deploy:unlock',
    'cleanup',
]);

after('deploy:failed', 'deploy:unlock');
