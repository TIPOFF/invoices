<?php

declare(strict_types=1);

use Tipoff\Authorization\Permissions\BasePermissionsMigration;

class AddInvoicePermissions extends BasePermissionsMigration
{
    public function up()
    {
        $permissions = [
            'view invoices'=> ['Owner', 'Executive', 'Staff'],
            'create invoices' => ['Owner', 'Executive'],
            'update invoices' => ['Owner', 'Executive']
        ];

        $this->createPermissions($permissions);
    }
}
