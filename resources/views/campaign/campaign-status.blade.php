@extends('layouts.app')

@section('tab-nav')
	@include('layouts.tab-nav')
@endsection

@section('content')
<div class="container">
    <div class="row" id="campaign-status">
        
		<div class="col-sm-12" id="campaign-stores">
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



