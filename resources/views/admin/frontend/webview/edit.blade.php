@extends('admin.frontend.layout.app')



@section('style')
    {{-- Page Specific CSS --}}
@endsection

@section('content')

    @include('admin.frontend.component.edit')

@endsection

@section('script')
    <script>
        console.log('Edit Page Loaded');
    </script>
@endsection