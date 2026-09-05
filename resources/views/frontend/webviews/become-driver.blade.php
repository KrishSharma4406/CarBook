@extends('frontend.layout.app')

@section('style')
<style>
    .become-driver-section {
        padding: 5em 0;
        position: relative;
    }
    .driver-card {
        background: #ffffff;
        border-radius: 12px;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.08);
        padding: 40px;
        margin-top: -80px;
        position: relative;
        z-index: 10;
        border: 1px solid rgba(0,0,0,0.05);
    }
    .driver-card .section-header {
        border-bottom: 2px solid #f0f3f8;
        padding-bottom: 20px;
        margin-bottom: 30px;
    }
    .driver-card .section-title {
        font-weight: 700;
        color: #1089ff;
        font-size: 26px;
        margin-bottom: 8px;
    }
    .driver-benefit-box {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        padding: 20px;
        text-align: center;
        transition: all 0.3s ease;
        height: 100%;
    }
    .driver-benefit-box:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(16, 137, 255, 0.12);
        border-color: #1089ff;
    }
    .driver-benefit-box .benefit-icon {
        width: 55px;
        height: 55px;
        border-radius: 50%;
        background: rgba(16, 137, 255, 0.1);
        color: #1089ff;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        margin-bottom: 12px;
    }
    .form-section-title {
        font-size: 18px;
        font-weight: 600;
        color: #2d3748;
        margin-top: 25px;
        margin-bottom: 18px;
        padding-bottom: 8px;
        border-bottom: 1px dashed #e2e8f0;
        display: flex;
        align-items: center;
    }
    .form-section-title i {
        margin-right: 10px;
        color: #1089ff;
    }
    .driver-card .form-control {
        height: 48px;
        border-radius: 6px;
        border: 1px solid #cbd5e1;
        font-size: 15px;
        transition: all 0.2s ease;
    }
    .driver-card textarea.form-control {
        height: auto;
    }
    .driver-card .form-control:focus {
        border-color: #1089ff;
        box-shadow: 0 0 0 3px rgba(16, 137, 255, 0.15);
    }
    .driver-card .form-group label {
        font-weight: 600;
        font-size: 14px;
        color: #475569;
        margin-bottom: 6px;
    }
    .driver-card .form-group label .required {
        color: #ef4444;
    }
    .custom-file-upload {
        border: 2px dashed #cbd5e1;
        border-radius: 8px;
        padding: 20px;
        text-align: center;
        background: #f8fafc;
        cursor: pointer;
        transition: all 0.2s ease;
    }
    .custom-file-upload:hover {
        border-color: #1089ff;
        background: #eff6ff;
    }
    .btn-submit-driver {
        background: #1089ff;
        color: #ffffff;
        padding: 14px 35px;
        font-size: 16px;
        font-weight: 600;
        border-radius: 8px;
        border: none;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(16, 137, 255, 0.3);
    }
    .btn-submit-driver:hover {
        background: #0070e0;
        color: #ffffff;
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(16, 137, 255, 0.4);
    }
    .existing-app-banner {
        background: linear-gradient(135deg, #e0f2fe, #bae6fd);
        border: 1px solid #7dd3fc;
        border-radius: 8px;
        padding: 16px 20px;
        margin-bottom: 25px;
    }
</style>
@endsection

@section('content')
    @include('frontend.component.become-driver')
@endsection

@section('script')
<script>
    // Preview selected file name
    document.addEventListener('DOMContentLoaded', function() {
        const fileInput = document.getElementById('license_document');
        const fileNameDisplay = document.getElementById('file-name-display');
        
        if (fileInput && fileNameDisplay) {
            fileInput.addEventListener('change', function() {
                if (this.files && this.files.length > 0) {
                    fileNameDisplay.textContent = 'Selected: ' + this.files[0].name;
                    fileNameDisplay.classList.remove('text-muted');
                    fileNameDisplay.classList.add('text-primary', 'font-weight-bold');
                } else {
                    fileNameDisplay.textContent = 'No file chosen (JPG, PNG, PDF up to 5MB)';
                    fileNameDisplay.classList.remove('text-primary', 'font-weight-bold');
                    fileNameDisplay.classList.add('text-muted');
                }
            });
        }
    });
</script>
@endsection
