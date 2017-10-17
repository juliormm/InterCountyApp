<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Store;
use App\Brand;
use App\Campaign;
use App\Assigned;

class Campaign extends Model
{
    protected $fillable = ['name'];

    public function assignedStores()
    {
        // $stores = App\Campaign::find(1)->stores()->distinct()->get();
        return $this->belongsToMany(Store::class, 'assigned')->withPivot('brand_id');;
    }
    
}
