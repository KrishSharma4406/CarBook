<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Dashboard</title>
  @include('admin.frontend.common.headerScript')
    @yield('style')
  </head>
  <body>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    @include('admin.frontend.common.header')
    @include('admin.frontend.common.header2')
    <!-- END nav -->
    @yield('content')

    @include('admin.frontend.common.footer')

    @include('admin.frontend.common.footerScript')
    @yield('script')
  </body>