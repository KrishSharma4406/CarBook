@extends('frontend.layout.app')



@section('style')
    {{-- Page Specific CSS --}}
@endsection

@section('content')

    @include('frontend.component.offer-ride')

@endsection

@section('script')
    <script>
        console.log('Offer Ride Page Loaded');
    </script>
@endsection