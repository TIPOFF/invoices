<?php

declare(strict_types=1);

namespace Tipoff\Invoices\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Tipoff\Invoices\Models\Invoice;
use Tipoff\Support\Contracts\Models\UserInterface;

class InvoicePolicy
{
    use HandlesAuthorization;

    public function viewAny(UserInterface $user): bool
    {
        return $user->hasPermissionTo('view invoices');
    }

    public function view(UserInterface $user, Invoice $invoice): bool
    {
        return $user->hasPermissionTo('view invoices');
    }

    public function create(UserInterface $user): bool
    {
        return $user->hasPermissionTo('create invoices');
    }

    public function update(UserInterface $user, Invoice $invoice): bool
    {
        return $user->hasPermissionTo('update invoices');
    }

    public function delete(UserInterface $user, Invoice $invoice): bool
    {
        return false;
    }

    public function restore(UserInterface $user, Invoice $invoice): bool
    {
        return false;
    }

    public function forceDelete(UserInterface $user, Invoice $invoice): bool
    {
        return false;
    }
}
