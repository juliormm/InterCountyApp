<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Redirector;
use Illuminate\Http\Request;
use App\Http\Requests\StoreForm;
use App\Store;
use App\Location;

use Geocoder\Query\GeocodeQuery;


class StoreController extends Controller
{
   public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
    	$allStores = Store::orderBy('name')->get();
        return view('stores.index', compact('allStores'));
    }

    public function show()
    {

    }

    public function create()
    {

        $store = new Store;
        $formURL = '/stores';

        $location = new Location;

    	return view('stores.store-form', compact('store', 'formURL', 'location'));
    }

    public function edit($id)
    {
        $store = Store::find($id);
        $formURL = '/stores/'.$id;
    	return view('stores.store-form', compact('store', 'formURL'));
    }

    public function update(Request $request, $id){
   		return $request;
    }

    public function store(Request $request) {
      
        // return $request->input('locaction');
        
        $request->validate([
            'name' => 'required',
            'default_phone' => 'required',
            'locaction.1.address' => 'required',
            'locaction.1.phone' => 'required'
        ]);

        // $store = new Store;
        // $store->name = $request->input('name');
        // // $store->logo = $request->input('logo');
        // $store->default_phone = $request->input('default_phone');
        // $store->save();

        $temp = [];
        foreach ($request->input('locaction') as $key => $value) {

            $address = (!empty($value['address'])) ? $value['address'] : null;
            $phone = (!empty($value['phone'])) ? $value['phone'] : null;
           
           if(!empty($address) && !empty($phone)) {
            $newLocation = new Location;
            $newLocation->address = $address;
            $newLocation->phone = $phone;
            // array_push($temp, [$address, $phone] );
           }
        }

        return $temp;
       // return redirect('/stores')->with(['status' => $request->input('name') . ' was added!', 'new_id' => $store->id]);
    }
}
