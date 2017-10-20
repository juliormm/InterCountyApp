<?php

namespace App\Http\Controllers;

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
        $resp = ['status' => 'ok'];

        if ($request->has('creative') && $request->has('store') && $request->has('campaign')) {
            
            $row = Tracking::where('store_id', $request->store)->where('campaign_id', $request->campaign)->get();
            if ($row->isEmpty()) {
                    $row              = new Tracking;
                    $row->creative_id = $request->creative;
                    $row->store_id    = $request->store;
                    $row->campaign_id = $request->campaign;
                    $row->save();
                    $resp['message'] = 'row was added';
            } else {

            	$save = Tracking::where('store_id', $request->store)->where('campaign_id', $request->campaign)
			          ->update(['creative_id' => $request->creative]);
                $resp['message']  = 'updated';

            }
        } else {
            $resp['message'] = 'missing items';
        }

        $request->session()->flash('status', 'Task was successful!');
        return $resp;
    }

}
