@extends('layout.title')

@section('title', 'Expense Manager')

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
        <div class="row">
          <div class="container">
              <div class="container">
                  <div class="card">
              <div class="card-header">Expense Details</div>

              <div class="card-body">
                <p><strong>Date:</strong> {{ $expense->date }}</p>
                <p><strong>Amount:</strong> {{ $expense->amount }}</p>
                <p><strong>Category:</strong> {{ $expense->category }}</p>
                <p><strong>Description:</strong> {{ $expense->description }}</p>
              </div>
            </div>
          </div>
        </div>
        <div>
        <a href="{{ route('cost_allocations.index') }}" class="btn btn-primary">Back</a>
        <button id="printBtn" class="btn btn-primary"><i class="bi bi-printer-fill"></i> Print</button>
    </div>
    </div>
    </section>

  </main><!-- End #main -->
  @include('layout.footer')

  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
  <script>
      document.getElementById('printBtn').addEventListener('click', function() {
          html2canvas(document.querySelector('.card'), { // Capture the element with class 'card'
              onrendered: function(canvas) {
                  var img = canvas.toDataURL('image/jpeg'); // Convert canvas to image as JPEG
                  var link = document.createElement('a');
                  link.download = 'expense_image.jpg'; // Filename
                  link.href = img;
                  link.click();
              }
          });
      });
  </script>


</body>
</html>
