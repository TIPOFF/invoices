<?php

declare(strict_types=1);

use Tipoff\Authorization\Permissions\BasePermissionsMigration;

class AddInvoicePermissions extends BasePermissionsMigration
{
    public function up()
    {
        $permissions = [
            'view invoices'=> ['Owner', 'Staff'],
            'create invoices' => ['Owner'],
            'update invoices' => ['Owner']
        ];

        $this->createPermissions($permissions);
    }
}
