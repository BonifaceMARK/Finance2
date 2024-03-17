@extends('layout.title')

@section('title', 'Cost Allocation')
@include('layout.title')

<body>

  <!-- ======= Header ======= -->
  @include('user.header')

  <!-- ======= Sidebar ======= -->
  @include('user.sidebar')

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" id="capture">
                <div class="card-header">
              Cost Allocation Details
            </div>
            <div class="card-body">
              <p><strong>Cost Center:</strong> {{ $costAllocation->cost_center }}</p>
              <p><strong>Cost Category:</strong> {{ $costAllocation->cost_category }}</p>
              <p><strong>Allocation Method:</strong> {{ $costAllocation->allocation_method }}</p>
              <p><strong>Amount:</strong> ${{ $costAllocation->amount }}</p>
              <p><strong>Description:</strong> {{ $costAllocation->description }}</p>
            </div>

          </div>
        </div>
      </div>
      <div class="card-footer">
        <a href="{{ route('cost_allocations.index') }}" class="btn btn-primary">Back</a>
        <button id="printBtn" class="btn btn-primary"><i class="bi bi-printer-fill"></i> Print</button>
      </div>
    </section>

  </main><!-- End #main -->
  @include('layout.footer')

  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
  <script>
    document.getElementById('printBtn').addEventListener('click', function() {
      html2canvas(document.getElementById('capture'), {
        onrendered: function(canvas) {
          var img = canvas.toDataURL('image/jpeg'); // Convert canvas to image as JPEG
          var link = document.createElement('a');
          link.download = 'cost_allocation_image.jpg'; // Filename
          link.href = img;
          link.click();
        }
      });
    });
  </script>

</body>

</html>
