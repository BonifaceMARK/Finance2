
@extends('layout.title')

@section('title', 'Employee Dashboard')
@include('layout.title')
<body>

  <!-- ======= Header ======= -->
@include('admin.header')


  <!-- ======= Sidebar ======= -->
 @include('admin.sidebar')

  <main id="main" class="main">

    <section class="section dashboard">
      <div class="row">

        <div class="card">
            <div class="card-body">
              <h5 class="card-title text-center">"Finance is the silent architect of prosperity, weaving together the threads of investments, savings, and careful planning to build a future of abundance." </h5>

              <!-- Slides with captions -->
              <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                  <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                  <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                  <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                  <div class="carousel-item active">
                    <img src="{{asset('assets/img/plash1.jpg')}}" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                      <h5>Financial Guardians</h5>
                      <p>"The stock market is filled with individuals who know the price of everything, but the value of nothing." - Philip Fisher</p>
                    </div>
                  </div>
                  <div class="carousel-item">
                    <img src="{{asset('assets/img/unsplash2.jpg')}}" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                      <h5>Financial Guardians</h5>
                      <p>"Finance is not merely about making money. It's about achieving dreams, securing futures, and building legacies."</p>
                    </div>
                  </div>
                  <div class="carousel-item">
                    <img src="{{asset('assets/img/unsplash3.jpg')}}" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                      <h5>Financial Guardians</h5>
                      <p>"Finance is the art of turning dreams into reality and ensuring that every penny spent paves the way for a brighter tomorrow."</p>
                    </div>
                  </div>
                </div>

                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Next</span>
                </button>

              </div><!-- End Slides with captions -->

            </div>
          </div>

        </div>
      </div>

      </div>
    </section>

  </main><!-- End #main -->
@include('layout.footer')

</body>

</html>
