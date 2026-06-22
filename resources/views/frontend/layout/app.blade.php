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
    @yield('content')

    @include('frontend.common.footer')

    @include('frontend.common.footerScript')
    @yield('script')
  </body>
</html>