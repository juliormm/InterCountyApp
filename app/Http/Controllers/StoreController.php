<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Redirector;
use Illuminate\Http\Request;
use App\Http\Requests\StoreForm;
use App\Store;
use App\Location;

// use Geocoder\Laravel\Facades\Geocoder;


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
        $formURL = url('/stores');

        $location = new Location;

    	return view('stores.store-form', compact('store', 'formURL', 'location'));
    }

    public function edit($id)
    {
        $store = Store::find($id);
        $formURL = url('/stores/'.$id);
    	return view('stores.store-form', compact('store', 'formURL'));
    }

    private function getCoordinates($address) {
        $param = array("address"=>$address);
        $geocode = \Geocoder::geocode('json', $param);
        $arr = json_decode($geocode, true);
        $coordinates = $arr['results'][0]['geometry']['location'];

        return $coordinates;
    }

    public function update(Request $request, $id){

        $request->validate([
            'name' => 'required',
            'default_phone' => 'required',
            'locaction.1.address' => 'required',
            'locaction.1.phone' => 'required'
        ]);


        $store = Store::find($id);
        $store->name = $request->input('name');
        $store->default_phone = $request->input('default_phone');
        $store->save();

        foreach ($request->input('locaction') as $key => $value) {

            $locID = $value['id']; 
            $address = (!empty($value['address'])) ? $value['address'] : null;
            $phone = (!empty($value['phone'])) ? $value['phone'] : null;

            if(empty($address) && empty($phone)) {
                if($locID != 'new') {
                    Location::destroy($locID);
                }
                
            } else if( !empty($address) && !empty($phone) ){

                if($locID == 'new') {
                    $coordinates = $this->getCoordinates($address);
                    $newLocation = new Location;
                    $newLocation->address = $address;
                    $newLocation->phone = $phone;
                    $newLocation->latitude = $coordinates['lat'];
                    $newLocation->longitude = $coordinates['lng'];
                    $newLocation->store_id = $id;
                    $newLocation->save();
               } else {
                    if(!empty($address) && !empty($phone)) {
                        $loc = Location::find($locID);
                        
                        if($loc->address != $address){
                            $coordinates =  $this->getCoordinates($address);
                            $loc->latitude = $coordinates['lat'];
                            $loc->longitude = $coordinates['lng'];
                        }

                        $loc->address =  $address;
                        $loc->phone =   $phone;
                        $loc->save();
                    }
               }

            }
        }


   		return redirect('/stores')->with(['status' => $request->input('name') . ' was updated!', 'new_id' => $store->id]);
    }

    public function store(Request $request) {
              
        $request->validate([
            'name' => 'required',
            'default_phone' => 'required',
            'locaction.1.address' => 'required',
            'locaction.1.phone' => 'required'
        ]);

        $store = new Store;
        $store->name = $request->input('name');
        $store->default_phone = $request->input('default_phone');
        $store->save();

        foreach ($request->input('locaction') as $key => $value) {

            $address = (!empty($value['address'])) ? $value['address'] : null;
            $phone = (!empty($value['phone'])) ? $value['phone'] : null;
           
           if(!empty($address) && !empty($phone)) {
            $coordinates =  $this->getCoordinates($address);
            $newLocation = new Location;
            $newLocation->address = $address;
            $newLocation->phone = $phone;
            $newLocation->latitude = $coordinates['lat'];
            $newLocation->longitude = $coordinates['lng'];
            $newLocation->store_id = $store->id;
            $newLocation->save();
           }
        }

       return redirect('/stores')->with(['status' => $request->input('name') . ' was added!', 'new_id' => $store->id]);
    }
}
