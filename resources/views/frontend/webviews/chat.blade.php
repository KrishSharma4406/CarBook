@extends('frontend.layout.app')



@section('style')
    {{-- Page Specific CSS --}}
@endsection

@section('content')

    @include('frontend.component.chat')

@endsection

@section('script')
    <script>
        console.log('Chat Page Loaded');
    </script>
@endsection
