
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

            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">Cost Allocation Details</div>

                            <div class="card-body">
                                <div class="form-group">
                                    <label for="source_cost_center">Source Cost Center</label>
                                    <input type="text" id="source_cost_center" class="form-control" value="{{ $costAllocation->sourceCostCenter->name }}" readonly>
                                </div>

                                <div class="form-group">
                                    <label for="destination_cost_center">Destination Cost Center</label>
                                    <input type="text" id="destination_cost_center" class="form-control" value="{{ $costAllocation->destinationCostCenter->name }}" readonly>
                                </div>

                                <div class="form-group">
                                    <label for="cost_category">Cost Category</label>
                                    <input type="text" id="cost_category" class="form-control" value="{{ $costAllocation->costCategory->name }}" readonly>
                                </div>

                                <div class="form-group">
                                    <label for="amount">Amount</label>
                                    <input type="text" id="amount" class="form-control" value="{{ $costAllocation->amount }}" readonly>
                                </div>

                                <div class="form-group">
                                    <label for="date">Date</label>
                                    <input type="text" id="date" class="form-control" value="{{ $costAllocation->date }}" readonly>
                                </div>

                                <a href="{{ route('cost_allocations.index') }}" class="btn btn-secondary">Back</a>
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
