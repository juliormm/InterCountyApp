<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Store;

class Tracking extends Model
{
   protected $table = 'tracking';
   public $timestamps = false;
   // protected $hidden = ['store_id', 'id', 'created_at', 'updated_at', 'impressions', 'campaign_id', 'next_brand'];
   

   public function store()
    {
        return $this->hasOne(Store::class, 'id', 'store_id');
    }

 
}
