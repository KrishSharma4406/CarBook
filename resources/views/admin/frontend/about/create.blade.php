@extends('admin.frontend.layout.app')
@section('content')
    <div class="container">
        <h1>Create About Section</h1>
        <form action="{{ route('admin.about.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description" required></textarea>
            </div>
            <div class="form-group">
                <label for="vehicle">Vehicle</label>
                <textarea class="form-control" id="vehicle" name="vehicle" required></textarea>
            </div>
            <div class="form-group">
                <label for="title2">Title 2</label>
                <input type="text" class="form-control" id="title2" name="title2" required>
            </div>
            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
@endsection