<?php

declare(strict_types=1);

namespace Tipoff\Invoices\Commands;

use Illuminate\Console\Command;

class InvoicesCommand extends Command
{
    public $signature = 'invoices';

    public $description = 'My command';

    public function handle()
    {
        $this->comment('All done');
    }
}
