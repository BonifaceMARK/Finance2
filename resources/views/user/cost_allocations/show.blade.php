
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
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">
        <div class="container">

            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
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
                            <div class="card-footer">
                                <a href="{{ route('cost_allocations.index') }}" class="btn btn-primary">Back</a>
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
