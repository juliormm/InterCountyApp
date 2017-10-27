<?php

namespace App\Http\Controllers;

use App\Store;
use App\Tracking;
use Illuminate\Http\Request;

class TrackingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
        $resp = ['status' => 'OK', 'requester' => $request->requester];
        $resp['request'] = $request->toArray();
        
        if ($request->has('creative') && $request->has('store') && $request->has('campaign')) {

            $row  = Tracking::where([['store_id', $request->store], ['campaign_id', $request->campaign]])->get();
            $remove = empty($request->creative);
            $uniqueID = ($remove) ? NULL : Tracking::where('creative_id', $request->creative)->get();
            
            if($row->isNotEmpty() && $remove ) {
                 $resp['message'] = 'id removed';
                 Tracking::destroy([$row[0]->id]);
            } elseif ($row->isNotEmpty() && $uniqueID->isEmpty()) {
                $resp['message'] = 'id updated';
                $update  = Tracking::where('store_id', $request->store)->where('campaign_id', $request->campaign)->update(['creative_id' => $request->creative]); 
            } elseif ($row->isEmpty() && $uniqueID->isNotEmpty()){
                // already in use
                $resp['status']  = 'FAILED';
                $resp['message'] = $request->creative.' in use by: '. Store::where('id', $uniqueID[0]['store_id'])->value('name');
            } elseif ($row->isEmpty() && $uniqueID->isEmpty()) {
                $newRow              = new Tracking;
                $newRow->creative_id = $request->creative;
                $newRow->store_id    = $request->store;
                $newRow->campaign_id = $request->campaign;
                $newRow->save();
                $resp['message'] = 'id added';
            } else {
                 $resp['message'] = $uniqueID;
            }

        } else {
            $resp['status'] = 'FAILED';
            $resp['message'] = 'missing store id, campaign id or creative id';
            $resp['request'] = $request;
        }

        // $request->session()->flash('status', 'Task was successful!');
        return $resp;
    }

}
