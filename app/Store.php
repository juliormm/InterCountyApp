<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Location;
use App\Campaign;
use App\Assigned;
use App\Brand;

class Store extends Model
{
	public $timestamps = false;
	protected $fillable = ['name', 'logo', 'default_phone'];
    protected $with = ['locations'];

    public function locations()
    {
        return $this->hasMany(Location::class);
    }

    public function assignedBrands()
    {
        // $brands = App\Store::find(2)->assinedBrands()->where('campaign_id', '=', 1)->get();
        return $this->belongsToMany(Brand::class, 'assigned');
    }

}
