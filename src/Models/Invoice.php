<?php namespace Tipoff\Invoices\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Tipoff\Support\Models\BaseModel;
use Tipoff\Support\Traits\HasCreator;
use Tipoff\Support\Traits\HasPackageFactory;
use Tipoff\Support\Traits\HasUpdater;

class Invoice extends BaseModel
{
    use HasPackageFactory;
    use SoftDeletes;
    use HasCreator;
    use HasUpdater;

    protected $guarded = [
        'id',
        'invoice_number',
    ];

    protected $casts = [
        'invoiced_at' => 'datetime',
        'due_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($invoice) {
            if (empty($invoice->customer_id)) {
                $invoice->customer_id = $invoice->order->customer_id;
            }

            do {
                $token = $invoice->order->order_number . '-' . Str::upper(Str::random(2));
            } while (self::where('invoice_number', $token)->first()); //check if the token already exists and if it does, try again
            $invoice->invoice_number = $token;
        });

        static::saving(function ($invoice) {
            if (empty($invoice->order_id)) {
                throw new \Exception('An invoice must be part of an order.');
            }
        });
    }

    public function order()
    {
        return $this->belongsTo(app('order'));
    }

    public function customer()
    {
        return $this->belongsTo(app('customer'));
    }

    public function payments()
    {
        return $this->hasMany(app('payment'));
    }
}
