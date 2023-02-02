<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelOrder extends Model
{
    use HasFactory;

    protected $table = 'orders';
    protected $primaryKey = 'id';
    protected $fillable = [
        'userid',
        'fname',
        'lname',
        'email',
        'phone_number',
        'address',
        'city',
        'state',
        'country',
        'postcode',
        'status',
        'message',
        'tracking_no',
    ];

    public function getallitems(){
        return $this->hasMany(ModelOrderitems::class, 'order_id');
    }

    public function getorderpaymentinfo(){
        return $this->hasOne(ModelOrderPaymentDetail::class,'orderid');
    }
}
