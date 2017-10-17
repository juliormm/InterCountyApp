<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Campaign;
use App\Store;

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

    public function show()
    {

    }

    public function create()
    {

        return [];
    }

    public function edit($id)
    {
        $currentCampaign = $id;
        $storesSelected = Campaign::find($id)->assignedStores()->distinct()->get();

        // $storesSelected = Campaign::with(['assignedStores' => function($query) use ($id){
        //     $query->where('campaign_id', '=', $id);
        // }])->distinct()->get();

        // $final = [];

        foreach ($storesSelected as $store) {
            $store->load(['assignedBrands' => function ($query) use ($id){
                $query->where('campaign_id', '=', $id);
            }]);
        }
        // $test = Campaign::width('assignedStores.')->assignedStores()->distinct()->get();


        return view('campaign-edit', compact('currentCampaign', 'storesSelected') );
    }
}
