@extends('layout.title')

@section('title', 'Login ')
@include('layout.title')
<body>

    <main>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">{{ __('Finance Terms and Agreement') }}</div>

                        <div class="card-body">
                            <h2>Finance Terms and Agreement</h2>

                            <p>This finance terms and agreement ("Agreement") is entered into between [Your Company Name] ("Company") and the user ("User") accessing or using the finance services provided by the Company.</p>

                            <h3>1. Acceptance of Terms</h3>
                            <p>By accessing or using the finance services provided by the Company, the User agrees to be bound by this Agreement.</p>

                            <h3>2. Description of Services</h3>
                            <p>The Company provides financial services, including but not limited to budget planning, expense tracking, and financial analysis.</p>

                            <h3>3. User Responsibilities</h3>
                            <p>The User agrees to use the Company's finance services responsibly and in accordance with all applicable laws and regulations.</p>

                            <h3>4. Privacy Policy</h3>
                            <p>The Company's privacy policy governs the collection, use, and disclosure of personal information provided by the User. By using the finance services, the User agrees to the terms of the privacy policy.</p>

                            <h3>5. Disclaimer of Warranties</h3>
                            <p>The Company's finance services are provided on an "as is" and "as available" basis, without any warranties of any kind.</p>

                            <h3>6. Limitation of Liability</h3>
                            <p>The Company shall not be liable for any indirect, incidental, special, consequential, or punitive damages arising out of or related to the use of its finance services.</p>

                            <h3>7. Governing Law</h3>
                            <p>This Agreement shall be governed by and construed in accordance with the laws of [Your Jurisdiction].</p>

                            <h3>8. Contact Information</h3>
                            <p>If you have any questions or concerns about this Agreement, please contact us at [Your Contact Information].</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</main><!-- End #main -->
<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src="{{ asset('assets/vendor/apexcharts/apexcharts.min.js') }}"></script>
<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/vendor/chart.js/chart.umd.js') }}"></script>
<script src="{{ asset('assets/vendor/echarts/echarts.min.js') }}"></script>
<script src="{{ asset('assets/vendor/quill/quill.min.js') }}"></script>
<script src="{{ asset('assets/vendor/simple-datatables/simple-datatables.js') }}"></script>
<script src="{{ asset('assets/vendor/tinymce/tinymce.min.js') }}"></script>
<script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>

<!-- Template Main JS File -->
<script src="{{ asset('assets/js/main.js') }}"></script>

</body>

</html>
