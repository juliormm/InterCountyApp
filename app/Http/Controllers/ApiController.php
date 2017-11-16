<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Assigned;
use App\Brand;
use App\Campaign;
use App\Store;
use App\Tracking;

class ApiController extends Controller
{
    
    public function demo($campaign, $name, $brand){

    	$data = Assigned::with('store.locations')->where([['campaign_id', $campaign], ['store_id', $name], ['brand_id', $brand]])->first();

    	if($data) {
    		$data['status'] = 'OK';
    		return $data->makeVisible('store')->makeHidden(['tracking', 'brand', 'impressions', 'creativeid']);
    	} else {
    		return ['status' => 'FAILED', 'message' => 'no store or brand was matching the request'];
    	}
    	
    }

     public function live($campaign, $cid){
        $return = [];

     	// $data = Tracking::with('store.locations', 'store.assignedBrands')->where([['campaign_id', $campaign], ['creative_id', $cid]])->first();

        // $data = Tracking::with('assigned')->where([['campaign_id', $campaign], ['creative_id', $cid]])->first();

        $data = Tracking::with(array('assigned' => function($query) use ($campaign){
                    $query->where('campaign_id', 2);
            }, 'store.locations'))->where([['campaign_id', $campaign], ['creative_id', $cid]])->first();

        $storeInfo = $data['assigned'][$data['next_brand']];

        if(empty($data)){
            $return['status'] = 'FAILED';
            $return['message'] = 'No creative id was found';
        } else {
            $return = $data->toArray();
            $next = $data['next_brand'];
            $brandCount = count($data['assigned']);

            $return['brand_id'] = $storeInfo['brand_id'];
            $return['exit_url'] = $storeInfo['exit_url'];

            if($next+1 < $brandCount){
                $data->next_brand = $next+1;
            } else {
                $data->next_brand = 0;
            }
            $data->impressions = $data->impressions + 1;
            $data->save();
            $return['status'] = 'OK';
        }

    	return $return;
    }  
}
