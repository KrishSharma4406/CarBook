@extends('frontend.layout.app')



@section('style')
    {{-- Page Specific CSS --}}
@endsection

@section('content')

    @include('frontend.component.car-details')

@endsection

@section('script')
    <script>
        console.log('Car Details Page Loaded');
    </script>
@endsection