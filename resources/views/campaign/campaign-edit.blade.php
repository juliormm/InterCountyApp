@extends('layouts.app') 

@section('content')
    <div class="container">

        @include('campaign.campaign-base')


        <div class="row" id="campaign-edit">            
            <div class="col-sm-12" id="campaign-stores">
                @include('stores.store-check-box')
            </div>
        </div>
    </div>
@endsection