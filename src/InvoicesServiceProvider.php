<?php

namespace Tipoff\Invoices;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Tipoff\Invoices\Commands\InvoicesCommand;

class InvoicesServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('invoices')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_invoices_table')
            ->hasCommand(InvoicesCommand::class);
    }
}
