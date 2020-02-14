<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CountryCategory extends Model
{
    protected $fillable = ['country_id', 'category_id', 'is_member'];
    public $timestamps = false;

    public function country()
    {
        return $this->belongsTo('App\Country', 'country_id');
    }

    public function category()
    {
        return $this->belongsTo('App\Category', 'category_id');
    }
}
