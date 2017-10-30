@extends('layouts.app')

@section('tab-nav')
	@include('layouts.campaign-sub-nav')
@endsection

@section('content')
<div class="container">
    <div class="row" id="campaign-edit">
        
        @if (session('status'))
		    <div class="alert alert-success">
		        {{ session('status') }}
		    </div>
		@endif

		<div class="col-sm-12" id="campaign-stores">
			@include('stores.store-check')
		</div>
{{-- 		<div class="col-sm-6">
			@include('layouts.store-brands')
		</div> --}}
    </div>
</div>

{{-- {{ dump( $campaignData ) }} --}}

{{-- <store-brand-component v-bind:stores="dData"></store-brand-component> --}}

@endsection



