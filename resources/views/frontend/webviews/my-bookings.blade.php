@extends('frontend.layout.app')



@section('style')
    {{-- Page Specific CSS --}}
@endsection

@section('content')

    @include('frontend.component.my-bookings')

@endsection

@section('script')
    <script>
        console.log('My Bookings Page Loaded');
    </script>
@endsection