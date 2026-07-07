@extends('admin.frontend.layout.app')



@section('style')
    {{-- Page Specific CSS --}}
@endsection

@section('content')

    @include('admin.frontend.component.about')

@endsection

@section('script')
    <script>
        console.log('About Page Loaded');
    </script>
@endsection