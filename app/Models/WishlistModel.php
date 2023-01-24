<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WishlistModel extends Model
{
    use HasFactory;

    protected $table = "wishlist";
    protected $primaryKey = 'id';
    protected $fillable=[
        'user_id',
        'product_id',
    ];

    public function products(){
        return $this->belongsTo(ModelProducts::class,'product_id','id');
    }
}
