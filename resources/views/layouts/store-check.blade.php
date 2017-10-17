<h3 class="text-center">Available Stores</h3>
<div class="well store-box">
  <ul class="list-group checked-list-box">
    @foreach ($storeList as $key => $store)
      <li class="list-group-item checkbox" style="cursor: pointer;">
        <label>
          @if ($storesSelected->where('id',$key)->first())
            <input type="checkbox" id="store_{{ $key }}" value="{{ $key }}"  checked>{{ $store }}
          @else
            <input type="checkbox" id="store_{{ $key }}" value="{{ $key }}">{{ $store }}
          @endif
        </label>
      </li>
    @endforeach
  </ul> 
</div>
