
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
                            <div class="card-header">Edit Cost Allocation</div>

                            <div class="card-body">
                                <form method="POST" action="{{ route('cost_allocations.update', $costAllocation->id) }}">
                                    @csrf
                                    @method('PUT')

                                    <div class="form-group">
                                        <label for="source_cost_center_id">Source Cost Center</label>
                                        <select name="source_cost_center_id" id="source_cost_center_id" class="form-control" required>
                                            <option value="">Select Source Cost Center</option>
                                            @foreach ($costCenters as $costCenter)
                                                <option value="{{ $costCenter->id }}" {{ $costCenter->id == $costAllocation->source_cost_center_id ? 'selected' : '' }}>{{ $costCenter->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="destination_cost_center_id">Destination Cost Center</label>
                                        <select name="destination_cost_center_id" id="destination_cost_center_id" class="form-control" required>
                                            <option value="">Select Destination Cost Center</option>
                                            @foreach ($costCenters as $costCenter)
                                                <option value="{{ $costCenter->id }}" {{ $costCenter->id == $costAllocation->destination_cost_center_id ? 'selected' : '' }}>{{ $costCenter->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="cost_category_id">Cost Category</label>
                                        <select name="cost_category_id" id="cost_category_id" class="form-control" required>
                                            <option value="">Select Cost Category</option>
                                            @foreach ($costCategories as $costCategory)
                                                <option value="{{ $costCategory->id }}" {{ $costCategory->id == $costAllocation->cost_category_id ? 'selected' : '' }}>{{ $costCategory->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="amount">Amount</label>
                                        <input type="text" name="amount" id="amount" class="form-control" value="{{ $costAllocation->amount }}" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="date">Date</label>
                                        <input type="date" name="date" id="date" class="form-control" value="{{ $costAllocation->date }}" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="allocation_method_id">Allocation Method</label>
                                        <select name="allocation_method_id" id="allocation_method_id" class="form-control" required>
                                            <option value="">Select Allocation Method</option>
                                            @foreach ($allocationMethods as $method)
                                                <option value="{{ $method->id }}" {{ $method->id == $costAllocation->allocation_method_id ? 'selected' : '' }}>{{ $method->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <button type="submit" class="btn btn-primary">Update Cost Allocation</button>
                                </form>
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
