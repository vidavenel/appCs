@servers(['localhost' => '127.0.0.1'])

@task('deploy')
{{-- on met l'application en maintenance --}}
php artisan down
{{-- on supprime les caches --}}
php artisan route:clear
php artisan cache:clear
{{-- on defait toute les migration --}}
php artisan migrate:reset
{{-- on pull le depot git --}}
git checkout -- composer.lock
git pull
{{-- on update les dependances --}}
composer install
{{-- on refait les migrations avec les seeds --}}
php artisan migrate --seed
{{-- en remet l'application en ligne --}}
php artisan up
@endtask