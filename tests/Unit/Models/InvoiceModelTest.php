<?php

declare(strict_types=1);

namespace Tipoff\Invoices\Tests\Unit\Models;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tipoff\Invoices\Models\Invoice;
use Tipoff\Invoices\Tests\TestCase;

class InvoiceModelTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function create()
    {
        $model = Invoice::factory()->create();
        $this->assertNotNull($model);
    }
}
