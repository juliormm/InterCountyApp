<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Store;

class Location extends Model
{

	protected $fillable = ['store_id', 'lattitude', 'longitude', 'address', 'phone'];
	protected $hidden = ['store_id', 'id', 'created_at', 'updated_at'];
	// protected $casts = [
 //        'lattitude' => 'integer',
        
 //    ];

    public function store()
    {
        return $this->hasOne(Store::class);
    }
}
