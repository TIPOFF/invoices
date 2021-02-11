<?php namespace Tipoff\Invoices\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Tipoff\Support\Models\BaseModel;
use Tipoff\Support\Traits\HasPackageFactory;

class Invoice extends BaseModel
{
    use HasPackageFactory;
    use SoftDeletes;

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
            if (auth()->check()) {
                $invoice->creator_id = auth()->id();
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
            if (auth()->check()) {
                $invoice->updater_id = auth()->id();
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

    public function creator()
    {
        return $this->belongsTo(app('user'), 'creator_id');
    }

    public function updater()
    {
        return $this->belongsTo(app('user'), 'updater_id');
    }

    public function payments()
    {
        return $this->hasMany(app('payment'));
    }
}
