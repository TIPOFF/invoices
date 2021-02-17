<?php

declare(strict_types=1);

namespace Tipoff\Invoices\Tests;

use Spatie\Permission\PermissionServiceProvider;
use Tipoff\Authorization\AuthorizationServiceProvider;
use Tipoff\Invoices\InvoicesServiceProvider;
use Tipoff\Support\SupportServiceProvider;
use Tipoff\TestSupport\BaseTestCase;

class TestCase extends BaseTestCase
{
    protected function getPackageProviders($app)
    {
        return [
            SupportServiceProvider::class,
            AuthorizationServiceProvider::class,
            PermissionServiceProvider::class,
            InvoicesServiceProvider::class,
        ];
    }
}
