@extends('layouts.app')

{{-- @section('tab-nav') @include('layouts.tab-nav') @endsection --}}

@section('content')
    <div class="container store-list-container">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        @foreach ($allStores as $store)
            <store-panel
                store="{{ $store }}"
                store-idx="{{ $store->id }}"
                location="{{ $store->locations }}"
            >
            </store-panel>
        @endforeach
    </div>
@endsection



