@extends('frontend.layout.app')



@section('style')
    {{-- Page Specific CSS --}}
@endsection

@section('content')

    @include('frontend.component.view-rides')

@endsection

@section('script')
    <script>
        console.log('View Rides Page Loaded');
    </script>
@endsection