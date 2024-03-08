
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
                            <div class="card-header">Create New Cost Entry</div>

                            <div class="card-body">
                                <form method="POST" action="{{ route('cost_entries.store') }}">
                                    @csrf

                                    <div class="form-group">
                                        <label for="cost_center_id">Cost Center</label>
                                        <select name="cost_center_id" id="cost_center_id" class="form-control" required>
                                            <option value="">Select Cost Center</option>
                                            @foreach ($costCenters as $costCenter)
                                                <option value="{{ $costCenter->id }}">{{ $costCenter->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="cost_category_id">Cost Category</label>
                                        <select name="cost_category_id" id="cost_category_id" class="form-control" required>
                                            <option value="">Select Cost Category</option>
                                            @foreach ($costCategories as $costCategory)
                                                <option value="{{ $costCategory->id }}">{{ $costCategory->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="amount">Amount</label>
                                        <input type="text" name="amount" id="amount" class="form-control" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="date">Date</label>
                                        <input type="date" name="date" id="date" class="form-control" required>
                                    </div>

                                    <button type="submit" class="btn btn-primary">Create Cost Entry</button>
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
