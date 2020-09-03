<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Brand extends Model
{
    protected $fillable=[
    	'name','logo','category_id'
    ];


    public function category(){
    	return $this->belongsTo('App\Category');
    }

    public function products(){
        return $this->hasMany('App\Product');
    }


}
