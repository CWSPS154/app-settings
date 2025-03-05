<?php

/*
 * Copyright CWSPS154. All rights reserved.
 * @auth CWSPS154
 * @link  https://github.com/CWSPS154
 */

declare(strict_types=1);

namespace CWSPS154\AppSettings;

use CWSPS154\AppSettings\Commands\CreateSettingsTab;
use CWSPS154\AppSettings\Database\Seeders\DatabaseSeeder;
use Spatie\LaravelPackageTools\Commands\InstallCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class AppSettingsServiceProvider extends PackageServiceProvider
{
    public static string $name = 'app-settings';

    public function configurePackage(Package $package): void
    {
        $package->name(self::$name)
            ->hasConfigFile()
            ->hasViews()
            ->hasTranslations()
            ->hasMigration('create_app_settings_table')
            ->hasCommand(CreateSettingsTab::class)
            ->hasInstallCommand(function (InstallCommand $command) {
                $command
                    ->startWith(function (InstallCommand $command) {
                        $command->info('Hi Mate, Thank you for installing App Settings.');
                    })
                    ->publishConfigFile()
                    ->publishMigrations()
                    ->askToRunMigrations()
                    ->endWith(function (InstallCommand $command) {
                        if ($command->confirm('Are you using cwsps154/filament-users-roles-permissions in this project?')) {
                            $command->comment('Running seeder...');
                            $command->call('db:seed', [
                                'class' => DatabaseSeeder::class,
                            ]);
                        }
                        $command->info('I hope this package will help you to build custom settings with desired filament form Components/Input');
                        $command->askToStarRepoOnGitHub('CWSPS154/app-settings');
                    });
            });
    }

    public function boot(): AppSettingsServiceProvider
    {
        require_once __DIR__.'/helper.php';

        return parent::boot();
    }
}
