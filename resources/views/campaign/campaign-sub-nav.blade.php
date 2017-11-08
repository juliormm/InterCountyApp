<div class="bottom-spacer">
	<ul class="nav nav-tabs">
	 

	  <li role="presentation" class="{{ Request::is('campaigns/'.$campaignObj->id.'/status') ? 'active' : '' }}"><a href="{{ url('/campaigns/'.$campaignObj->id.'/status') }}">Status</a></li>

	   <li role="presentation" class="{{ Request::is('campaigns/'.$campaignObj->id.'/edit') ? 'active' : '' }}"><a href="{{ url('/campaigns/'.$campaignObj->id.'/edit') }}">Stores</a></li>


{{-- 	  <li role="presentation" class="{{ Request::is('stores') ? 'active' : '' }}"><a href="{{ url('/stores') }}">Store List</a></li>
	  <li role="presentation" class="{{ Request::is('stores/create') ? 'active' : '' }}"><a href="{{ url('/stores/create') }}">Add Store</a></li> --}}
	</ul> 
{{-- 
	<ol class="breadcrumb">
		  <li><a href="#">Store List</a></li>
		  <li><a href="#">Library</a></li>
		  <li class="active">Data</li>
	</ol> --}}


</div>
