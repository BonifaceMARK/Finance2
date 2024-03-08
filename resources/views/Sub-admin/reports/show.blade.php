
@extends('layout.title')

@section('title', 'Welcome to Sub-admin Dashboard')
@include('layout.title')
<body>

  <!-- ======= Header ======= -->
@include('Sub-admin.header')

  <!-- ======= Sidebar ======= -->
@include('Sub-admin.sidebar')

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
            <div class="row justify-content-center">
                <div class="col-md-8">
                  <div class="card">
                    <div class="card-header">Report Details</div>

                    <div class="card-body">
                      <div class="form-group">
                        <label for="category">Category</label>
                        <input type="text" class="form-control" id="category" value="{{ $report->category }}" readonly>
                      </div>

                      <div class="form-group">
                        <label for="expense">Expense</label>
                        <input type="text" class="form-control" id="expense" value="{{ $report->expense }}" readonly>
                      </div>

                      <div class="form-group">
                        <label for="date">Date</label>
                        <input type="text" class="form-control" id="date" value="{{ $report->date }}" readonly>
                      </div>

                      <a href="{{ route('reports.index') }}" class="btn btn-primary">Back</a>
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
