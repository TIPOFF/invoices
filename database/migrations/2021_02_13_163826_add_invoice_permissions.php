<?php

declare(strict_types=1);

use Tipoff\Authorization\Permissions\BasePermissionsMigration;

class AddInvoicePermissions extends BasePermissionsMigration
{
    public function up()
    {
        $permissions = [
            'view invoices',
            'create invoices',
            'update invoices',
        ];

        $this->createPermissions($permissions);
    }
}
