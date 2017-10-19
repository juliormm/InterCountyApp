{{-- {{ dump($storesSelected) }} --}}

<h3 class="text-center">Assinged Brands</h3>
<div class="well store-box">
  <ul class="list-group checked-list-box">
    @foreach ($storeList as $key => $store)
      <li class="list-group-item checkbox" style="cursor: pointer;">
        <h2>{{ $store }}</h2>
  {{--         @if ($storesSelected->where('id',$key)->first())
            <input type="text" value="{{ $storesSelected->where('id',$key)->first()->default_phone }}">
          @else
             <input type="text" value="">
          @endif --}}
        <div class="form-inline">
             @foreach ($brandList as $key => $brand)
             <div class="checkbox inline-brands">
                <label>
                 @if ($campaignData->where('id', $key)->first())
                   <input type="checkbox"> {{ $brand }}
                  @else
                     <input type="checkbox"> {{ $brand }}
                  @endif

                  {{-- <input type="checkbox"> {{ $brand }} --}}
                </label>
              </div>
            @endforeach
        </div>
      </li>
    @endforeach
  </ul> 
</div>

{{-- @foreach ($storesSelected as $store)
  <div>
    <pre>
    {{ $store }}
  </pre>
  </div>
@endforeach --}}
