<?php

declare(strict_types=1);

use Tipoff\Authorization\Permissions\BasePermissionsMigration;

class AddInvoicePermissions extends BasePermissionsMigration
{
    public function up()
    {
        $permissions = [
            'view invoice'=> ['Owner', 'Staff'],
            'create invoice' => ['Owner'],
            'update invoice' => ['Owner'],
            'delete invoice' => [],   // Admin only
        ];

        $this->createPermissions($permissions);
    }
}
