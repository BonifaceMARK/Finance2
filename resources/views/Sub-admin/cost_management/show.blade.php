
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
                    <div class="col-md-6 offset-md-3">
                        <div class="card">
                            <div class="container">
                                <h1>Show Page</h1>

                                <h2>Show Cost Center</h2>
                                <div>
                                    <p><strong>Name:</strong> {{ $costCenter->name }}</p>
                                    <p><strong>Description:</strong> {{ $costCenter->description }}</p>
                                </div>

                                <h2>Show Cost Category</h2>
                                <div>
                                    <p><strong>Name:</strong> {{ $costCategory->name }}</p>
                                    <p><strong>Description:</strong> {{ $costCategory->description }}</p>
                                </div>

                                <h2>Show Cost Allocation Rule</h2>
                                <div>
                                    <p><strong>Name:</strong> {{ $costAllocationRule->name }}</p>
                                    <p><strong>Description:</strong> {{ $costAllocationRule->description }}</p>
                                    <p><strong>Allocation Method:</strong> {{ $costAllocationRule->allocation_method }}</p>
                                </div>

                                <h2>Show Cost Entry</h2>
                                <div>
                                    <p><strong>Cost Center:</strong> {{ $costEntry->costCenter->name }}</p>
                                    <p><strong>Cost Category:</strong> {{ $costEntry->costCategory->name }}</p>
                                    <p><strong>Amount:</strong> {{ $costEntry->amount }}</p>
                                    <p><strong>Date:</strong> {{ $costEntry->date }}</p>
                                </div>

                                <h2>Show Cost Allocation</h2>
                                <div>
                                    <p><strong>Source Cost Center:</strong> {{ $costAllocation->sourceCostCenter->name }}</p>
                                    <p><strong>Destination Cost Center:</strong> {{ $costAllocation->destinationCostCenter->name }}</p>
                                    <p><strong>Cost Category:</strong> {{ $costAllocation->costCategory->name }}</p>
                                    <p><strong>Amount:</strong> {{ $costAllocation->amount }}</p>
                                    <p><strong>Date:</strong> {{ $costAllocation->date }}</p>
                                </div>
                            </div>
      </div>
    </section>

  </main><!-- End #main -->
@include('layout.footer')

</body>

</html>
