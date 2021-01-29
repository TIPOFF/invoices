<?php

namespace Tipoff\Invoices;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Tipoff\Invoices\Invoices
 */
class InvoicesFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'invoices';
    }
}
