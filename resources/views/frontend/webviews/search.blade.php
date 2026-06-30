@extends('frontend.layout.app')



@section('style')
    {{-- Page Specific CSS --}}
@endsection

@section('content')

    @include('frontend.component.search')

@endsection

@section('script')
    <script>
        console.log('Search Page Loaded');
    </script>
@endsection