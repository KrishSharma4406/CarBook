@extends('frontend.layout.app')



@section('style')
    {{-- Page Specific CSS --}}
@endsection

@section('content')

    @include('frontend.component.price')

@endsection

@section('script')
    <script>
        console.log('Price Page Loaded');
    </script>
@endsection