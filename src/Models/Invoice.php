<?php

declare(strict_types=1);

namespace Tipoff\Invoices\Models;

use Assert\Assert;
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
            if (empty($invoice->user_id)) {
                $invoice->user_id = $invoice->order->user_id;
            }

            do {
                $token = $invoice->order->order_number . '-' . Str::upper(Str::random(2));
            } while (self::where('invoice_number', $token)->first()); //check if the token already exists and if it does, try again
            $invoice->invoice_number = $token;
        });

        static::saving(function ($invoice) {
            Assert::lazy()
                ->that($invoice->order_id)->notEmpty('An invoice must be part of an order.')
                ->verifyNow();
        });
    }

    public function order()
    {
        return $this->belongsTo(app('order'));
    }

    public function user()
    {
        return $this->belongsTo(app('user'));
    }

    public function payments()
    {
        return $this->hasMany(app('payment'));
    }
}
