<?php

declare(strict_types=1);

namespace Tipoff\Invoices\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Tipoff\Invoices\Models\Invoice;

class InvoiceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Invoice::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'order_id'        => randomOrCreate(app('order')),
            'user_id'         => randomOrCreate(app('user')),
            'amount'          => $this->faker->numberBetween(100, 50000),
            'invoiced_at'     => $this->faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now', $timezone = null),
            'due_at'          => $this->faker->date(),
            'note'            => $this->faker->sentences(1, true),
            'creator_id'      => randomOrCreate(app('user')),
            'updater_id'      => randomOrCreate(app('user')),
        ];
    }
}
