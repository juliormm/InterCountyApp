@extends('layouts.app')
@section('content')
	<div class="container">
		
		@include('campaign.campaign-base')
	    
	    <div class="row" id="campaign-status">
	 {{--        <div class="col-sm-12 well">
	            <div class="row">
	                <div class="col-sm-6">
			
	                	
	                </div>
	            </div>
	        </div> --}}
			<div class="col-sm-12" id="campaign-stores">
				<div class="well">
				   Any red will indicate there is something missing on that store. 
				</div>
				@include('stores.store-status')
			</div>
	    </div>
	</div>
@endsection



