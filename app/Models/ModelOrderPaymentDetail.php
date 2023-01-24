<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelOrderPaymentDetail extends Model
{
    use HasFactory;

    protected $table = 'order_payment_detail';
    protected $primaryKey = 'id';
    protected $fillable = [
        'orderid',
        'payment_method',
        'card_number',
        'total_amount',
        'transaction_id',
    ];
}
