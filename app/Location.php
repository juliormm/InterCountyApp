<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Store;

class Location extends Model
{

	protected $fillable = ['store_id', 'lattitude', 'longitude', 'address', 'phone'];
	protected $hidden = ['store_id', 'id', 'created_at', 'updated_at'];
	// protected $dateFormat = 'U';
	// protected $dates = [
 //        'created_at',
 //        'updated_at'
 //    ];

    public function store()
    {
        return $this->hasOne(Store::class);
    }

    public function setPhoneAttribute($value)
    {
        $this->attributes['phone'] = preg_replace("/[^0-9]/", "", $value);
    }

    // public function getPhoneAttribute($value)
    // {
    //     return (empty($value)) ? '' : '('.substr($value, 0, 3).') '.substr($value, 3, 3).'-'.substr($value,6);
    // }
}
