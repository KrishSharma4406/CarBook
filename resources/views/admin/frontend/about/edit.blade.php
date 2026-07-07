@extends('admin.frontend.layout.app')
@section('content')
    <div class="container">
        <h1>About Section</h1>
        <p>{{ $about->title }}</p>
        <p>{{ $about->description }}</p>
        <p>{{ $about->vehicle }}</p>
        <p>{{ $about->title2 }}</p>
    </div>
@endsection