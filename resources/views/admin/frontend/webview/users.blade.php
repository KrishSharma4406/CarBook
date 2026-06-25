@extends('admin.frontend.layout.app')



@section('style')
    {{-- Page Specific CSS --}}
@endsection

@section('content')

    @include('admin.frontend.component.users')

@endsection

@section('script')
    <script>
        console.log('Users Page Loaded');
    </script>
@endsection