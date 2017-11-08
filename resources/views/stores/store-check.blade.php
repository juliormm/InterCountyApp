<div id="store-list-campaign" class="scroll-content-box">
    <ul class="list-group">
        @foreach ($storeList as $store)
        <li class="list-group-item checkbox" style="cursor: pointer;" id="store_{{ $store->id }}">
            <div class="row">
                <div class="col-sm-3">
                    <div class="logo-thumb">
                        <img class="logo-img" src="//quicktransmit.com/api/campaigns/_cdn/InterCountyApplianceGroupRINT041/store_logos/{{ $store->logo }}" alt="logo">
                    </div>
                    <div class="form-inline store-section">
                        <label for="storeID_{{ $store->id }}">
                            <input type="checkbox" class="store-item" value="{{ $store->id }}" id="storeID_{{ $store->id }}">{{ $store->name }}
                        </label>
                        @if(Auth::user()->name === 'Julio' || Auth::user()->name === 'admin')
                        <div class="form-group">
                            <label class="sr-only" for="creativeID_{{ $store->id }}">creative id</label>
                            <input type="number" maxlength="12" class="form-control input-sm" id="creativeID_{{ $store->id }}" placeholder="Creative ID" data-store-id="{{ $store->id }}">

                        </div>
                        <div id="creativeIDmsg_{{ $store->id }}" class="alert" role="alert" style="display: none;">Messge goes here</div>
                        

                        @endif
                    </div>
                </div>
                <div class="col-sm-9">
                    <div class="brand-box well well-sm hidden">
                        <div class="brand-warning bg-danger">At least one brand has to be added to save store.</div>
                        @foreach ($brandList as $brandkey => $brand)
                        <div class="form-inline brand-group">
                            <div class="checkbox inline-brands">
                                <label for="brandName_{{ $store->id }}-{{ $brandkey }}">
                                    <input class="checkbox-brand-item" type="checkbox" data-brand-id="{{ $brandkey }}" data-store-id="{{ $store->id }}" value="{{ $brand }}" id="brandName_{{ $store->id }}-{{ $brandkey }}"> {{ $brand }}
                                </label>
                            </div>
                            <div class="ulrBox form-group hidden">
                                <label class="sr-only" for="urlExit_{{ $store->id }}-{{ $brandkey }}">Email address</label>
                                <input type="text" class="form-control input-sm ulrbox-item" id="urlExit_{{ $store->id }}-{{ $brandkey }}" data-brand-id="{{ $brandkey }}" data-store-id="{{ $store->id }}" placeholder="URL Exit">
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </li>
        @endforeach
    </ul>
    <div class="loading-blocker">
        <div class="spinner spinner--blue">
            <div class="spinner__item1"></div>
            <div class="spinner__item2"></div>
            <div class="spinner__item3"></div>
            <div class="spinner__item4"></div>
        </div>
    </div>
</div>