@extends('frontend.layout.app')



@section('style')
    {{-- Page Specific CSS --}}
@endsection

@section('content')

    @include('frontend.component.about')

@endsection

@section('script')
    <script>
        console.log('Home Page Loaded');
    </script>
@endsection