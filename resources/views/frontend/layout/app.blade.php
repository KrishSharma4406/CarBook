<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @include('frontend.common.headerScript')
    @yield('style')
</head>

<body>
    @include('frontend.common.header')
    <!-- END nav -->
    @if(session('success'))
    <div class="position-fixed" style="top:90px; right:20px; z-index:9999; width:350px;">
        <div class="alert alert-success alert-dismissible fade show shadow rounded" role="alert">
            <i class="fa fa-check-circle mr-2"></i>
            <strong>Success!</strong> {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>
        </div>
    </div>
    @endif

    @if(session('error'))
    <div class="position-fixed" style="top:90px; right:20px; z-index:9999; width:350px;">
        <div class="alert alert-danger alert-dismissible fade show shadow rounded" role="alert">
            <i class="fa fa-times-circle mr-2"></i>
            <strong>Error!</strong> {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>
        </div>
    </div>
    @endif

    @yield('content')

    @include('frontend.common.footer')

    @include('frontend.common.footerScript')
    @yield('script')
</body>

</html>