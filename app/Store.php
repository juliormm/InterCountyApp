<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Location;
use App\Campaign;
use App\Assigned;
use App\Brand;

class Store extends Model
{
	protected $fillable = ['name', 'logo', 'default_phone'];
    protected $hidden = ['id', 'ic_dealer_id', 'assignedBrands', 'created_at', 'updated_at'];

    public function locations()
    {
        return $this->hasMany(Location::class);
    }

    public function assignedBrands()
    {
        // $brands = App\Store::find(2)->assinedBrands()->where('campaign_id', '=', 1)->get();
        return $this->belongsToMany(Brand::class, 'assigned')->withPivot('exit_url');
    }

    public function assignedCampaignBrands()
    {
        // $brands = App\Store::find(2)->assinedBrands()->where('campaign_id', '=', 1)->get();
        // return $this->belongsToMany(Brand::class, 'assigned')->withPivot('exit_url');
    }

    public function setDefaultPhoneAttribute($value)
    {
        $this->attributes['default_phone'] = preg_replace("/[^0-9]/", "", $value);
    }

    //  public function getDefaultPhoneAttribute($value)
    // {

    //     return (empty($value)) ? '' : '('.substr($value, 0, 3).') '.substr($value, 3, 3).'-'.substr($value,6);
    // }

}
