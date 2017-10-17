<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Store;
use App\Brand;

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
        $this->stores = Store::orderBy('name')->get()->pluck('name', 'id');
        $this->brands = Brand::orderBy('name')->get()->pluck('name', 'id');
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with(['storeList'=> $this->stores, 'brandList' => $this->brands]);
    }
}