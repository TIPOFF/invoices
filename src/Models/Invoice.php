<?php namespace Tipoff\Invoices\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Invoice extends Model
{
    use HasFactory;
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
        return $this->belongsTo(config('invoices.model_class.order'));
    }

    public function customer()
    {
        return $this->belongsTo(config('invoices.model_class.customer'));
    }

    public function creator()
    {
        return $this->belongsTo(config('invoices.model_class.user'), 'creator_id');
    }

    public function updater()
    {
        return $this->belongsTo(config('invoices.model_class.user'), 'updater_id');
    }

    public function payments()
    {
        return $this->hasMany(config('invoices.model_class.payment'));
    }
}
