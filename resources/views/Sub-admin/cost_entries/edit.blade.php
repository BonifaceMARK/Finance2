
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
                            <div class="card-header">Edit Cost Entry</div>

                            <div class="card-body">
                                <form method="POST" action="{{ route('cost_entries.update', $costEntry->id) }}">
                                    @csrf
                                    @method('PUT')

                                    <div class="form-group">
                                        <label for="cost_center_id">Cost Center</label>
                                        <select name="cost_center_id" id="cost_center_id" class="form-control" required>
                                            @foreach ($costCenters as $center)
                                                <option value="{{ $center->id }}" {{ $center->id == $costEntry->cost_center_id ? 'selected' : '' }}>{{ $center->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="cost_category_id">Cost Category</label>
                                        <select name="cost_category_id" id="cost_category_id" class="form-control" required>
                                            @foreach ($costCategories as $category)
                                                <option value="{{ $category->id }}" {{ $category->id == $costEntry->cost_category_id ? 'selected' : '' }}>{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="amount">Amount</label>
                                        <input type="text" name="amount" id="amount" class="form-control" value="{{ $costEntry->amount }}" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="date">Date</label>
                                        <input type="date" name="date" id="date" class="form-control" value="{{ $costEntry->date }}" required>
                                    </div>

                                    <button type="submit" class="btn btn-primary">Update Cost Entry</button>
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
