<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
    protected $table = 'profile';
    protected $primaryKey = 'id';
    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'website_url',
        'shipping_address',
        'billing_address',
        'email',
        'phone_number',
        'country',
        'zip_code',
        'city',
        'state',
    ];

    public function userget(){
        return $this->belongsTo(User::class);
    }
}
