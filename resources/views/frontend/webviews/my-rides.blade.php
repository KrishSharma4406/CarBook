@extends('frontend.layout.app')



@section('style')
    {{-- Page Specific CSS --}}
@endsection

@section('content')

    @include('frontend.component.my-rides')

@endsection

@section('script')
    <script>
        console.log('My Rides Page Loaded');
    </script>
@endsection