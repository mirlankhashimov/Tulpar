<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $fillable = ['code', 'name'];

    public function category()
    {
        return $this->hasMany('App\CountryCategory', 'country_id');
    }
}
