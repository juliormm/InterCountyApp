@extends('layouts.app') 
@section('tab-nav') 
	@include('layouts.tab-nav') 
@endsection 

@section('content')
    <div class="container">
        		<form method="POST" action="{{ $formURL }}" accept-charset="UTF-8">
        		<div class="row">
        	<div class="col-sm-12">
		        {{ csrf_field() }}
		        @if (!Request::is('stores/create') )
		        	{{ method_field('PUT') }} 
		        @endif
		        @if(count($errors) > 0 )
		        <div class="has-error">
		        	 <ul>
		                @foreach($errors->all() as $error)
		                <li>{{ $error }}</li>
		                @endforeach
		            </ul>
		        </div>
				@endif
		            <div class="form-group">
		                <label for="name">Store Name</label>
		                <input class="form-control" placeholder="My Store Name" name="name" type="text" value="{{ old('name',$store->name) }}">
		            </div>
		             <div class="form-group">
		                <label for="name">Default Phone</label>
		                <input class="form-control" placeholder="xxx xxx xxxx" name="default_phone" type="text" value="{{ old('default_phone', $store->default_phone) }}">
		            </div>
		            <h4>Add up to 5 locations</h4>
					<div class="">

							@for ($i = 0; $i < 5; $i++)
								<div class="well well-sm">
				                    <h3>Location {{ $i + 1 }}</h3>
				                    <input type="hidden" name="locaction[{{ $i + 1  }}][id]" value="{{ (!empty($store->locations->get($i, null) ) ) ? $store->locations->get($i)->id : 'new' }}">
				                    <div class="form-group">
				                        <label for="logo">Address</label>
				                        <input class="form-control" placeholder="location address" name="locaction[{{ $i + 1  }}][address]" type="text" value="{{ old('address', (!empty($store->locations->get($i, null) ) ) ? $store->locations->get($i)->address : '' ) }}">
				                    </div>
				                    <div class="form-group">
				                        <label for="logo">Phone</label>
				                        <input class="form-control" placeholder="location phone" name="locaction[{{ $i + 1 }}][phone]" type="text" value="{{ old('phone', (!empty($store->locations->get($i, null) ) ) ? $store->locations->get($i)->phone : '' ) }}">
				                    </div>
				                </div>

							@endfor
		            </div>
		            <button class="btn btn-success float-btn" type="submit">Save Store</button>
		                </div>
        </div>
	        	</form>
	   
    </div>

@endsection