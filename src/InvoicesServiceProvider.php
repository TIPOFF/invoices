<?php

declare(strict_types=1);

namespace Tipoff\Invoices;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class InvoicesServiceProvider extends PackageServiceProvider
{
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        parent::boot();
    }

    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('invoices')
            ->hasConfigFile();
    }
}
