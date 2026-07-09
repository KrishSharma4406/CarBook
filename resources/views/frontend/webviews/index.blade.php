@extends('frontend.layout.app')



@section('style')
    <style>
        .services-wrap .services {
            transition: transform 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
            padding: 20px 10px;
            border-radius: 10px;
        }
        .services-wrap .services:hover {
            transform: translateY(-8px);
            background: #fafafa;
        }
        .services-wrap .services .icon {
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        }
        .services-wrap .services:hover .icon {
            background-color: #1089ff;
            border-color: #1089ff;
            box-shadow: 0 8px 20px rgba(16, 137, 255, 0.35);
        }
        .services-wrap .services:hover .icon span {
            color: #fff !important;
        }
        .services-wrap .btn-primary {
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
            box-shadow: 0 4px 6px rgba(16, 137, 255, 0.15);
            border-radius: 5px;
        }
        .services-wrap .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(16, 137, 255, 0.35);
        }
        .request-form .btn-secondary {
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
            border-radius: 5px;
        }
        .request-form .btn-secondary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(1, 210, 142, 0.45);
        }
        /* Beautiful interactive form fields */
        .request-form .form-control {
            transition: all 0.3s ease;
            border: 1px solid rgba(255, 255, 255, 0.1) !important;
            background: rgba(255, 255, 255, 0.05) !important;
            color: #fff !important;
            border-radius: 5px;
        }
        .request-form .form-control::placeholder {
            color: rgba(255, 255, 255, 0.5) !important;
        }
        .request-form .form-control:focus {
            background: rgba(255, 255, 255, 0.12) !important;
            border-color: rgba(255, 255, 255, 0.4) !important;
            box-shadow: 0 0 15px rgba(255, 255, 255, 0.15) !important;
        }
        /* Style fixes for datepicker/timepicker popup */
        .datepicker, .bootstrap-datetimepicker-widget {
            border-radius: 8px !important;
            box-shadow: 0 10px 30px rgba(0,0,0,0.15) !important;
            border: none !important;
            padding: 10px !important;
        }
    </style>
@endsection

@section('content')

    @include('frontend.component.index')

@endsection

@section('script')
    <script>
        console.log('Home Page Loaded');
    </script>
@endsection