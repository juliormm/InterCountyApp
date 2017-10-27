<?php

namespace App\Http\Controllers;

\Illuminate\Support\Facades\DB::enableQueryLog();

use App\Assigned;
use App\Brand;
use App\Campaign;
use App\Store;
use App\Tracking;
use DB;
use Illuminate\Http\Request;
use JavaScript;

class CampaignController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $campaignList = Campaign::all()->pluck('name', 'id');
        return view('campaign-list', compact('campaignList'));
    }

    public function status($id)
    {
        $currentCampaign = $id;
        // $brandList       = Brand::orderBy('name', 'asc')->pluck('name', 'id');
        // $uStores         = DB::table('assigned')->where('campaign_id', $id)->get();
        $uStores = Assigned::where('campaign_id', $id)->get();

        // // print_r($uStores);
        $testing  = $uStores->map(function ($item, $key) use($id) {
           $track = Tracking::where([['campaign_id', $id], ['store_id', $item->id]])->get();
           $item['creative_id'] = $track;
           return $item;
        });

        print_r($testing->toArray());
        // // // $grouped         = $uStores->groupBy('store_id');
        // 
        // foreach ($uStores2  as $key => $value) {
            


        // }

        // echo '-------';

       // var_export(\Illuminate\Support\Facades\DB::getQueryLog());

        // $trakingData = Tracking::where('campaign_id', $id)->get();

        // $campaignData    = $grouped->map(function ($arr, $key) {
        //    $cID =  $arr->pluck('campaign_id')[0];
        //     $track = Tracking::where('campaign_id', $cID)->where('store_id', $key)->first();
        //     $crvID = ($track) ? $track->creative_id : '';
        //     $ret = ['creative_id' => $crvID, 'brand' => $arr->pluck('exit_url', 'brand_id')];
        //     return $ret;
        // });

        // JavaScript::put([
        //     'dData'     => $campaignData,
        //     'brandList' => $brandList,
        //     'appURL' => env("APP_URL", "http://localhost")
        // ]);
        // return view('campaign.campaign-status', compact('currentCampaign', 'campaignData', 'brandList', 'trakingData'));
    }

    public function edit($id)
    {
        $currentCampaign = $id;
        $brandList       = Brand::orderBy('name', 'asc')->pluck('name', 'id');
        $uStores         = DB::table('assigned')->where('campaign_id', '=', $id)->get();
        $grouped         = $uStores->groupBy('store_id');

        $campaignData = $grouped->map(function ($arr, $key) {
            $cID   = $arr->pluck('campaign_id')[0];
            $track = Tracking::where('campaign_id', $cID)->where('store_id', $key)->first();
            $crvID = ($track) ? $track->creative_id : '';
            $ret   = ['creative_id' => $crvID, 'brand' => $arr->pluck('exit_url', 'brand_id')];
            return $ret;
        });

        JavaScript::put([
            'dData'     => $campaignData,
            'brandList' => $brandList,
            'appURL'    => env("APP_URL", "http://localhost"),
        ]);
        return view('campaign.campaign-edit', compact('currentCampaign', 'campaignData', 'brandList'));
    }

    public function removeStore(Request $request, $id)
    {
        $resp            = ['status' => 'OK', 'requester' => $request->requester];
        $resp['request'] = $request->toArray();
        if ($request->action == 'clearAll') {
            $ids = Assigned::where(['campaign_id' => $id, 'store_id' => $request->store])->pluck('id');
            if (!empty($ids)) {
                $resp['message'] = 'store removed';
                Assigned::destroy($ids->toArray());
            } else {
                $resp['message'] = 'nothing was found';
            }

        }

        return $resp;

    }

    public function update(Request $request, $id)
    {
        $validate = Assigned::where(['campaign_id' => $id, 'store_id' => $request->store, 'brand_id' => $request->brand])->value('id');

        $resp            = ['status' => 'OK', 'requester' => $request->requester];
        $resp['request'] = $request->toArray();

        if (!empty($validate) && $request->action == 'remove') {
            $resp['message'] = 'record removed';
            $status          = Assigned::destroy($validate);
        } elseif (!empty($validate) && $request->action == 'urlexit' && $request->has('url')) {
            $resp['message'] = 'url updated';
            $row             = Assigned::find($validate);
            $row->exit_url   = $request->url;
            $row->save();
        } elseif (empty($validate) && $request->action == 'add') {
            $row              = new Assigned;
            $row->campaign_id = $id;
            $row->store_id    = $request->store;
            $row->brand_id    = $request->brand;
            $row->save();
            $resp['message'] = 'record added';
            // $resp['data']    = $row->id;
        } else {
            $resp['status']  = 'FAILD';
            $resp['message'] = 'not sure what happend';
        }

        return $resp;

    }

}
