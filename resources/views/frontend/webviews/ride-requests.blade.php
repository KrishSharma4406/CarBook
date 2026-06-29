@extends('frontend.layout.app')



@section('style')
    {{-- Page Specific CSS --}}
@endsection

@section('content')

    @include('frontend.component.ride-requests')

@endsection

@section('script')
    <script>
        console.log('Ride Requests Page Loaded');
    </script>
@endsection