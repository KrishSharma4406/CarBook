@extends('frontend.layout.app')



@section('style')
    {{-- Page Specific CSS --}}
@endsection

@section('content')

    @include('frontend.component.service')

@endsection

@section('script')
    <script>
        console.log('Service Page Loaded');
    </script>
@endsection