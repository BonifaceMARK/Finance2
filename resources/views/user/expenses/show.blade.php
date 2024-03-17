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
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">
        <div class="container">
          <div class="container">
            <div class="row justify-content-center">
              <div class="col-md-8">
                <div class="card" id="expenseCard">
                  <div class="card-header">Expense Details</div>

                  <div class="card-body">
                    <p><strong>Date:</strong> {{ $expense->date }}</p>
                    <p><strong>Amount:</strong> {{ $expense->amount }}</p>
                    <p><strong>Category:</strong> {{ $expense->category }}</p>
                    <p><strong>Description:</strong> {{ $expense->description }}</p>
                    <button id="printBtn" class="btn btn-primary">Print as Image</button>
                  </div>
                </div>
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>

<script>
    document.getElementById('printBtn').addEventListener('click', function() {
      // Use HTML2Canvas to capture the content of the card
      html2canvas(document.getElementById('expenseCard')).then(function(canvas) {
        // Convert the canvas to a data URL
        var imgData = canvas.toDataURL('image/png');

        // Create a FormData object to send the image data to the server
        var formData = new FormData();
        formData.append('image', imgData);

        // Send the image data to the server using a POST request
        fetch('{{ route("save-image") }}', {
          method: 'POST',
          body: formData
        })
        .then(response => {
          if (response.ok) {
            console.log('Image saved successfully');
            // Optionally display a success message
            alert('Image saved successfully');
          } else {
            console.error('Failed to save image');
            // Optionally display an error message
            alert('Failed to save image');
          }
        })
        .catch(error => {
          console.error('Error saving image:', error);
          // Optionally display an error message
          alert('Error saving image');
        });
      })
      .catch(function(error) {
        console.error('Error capturing screenshot:', error);
        // Optionally display an error message
        alert('Error capturing screenshot');
      });
    });
  </script>

