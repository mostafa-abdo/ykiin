<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DonationWithdraw extends Model
{
    use HasFactory;

    protected $table = 'donation_withdraws';
    protected $fillable = [
        'donation_id',
        'user_id',
        'payment_gateway',
        'withdraw_request_amount',
        'payment_account_details',
        'additional_comment_by_user',
        'transaction_id',
        'payment_information',
        'additional_comment_by_admin',
        'payment_receipt',
        'payment_status',
        'gateway_id',
        'gateway_fields',
    ];

    public function gateway_name()
    {
        return $this->belongsTo(WithdrawGateway::class,'gateway_id','id');
    }

    public function cause(){
        return $this->belongsTo('App\Cause','donation_id');
    }
    public function user(){
        return $this->belongsTo('App\User','user_id');
    }

}
