<div id="store-list-campaign" class="scroll-content-box">
    @foreach ($groupedStores as $key => $store)
        <campaign-panel
            campaign="{{ $store }}"
        >
        </campaign-panel>
    @endforeach
{{-- <div class="loading-blocker">
        <div class="spinner spinner--blue">
            <div class="spinner__item1"></div>
            <div class="spinner__item2"></div>
            <div class="spinner__item3"></div>
            <div class="spinner__item4"></div>
        </div>
    </div> --}}
</div>