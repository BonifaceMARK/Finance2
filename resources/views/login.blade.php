@extends('layout.title')

@section('title', 'Login')
@include('layout.title')

<body>

<main>
    <div class="container">

        <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
            <div class="container">
                <div class="row">

                    <div class="col-lg-4 col-md-4 d-flex flex-column align-items-center justify-content-center">
                        <div class="card mb-2">

                            <div class="card-body">

                                <div class="pt-4 pb-2">
                                    <a href="/" class="logo d-flex align-items-center w-auto">
                                        <img src="assets/img/fmslogo.png" alt="">
                                        <h5 class="card-title text-center pb-0 fs-4">Welcome to Budget Manager</h5>
                                    </a>

                                    <p class="text-center small">Enter your email, username & password to login</p>
                                </div>
                                <form action="{{ route('login') }}" method="post" class="row g-3 needs-validation"
                                      novalidate id="lgonfrm">
                                    @csrf
                                    @if(session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                    <div class="col-12">
                                        <label for="yourEmail" class="form-label">Email</label>
                                        <div class="input-group has-validation">
                                            <span class="input-group-text" id="inputGroupPrepend">@</span>
                                            <input type="email" name="email" class="form-control" id="yourEmail"
                                                   required>
                                            <div class="invalid-feedback">The email must be a valid email address.</div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <label for="yourPassword" class="form-label">Password</label>
                                        <input type="password" name="password" class="form-control" id="yourPassword"
                                               required>
                                        <div class="invalid-feedback">Please enter your password!</div>
                                    </div>

                                    <div class="col-12">
                                        <button class="btn btn-primary w-100" type="submit">Login</button>
                                    </div>
                                </form>
                                <div class="text-center mt-3">
                                    <p>Don't have an account? <a href="{{ route('register') }}">Create an account</a></p>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-lg-8 col-md-8 d-flex flex-column align-items-center justify-content-center">
                        <div class="d-flex flex-grow-1 align-items-center">

                            <div id="carouselExampleCaptions" class="carousel slide rounded" data-bs-ride="carousel">
                                <div class="carousel-indicators">
                                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0"
                                            class="active" aria-current="true" aria-label="Slide 1"></button>
                                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
                                            aria-label="Slide 2"></button>
                                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
                                            aria-label="Slide 3"></button>
                                </div>

                                <div class="carousel-inner rounded">
                                    <div class="carousel-item active">
                                        <img src="{{ asset('assets/img/unsplash2.jpg') }}" class="d-block w-100" alt="...">
                                        <div class="carousel-caption d-none d-md-block">
                                            <p>"The stock market is filled with individuals who know the price of everything, but the value of nothing." - Philip Fisher</p>
                                        </div>
                                    </div>

                                    <div class="carousel-item">
                                        <img src="{{ asset('assets/img/unsplash3.jpg') }}" class="d-block w-100" alt="...">
                                        <div class="carousel-caption d-none d-md-block">
                                            <p>"Do not save what is left after spending, but spend what is left after saving." - Warren Buffett</p>
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <img src="{{ asset('assets/img/plash1.jpg') }}" class="d-block w-100" alt="...">
                                        <div class="carousel-caption d-none d-md-block">
                                            <p>"The most important investment you can make is in yourself." - Warren Buffett</p>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- End Slides with captions -->
                        </div>
                    </div>


                </div>
            </div>
        </section>

    </div>
</main><!-- End #main -->
<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
        class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src="{{ asset('assets/vendor/apexcharts/apexcharts.min.js') }}"></script>
<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/vendor/chart.js/chart.umd.js') }}"></script>
<script src="{{ asset('assets/vendor/echarts/echarts.min.js') }}"></script>
<script src="{{ asset('assets/vendor/quill/quill.min.js') }}"></script>
<script src="{{ asset('assets/vendor/simple-datatables/simple-datatables.js') }}"></script>
<script src="{{ asset('assets/vendor/tinymce/tinymce.min.js') }}"></script>
<script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>

<!-- Custom JS for Email Validation -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const emailField = document.getElementById('yourEmail');
        const emailError = document.getElementById('emailError');

        emailField.addEventListener('blur', function () {
            const emailValue = emailField.value;
            const domain = emailValue.split('@')[1];

            // Check if the email is from Gmail or Yahoo domain
            if (domain !== 'gmail.com' && domain !== 'yahoo.com') {
                emailError.textContent = 'Only Gmail and Yahoo emails are allowed.';
            } else {
                emailError.textContent = '';
            }
        });
    });
</script>

<!-- Template Main JS File -->
<script src="{{ asset('assets/js/main.js') }}"></script>

</body>

</html>
