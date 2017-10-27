<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Campaign;
use App\Store;
use App\Brand;
use App\Tracking;

class Assigned extends Model
{

	protected $table = 'assigned';
    public $timestamps = false;
    // protected $hidden = ['id', 'campaign_id', 'store_id'];

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

    public function tracking()
    {
        
         return $this->hasOne(Tracking::class, 'store_id', 'store_id');
    }

//     public function getTrackAttribute()
// {

//     return "$this->tracking} {$this->last_name}";
// }
    
    
}
