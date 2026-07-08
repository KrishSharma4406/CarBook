@extends('admin.frontend.layout.app')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">View Contact Message</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('contact-messages.index') }}">Contact Messages</a></li>
                        <li class="breadcrumb-item active">View Details</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">

            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">Message Details</h3>
                </div>
                
                <div class="card-body p-0">
                    <div class="mailbox-read-info">
                        <h5>Subject: {{ $contactMessage->subject }}</h5>
                        <h6 class="mt-2">
                            From: {{ $contactMessage->name }} (<a href="mailto:{{ $contactMessage->email }}">{{ $contactMessage->email }}</a>)
                            <span class="mailbox-read-time float-right">{{ $contactMessage->created_at->format('M. d, Y h:i A') }}</span>
                        </h6>
                    </div>
                    
                    <div class="mailbox-read-message p-4 border-top bg-light" style="font-size: 16px; line-height: 1.6; color: #444; min-height: 150px;">
                        {!! nl2br(e($contactMessage->message)) !!}
                    </div>
                </div>

                <div class="card-footer d-flex justify-content-between">
                    <a href="{{ route('contact-messages.index') }}" class="btn btn-default">
                        <i class="fas fa-arrow-left mr-2"></i> Back to Messages
                    </a>
                    @can('contact.delete')
                    <form action="{{ route('contact-messages.destroy', $contactMessage->id) }}" 
                          method="POST" 
                          onsubmit="return confirm('Are you sure you want to delete this message?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-trash-alt mr-2"></i> Delete Message
                        </button>
                    </form>
                    @endcan
                </div>
            </div>

        </div>
    </section>
</div>
@endsection
