
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
            </div>
      </div>
    </section>

  </main><!-- End #main -->
@include('layout.footer')

</body>

</html>
