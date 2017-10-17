@extends('layouts.app')

@section('tab-nav')
	@include('layouts.tab-nav')
@endsection

@section('content')
<div class="container">
    <div class="row">
        
		<div class="col-sm-6">
			@include('layouts.store-check')
		</div>
		<div class="col-sm-6">
			@include('layouts.store-brands')
		</div>
    </div>
</div>

{{-- <example-component></example-component> --}}

@endsection



