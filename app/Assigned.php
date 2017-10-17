<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Campaign;
use App\Store;
use App\Brand;

class Assigned extends Model
{

	protected $table = 'assigned';


    public function stores()
    {
        return $this->hasMany(Store::class);
    }

    public function brands()
    {
        return $this->hasMany(Brand::class);
    }

    public function campaigns()
    {
        return $this->hasMany(Campaign::class);
    }
}
