@extends('admin.frontend.layout.app')



@section('style')
    {{-- Page Specific CSS --}}
@endsection

@section('content')

    @include('admin.frontend.component.forms')

@endsection

@section('script')
    <script>
        console.log('Forms Page Loaded');
    </script>
@endsection