@extends('layout.title')

@section('title', 'Request Budget Details')

@include('layout.title')

<body>

  <!-- ======= Header ======= -->
  @include('user.header')

  <!-- ======= Sidebar ======= -->
  @include('user.sidebar')

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Request Budget Details</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('request_budgets.index') }}">Home</a></li>
          <li class="breadcrumb-item"><a href="{{ route('request_budgets.show', $requestBudget->id) }}">Request Budget Details</a></li>
          <li class="breadcrumb-item active">{{ $requestBudget->title }}</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row justify-content-center">
          <div class="col-md-8">
            <div class="card" id="capture">
              <div class="card-header">
                Request Budget Details
              </div>
              @if(session('success'))
              <div class="row">
                  <div class="col">
                      <div class="alert alert-success">
                          {{ session('success') }}
                      </div>
                  </div>
              </div>
          @endif
              <div class="card-body">
                <p><strong>Title:</strong> {{ $requestBudget->title }}</p>
                <p><strong>Description:</strong> {{ $requestBudget->description }}</p>
                <p><strong>Amount:</strong> ${{ $requestBudget->amount }}</p>
                <p><strong>Start Date:</strong> {{ $requestBudget->start_date }}</p>
                <p><strong>End Date:</strong> {{ $requestBudget->end_date }}</p>
              </div>

            </div>
          </div>
          <div class="card-footer">
            <a href="{{ route('request_budgets.create') }}" class="btn btn-primary">Back</a>
            <button id="printBtn" class="btn btn-primary"><i class="bi bi-printer-fill"></i> Print</button>
          </div>
        </div>
      </section>


  </main><!-- End #main -->
  @include('layout.footer')

  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
  <script>
    var downloadCounter = 1; // Initialize counter

    document.getElementById('printBtn').addEventListener('click', function() {
        html2canvas(document.getElementById('capture'), {
            onrendered: function(canvas) {
                var img = canvas.toDataURL('image/jpeg'); // Convert canvas to image as JPEG
                var link = document.createElement('a');

                // Generate filename with an incremented ID
                var filename = 'request_budget_image_' + downloadCounter + '.jpg';

                link.download = filename; // Set filename
                link.href = img;
                link.click();

                downloadCounter++; // Increment counter
            }
        });
    });
</script>


</body>

</html>
