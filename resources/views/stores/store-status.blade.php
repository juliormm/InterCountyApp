<div id="store-list-campaign" class="scroll-content-box">
    <ul class="list-group">
        @foreach ($groupedStores as $key => $store)
        <li class="list-group-item checkbox" id="store_{{ $key }}">
            <div class="row">
                <div class="col-sm-2">
                    <div class="logo-thumb">
                        <img class="logo-img" src="//quicktransmit.com/api/campaigns/_cdn/InterCountyApplianceGroupRINT041/store_logos/{{ $store['store_logo']}}" alt="logo">
                    </div>
                    <div>
                       {{ $store['store_name']}}
                    </div>

                </div>
                <div class="col-sm-10">
                    <table class="table table-bordered table-condensed">
                        <tr>
                            <th class="text-center" width="20%">Creative ID</th>
                            <th class="text-center" width="20%">Default Phone</th>
                            <th class="text-center" width="60%">Brands <span class="badge">{{ count($store['brands']) }}</span></th>
                        </tr>
                        <tr>
                            <td> <p class="text-center {{ empty($store['creative_id']) ? 'bg-danger' : 'bg-success' }}">{{ empty($store['creative_id']) ? 'MISSING' : $store['creative_id'] }} </p></td>
                            <td> <p class="text-center {{ ( !empty($store['store_default_phone']) && strlen($store['store_default_phone']) != 10 ) ? 'bg-danger' : 'bg-success' }}">{{ empty($store['store_default_phone']) ? 'MISSING' : '('.substr($store['store_default_phone'], 0, 3).') '.substr($store['store_default_phone'], 3, 3).'-'.substr($store['store_default_phone'],6)  }} </p></td>
                            <td>
                                {{-- <ul class="list-group"> --}}
                                     @foreach ($store['brands'] as $bKey => $brand)
                                     {{-- <li class="list-group-item {{ empty($brand['exit']) ? 'list-group-item-danger' : 'list-group-item-success' }}"> --}}
                                       <span class="label {{ empty($brand['exit']) ? 'label-danger' : 'label-success' }}">{{ $brand['name'] }}</span>
                                        {{-- <button type="button" class="btn btn-sm "></button> --}}

                                        {{-- <span class="text-center "> </span> --}}
                                    {{-- </li> --}}
                                    @endforeach
                                {{-- </ul> --}}
                                    

                            </td>
                        </tr>
                    </table>
                     

                   {{--  <div class="brand-box well well-sm hidden">
                        <div class="brand-warning bg-danger">At least one brand has to be added to save store.</div>
                        @foreach ($brandList as $brandkey => $brand)
                        <div class="form-inline brand-group">
                            <div class="checkbox inline-brands">
                                <label for="brandName_{{ $store->id }}-{{ $brandkey }}">
                                    <input class="checkbox-item" type="checkbox" data-brand-id="{{ $brandkey }}" data-store-id="{{ $store->id }}" value="{{ $brand }}" id="brandName_{{ $store->id }}-{{ $brandkey }}"> {{ $brand }}
                                </label>
                            </div>
                            <div class="ulrBox form-group hidden">
                                <label class="sr-only" for="urlExit_{{ $store->id }}-{{ $brandkey }}">Email address</label>
                                <input type="text" class="form-control input-sm ulrbox-item" id="urlExit_{{ $store->id }}-{{ $brandkey }}" data-brand-id="{{ $brandkey }}" data-store-id="{{ $store->id }}" placeholder="URL Exit">
                            </div>
                        </div>
                        @endforeach
                    </div> --}}
                </div>
            </div>
        </li>
        @endforeach
    </ul>
 {{--    <div class="loading-blocker">
        <div class="spinner spinner--blue">
            <div class="spinner__item1"></div>
            <div class="spinner__item2"></div>
            <div class="spinner__item3"></div>
            <div class="spinner__item4"></div>
        </div>
    </div> --}}
</div>