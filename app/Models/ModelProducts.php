<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class ModelProducts extends Model
{

    use HasFactory;

    protected $table = 'products';
    protected $primaryKey = 'id';
    protected $fillable = [
        'user_id',
        'cate_id',
        'name',
        'slug',
        'small_description',
        'description',
        'selling_price',
        'price',
        'image',
        'qty',
        'tax',
        'status',
        'trending',
        'sale',
        'meta_title',
        'meta_keywords',
        'meta_description',
    ];


    public function getImageAttribute($value)
    {

        if($value){
            return url($value);
        }else{
            return asset('assets/images/products/no-product-img.png');
        }
    }




}
