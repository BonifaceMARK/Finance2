
@extends('layout.title')

@section('title', 'Welcome to Sub-admin Dashboard')
@include('layout.title')
<body>

  <!-- ======= Header ======= -->
@include('sub-admin.header')

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
            <h1>Allocate Budget</h1>

            <form action="{{ route('budget.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" name="name" id="name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="allocated_budget" class="form-label">Allocated Budget</label>
                    <input type="number" name="allocated_budget" id="allocated_budget" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="actual_spending" class="form-label">Actual Spending</label>
                    <input type="number" name="actual_spending" id="actual_spending" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>

      </div>
    </section>

  </main><!-- End #main -->
@include('layout.footer')

</body>

</html>
