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

    public function create(Request $request)
    {
        
        $campaign = new Campaign;
        $campaign->name = $request->input('name');

        $campaign->save();

        return redirect('campaigns/'.$campaign->id.'/edit')->with('status', 'Campaign Created');;
    }


    public function status($id)
    {
        // var_export(\Illuminate\Support\Facades\DB::getQueryLog());
        $campaignObj = Campaign::where('id', $id)->first();
       
        // $brandList       = Brand::orderBy('name', 'asc')->pluck('name', 'id');
        // $uStores         = DB::table('assigned')->where('campaign_id', $id)->get();
        $uStores = Assigned::where('campaign_id', $id)->with(array('tracking' => function ($query) use ($id) {
            $query->where('campaign_id', $id);
        }))->with('brand')->get();

         // print_r($uStores->toArray());

        $grouped = $uStores->sortBy('store_name')->groupBy('store_name');


         // print_r($grouped->toArray());


        $groupedStores = $grouped->map(function ($item, $key) {
            $arr = [];
            $arr['creative_id'] = $item[0]->creative_id;
            $arr['store_logo'] = $item[0]->store_logo;
            $arr['store_default_phone'] = $item[0]->store_default_phone;
            $arr['store_name'] = $item[0]->store_name;

            $data = $item->mapWithKeys(function($e, $k){
                return [$e->brand_id => ['exit' => $e->exit_url, 'name' => $e->brand_name]];
            });

            $arr['brands'] = $data->toArray();
            return collect($arr);
        });


         

        // print_r($groupedStores->toArray());
        
        // JavaScript::put([
        //     'dData'     => $campaignData,
        //     'brandList' => $brandList,
        //     'appURL' => env("APP_URL", "http://localhost")
        // ]);
        return view('campaign.campaign-status', compact('campaignObj', 'groupedStores'));
    }

    public function edit($id)
    {
        $campaignObj = Campaign::where('id', $id)->first();
        

        $brandList       = Brand::orderBy('name', 'asc')->pluck('name', 'id');
        $uStores         = Assigned::where('campaign_id', $id)->get();
        $grouped         = $uStores->groupBy('store_id');

        $campaignData = $grouped->map(function ($arr, $key) {
            $cID   = $arr->pluck('campaign_id')[0];
            $track = Tracking::where('campaign_id', $cID)->where('store_id', $key)->first();
            $crvID = ($track) ? $track->creative_id : '';
            $ret   = collect(['creative_id' => $crvID, 'brand' => $arr->pluck('exit_url', 'brand_id')]);
            return $ret;
        });

        // print_r($campaignData->toArray());

        JavaScript::put([
            // 'dData'     => $campaignData,
            // 'brandList' => $brandList,
            'currCamp' => $id,
            'appURL'    => env('APP_URL', 'test'),
        ]);
        return view('campaign.campaign-edit', compact('campaignObj', 'campaignData', 'brandList'));
    }

    public function removeStore(Request $request, $id)
    {
        $resp            = ['status' => 'OK', 'requester' => $request->requester];
        $resp['request'] = $request->toArray();
        if ($request->action == 'clearAll') {
            $ids = Assigned::where(['campaign_id' => $id, 'store_id' => $request->store])->pluck('id');
            if (!empty($ids)) {
                $removeStat = Assigned::destroy($ids->toArray());
                 $trackingDelete = Tracking::where('campaign_id', $id)->where('store_id', $request->store)->delete();
                // dd($removeStat);
                // $resp['dev'] = $removeStat
                // if($removeStat == 0){
                //      $resp['status'] = 'FAILD';
                //     $resp['message'] = 'could not remove stores';  
                // } else {
                //    $resp['message'] = 'store removed from current campaign';
                   
                //     $resp['tracking'] = $trackingDelete;
                // }
            } else {
                $resp['status'] = 'FAILD';
                $resp['message'] = 'Could not find in db';
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
