<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Store;

class Location extends Model
{

	protected $fillable = ['store_id', 'lattitude', 'longitude', 'address', 'phone'];

    public function store()
    {
        return $this->hasOne(Store::class);
    }
}
