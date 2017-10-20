<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Store;
use App\Brand;
use JavaScript;

class CampaignComposer
{
    /**
     * The user repository implementation.
     *
     * @var UserRepository
     */
    protected $stores;
    protected $brands;

    /**
     * Create a new profile composer.
     *
     * @param  UserRepository  $users
     * @return void
     */
    public function __construct()
    {
        // Dependencies automatically resolved by service container...
         $storeData = Store::orderBy('name','asc')->get();
        // $brandData = Brand::orderBy('name', 'asc')->pluck('name','id');

        $this->stores = $storeData;
         // $this->brands = $brandData;

         // JavaScript::put([
         //        'storeList' => $this->stores,
         //        'brandList' => $this->brands
         // ]);
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with(['storeList'=> $this->stores]);
    }
}