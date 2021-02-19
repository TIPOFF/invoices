<?php

declare(strict_types=1);

namespace Tipoff\Invoices;

use Tipoff\Invoices\Models\Invoice;
use Tipoff\Invoices\Policies\InvoicePolicy;
use Tipoff\Support\TipoffPackage;
use Tipoff\Support\TipoffServiceProvider;

class InvoicesServiceProvider extends TipoffServiceProvider
{
    public function configureTipoffPackage(TipoffPackage $package): void
    {
        $package
            ->hasPolicies([
                Invoice::class => InvoicePolicy::class,
            ])
            ->hasNovaResources([
                \Tipoff\Invoices\Nova\Invoice::class,
            ])
            ->name('invoices')
            ->hasConfigFile();
    }
}
