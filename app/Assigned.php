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
    protected $hidden = ['id', 'tracking', 'store', 'brand', 'campaign_id'];
    protected $appends = ['creativeid', 'impressions', 'store_logo', 'store_default_phone', 'store_name', 'brand_name'];

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


    public function tracking()
    {
        
         return $this->hasOne(Tracking::class, 'store_id', 'store_id');
    }

    public function getBrandNameAttribute()
    {
        $name = null;
        if ($this->brand){
            $name = $this->brand->name;
        }
        return $name;
    }

    public function getStoreNameAttribute()
    {
        $name = null;
        if ($this->store){
            $name = $this->store->name;
        }
        return $name;
    }

    public function getStoreDefaultPhoneAttribute()
    {
        $phone = null;
        if ($this->store){
            $phone = $this->store->default_phone;
        }
        return $phone;
    }

    public function getStoreLogoAttribute()
    {
        $logo = null;
        if ($this->store){
            $logo = $this->store->logo;
        }
        return $logo;
    }

    public function getCreativeidAttribute()
    {
        $id = null;
        if ($this->tracking){
            $id = $this->tracking->creative_id;
        }
        return $id;
    }

    public function getImpressionsAttribute()
    {
        $impressions = null;
        if ($this->tracking){
            $impressions = $this->tracking->impressions;
        }
        return $impressions;
    }

//     public function getTrackAttribute()
// {

//     return "$this->tracking} {$this->last_name}";
// }
    
    
}
