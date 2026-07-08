@extends('admin.frontend.layout.app')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Contact Messages</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Contact Messages</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    <i class="fas fa-check-circle mr-2"></i>
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                </div>
            @endif

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">All Customer Inquiries</h3>
                </div>

                <div class="card-body p-0">
                    <table class="table table-bordered table-hover mb-0">
                        <thead>
                            <tr>
                                <th style="width: 60px;">ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Subject</th>
                                <th>Date Received</th>
                                <th style="width: 180px;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($messages as $msg)
                                <tr>
                                    <td>{{ $msg->id }}</td>
                                    <td><strong>{{ $msg->name }}</strong></td>
                                    <td><a href="mailto:{{ $msg->email }}">{{ $msg->email }}</a></td>
                                    <td>{{ $msg->subject }}</td>
                                    <td>{{ $msg->created_at->format('M. d, Y h:i A') }}</td>
                                    <td>
                                        <div class="d-flex">
                                            @can('contact.view')
                                            <a href="{{ route('contact-messages.show', $msg->id) }}" 
                                               class="btn btn-info btn-sm mr-2">
                                                <i class="fas fa-eye mr-1"></i> View
                                            </a>
                                            @endcan
                                            @can('contact.delete')
                                            <form action="{{ route('contact-messages.destroy', $msg->id) }}" 
                                                  method="POST" 
                                                  onsubmit="return confirm('Are you sure you want to delete this message?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    <i class="fas fa-trash mr-1"></i> Delete
                                                </button>
                                            </form>
                                            @endcan
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4">No contact messages found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($messages->hasPages())
                    <div class="card-footer clearfix">
                        <div class="d-flex justify-content-between align-items-center">
                            <small class="text-muted">
                                Showing {{ $messages->firstItem() }} to {{ $messages->lastItem() }} of {{ $messages->total() }} messages
                            </small>
                            {{ $messages->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                @endif
            </div>

        </div>
    </section>
</div>
@endsection
