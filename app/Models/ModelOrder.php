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
}
