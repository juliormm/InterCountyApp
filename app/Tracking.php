<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Store;
use App\Assigned;

class Tracking extends Model
{
   protected $table = 'tracking';
   public $timestamps = false;
   protected $hidden = ['store_id', 'id', 'created_at', 'updated_at', 'impressions', 'campaign_id', 'next_brand', 'assigned'];
   

   public function store()
    {
        return $this->hasOne(Store::class, 'id', 'store_id');
    }

    public function assigned(){
    	return $this->hasMany(Assigned::class, 'store_id', 'store_id');
    }

 
}
