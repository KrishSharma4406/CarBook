@extends('frontend.layout.app')



@section('style')
    {{-- Page Specific CSS --}}
@endsection

@section('content')

    @include('frontend.component.blog')

@endsection

@section('script')
    <script>
        console.log('Blog Page Loaded');
    </script>
@endsection