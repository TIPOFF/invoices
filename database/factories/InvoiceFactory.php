<?php namespace Tipoff\Invoices\Database\Factories;

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
            'order_id'        => randomOrCreate(config('invoices.model_class.order')),
            'amount'          => $this->faker->numberBetween(100, 50000),
            'invoiced_at'     => $this->faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now', $timezone = null),
            'due_at'          => $this->faker->date(),
            'note'            => $this->faker->sentences(1, true),
            'creator_id'      => randomOrCreate(config('invoices.model_class.user')),
            'updater_id'      => randomOrCreate(config('invoices.model_class.user')),
        ];
    }
}
