
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
                            <div class="card-header">Edit Request Budget</div>

                            <div class="card-body">
                                <form action="{{ route('request_budgets.update', $requestBudget->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <label for="title">Title:</label>
                                        <input type="text" id="title" name="title" class="form-control" value="{{ $requestBudget->title }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Description:</label>
                                        <textarea id="description" name="description" class="form-control" rows="3">{{ $requestBudget->description }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="amount">Amount:</label>
                                        <input type="number" id="amount" name="amount" class="form-control" step="0.01" value="{{ $requestBudget->amount }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="start_date">Start Date:</label>
                                        <input type="date" id="start_date" name="start_date" class="form-control" value="{{ $requestBudget->start_date }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="end_date">End Date:</label>
                                        <input type="date" id="end_date" name="end_date" class="form-control" value="{{ $requestBudget->end_date }}">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Update</button>
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
