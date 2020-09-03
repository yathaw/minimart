<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Product extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'codeno', 'name', 'photo', 'price', 'category_id', 'brand_id'
    ];

    public function category(){
        return $this->belongsTo('App\Category');
    }

    public function brand(){
        return $this->belongsTo('App\Brand');
    }
    
    public function shop(){
        return $this->belongsTo('App\Shop');
    }

    public function bills(){
        return $this->belongsToMany('App\Bill', 'billdetails','bill_id','product_id')
            ->withPivot('qty')
            ->withTimestamps();
    }

    public function stocks(){
        return $this->belongsTo('App\Stock');
    }


   
}









