<h3 class="text-center">Edit Campaign</h3>
<div class="well">
	<ul>
		<li>Select store to be inlcuded in this campaign.</li>
		<li>Select brands and insert brand exit url</li>
	</ul>
	
</div>
<div class="scroll-content-box">
  <ul class="list-group">
    @foreach ($storeList as $storeKey => $store)
      <li class="list-group-item checkbox" style="cursor: pointer;" id="store_{{ $storeKey }}">
      	<div class="form-inline store-section">
		        <label>
		            <input type="checkbox" class="store-item" value="{{ $storeKey }}">{{ $store }}
		        </label>
				
		    	@if(Auth::user()->name === 'Julio' || Auth::user()->name === 'admin')
					<div class="form-group">
					    <label class="sr-only" for="creativeID_{{ $storeKey }}">creative id</label>
					    <input type="text" class="form-control input-sm" id="creativeID_{{ $storeKey }}" placeholder="Creative ID">
					</div>
				@endif
		 </div>
		<div class="brand-box well well-sm hidden" >
			<div class="brand-warning bg-danger">At least one brand has to be added to save store.</div>
             @foreach ($brandList as $brandkey => $brand)
             <div class="form-inline brand-group">
             	<div class="checkbox inline-brands">
	                <label for="brandName-{{ $storeKey }}-{{ $brandkey }}">
	                 <input class="checkbox-item" type="checkbox" data-brand-id="{{ $brandkey }}" data-store-id="{{ $storeKey }}" value="{{ $brand }}" id="brandName-{{ $storeKey }}-{{ $brandkey }}"> {{ $brand }}
	                </label>
	            </div>
	            <div class="ulrBox form-group hidden">
				    <label class="sr-only" for="urlExit_{{ $storeKey }}-{{ $brandkey }}">Email address</label>
				    <input type="text" class="form-control input-sm ulrbox-item" id="urlExit_{{ $storeKey }}-{{ $brandkey }}" data-brand-id="{{ $brandkey }}" data-store-id="{{ $storeKey }}" placeholder="URL Exit">
				</div>
             </div>
             
            @endforeach
        </div>

      </li>
    @endforeach
  </ul> 
</div>
