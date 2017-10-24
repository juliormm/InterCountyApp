<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Campaign;
use App\Store;
use App\Brand;

class Assigned extends Model
{

	protected $table = 'assigned';
    public $timestamps = false;
    protected $hidden = ['id', 'campaign_id', 'store_id'];

    public function store()
    {
        return $this->hasOne(Store::class, 'id', 'store_id');
    }

    public function brand()
    {
        return $this->hasOne(Brand::class, 'id', 'brand_id');
    }

    public function campaigns()
    {
        return $this->hasMany(Campaign::class);
    }

    public function getNewExitUrlAttribute()
    {
        return $this->exit_url;
    }
    
    
}
