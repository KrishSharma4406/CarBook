@extends('frontend.layout.app')



@section('style')
    {{-- Page Specific CSS --}}
@endsection

@section('content')

    @include('frontend.component.ride-details')

@endsection

@section('script')
    <script>
        console.log('Ride Details Page Loaded');
    </script>
@endsection