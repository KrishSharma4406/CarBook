@extends('frontend.layout.app')



@section('style')
    {{-- Page Specific CSS --}}
@endsection

@section('content')

    @include('frontend.component.booking-summary')

@endsection

@section('script')
    <script>
        console.log('Booking Summary Page Loaded');
    </script>
@endsection