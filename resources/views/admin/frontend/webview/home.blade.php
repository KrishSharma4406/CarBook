@extends('admin.frontend.layout.app')



@section('style')
    {{-- Page Specific CSS --}}
@endsection

@section('content')

    @include('admin.frontend.component.home')

@endsection

@section('script')
    <script>
        console.log('Home Page Loaded');
    </script>
@endsection