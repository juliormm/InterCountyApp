@extends('layouts.app')

{{-- @section('tab-nav')
	@include('layouts.tab-nav')
@endsection --}}

@section('content')
	<div class="container store-list-container">
   

			@if (session('status'))
			    <div class="alert alert-success">
			        {{ session('status') }}
			    </div>
			@endif
		
			@foreach ($allStores as $store)
				 <div class="row well {{ (session('new_id') == $store->id) ? 'new-item' : '' }}">

					<div class="col-sm-4"> 
						<div class="media">
						  <div class="media-left">
							@if (empty($store->logo))
								ask admin to insert logo
							@else
								<img class="media-object icon-logo" src="//quicktransmit.com/api/campaigns/_cdn/InterCountyApplianceGroupRINT041/store_logos/{{ $store->logo }}" alt="logo">
							@endif
						      

						  </div>
						  <div class="media-body">

						    <strong>Store Name:</strong> {{$store->name}} <br>
						   	<strong>Default Phone:</strong> {{$store->default_phone}}
						  </div>
						</div>
					</div>
					<div class="col-sm-7">
						<ul class="list-group">
						@foreach ($store->locations as $loc)
							  <li class="list-group-item">
							  	<ul>
							  		<li><strong>Address:</strong> {{ $loc->address }}</li>
							  		<li><strong>Phone:</strong> {{ $loc->phone }}</li>
							  	</ul>
							  </li>
						@endforeach
						</ul>
					</div>
					<div class="col-sm-1">
						<a href="{{ url('/stores/'.$store->id.'/edit') }}" role="button" class="btn btn-success btn-sm">Edit</a>
					</div>
    			</div>

			@endforeach


</div>

@endsection



