@extends('frontend.layout.app')



@section('style')
    {{-- Page Specific CSS --}}
@endsection

@section('content')

    @include('frontend.component.blog-details')

@endsection

@section('script')
    <script>
        console.log('Blog Details Page Loaded');
    </script>
@endsection