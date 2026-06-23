@extends('frontend.layout.app')



@section('style')
    {{-- Page Specific CSS --}}
@endsection

@section('content')

    @include('frontend.component.contact')

@endsection

@section('script')
    <script>
        console.log('Contact Page Loaded');
    </script>
@endsection