<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_user',
        'id_sponsor',
        'id_status',
        'id_event',
        'id_level',
        'total_fund',
        'comment',
        'no_rek',
        'bank_name',
        'account_name',
        'id_payment_status',
        'id_withdraw_status'
    ];

    public function sponsor()
    {
        return $this->belongsTo(Sponsor::class, 'id_sponsor');
    }

    public function event()
    {
        return $this->belongsTo(Event::class, 'id_event');
    }
    public function status()
    {
        return $this->belongsTo(Status::class, 'id_status');
    }

    public function withdraw()
    {
        return $this->belongsTo(WithdrawStatus::class, 'id_withdraw_status');
    }

    public function payment()
    {
        return $this->belongsTo(PaymentStatus::class, 'id_payment_status');
    }

    public function level()
    {
        return $this->belongsTo(BenefitLevel::class, 'id_level');
    }
}
