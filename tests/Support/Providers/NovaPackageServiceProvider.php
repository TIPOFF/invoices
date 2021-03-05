<?php

declare(strict_types=1);

namespace Tipoff\Invoices\Tests\Support\Providers;

use Tipoff\Invoices\Nova\Invoice;
use Tipoff\TestSupport\Providers\BaseNovaPackageServiceProvider;

class NovaPackageServiceProvider extends BaseNovaPackageServiceProvider
{
    public static array $packageResources = [
        Invoice::class,
    ];
}
