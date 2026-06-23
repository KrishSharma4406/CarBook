@extends('frontend.layout.app')



@section('style')
    {{-- Page Specific CSS --}}
@endsection

@section('content')

    @include('frontend.component.car')

@endsection

@section('script')
    <script>
        console.log('Car Page Loaded');
    </script>
@endsection