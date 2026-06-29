@extends('frontend.layout.app')



@section('style')
    {{-- Page Specific CSS --}}
@endsection

@section('content')

    @include('frontend.component.dashboard')

@endsection

@section('script')
    <script>
        console.log('Dashboard Page Loaded');
    </script>
@endsection