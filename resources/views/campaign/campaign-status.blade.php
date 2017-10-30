@extends('layouts.app')

@section('tab-nav')
	@include('layouts.campaign-sub-nav')
@endsection

@section('content')
<div class="container">
    <div class="row" id="campaign-status">
        
		<div class="col-sm-12" id="campaign-stores">
			<div class="well">
			   Any red will indicate there is something missing on that store. 
			</div>
			@include('stores.store-status')
		</div>
{{-- 		<div class="col-sm-6">
			@include('layouts.store-brands')
		</div> --}}
    </div>
</div>

{{-- {{ dump( $campaignData ) }} --}}

{{-- <store-brand-component v-bind:stores="dData"></store-brand-component> --}}

@endsection



