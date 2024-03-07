
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
            <h1>Budget Category Details</h1>

            <div class="mb-3">
                <strong>Name:</strong> {{ $budgetCategory->name }}
            </div>
            <div class="mb-3">
                <strong>Allocated Budget:</strong> ${{ number_format($budgetCategory->allocated_budget, 2) }}
            </div>
            <div class="mb-3">
                <strong>Actual Spending:</strong> ${{ number_format($budgetCategory->actual_spending, 2) }}
            </div>

            <a href="{{ route('budget.index') }}" class="btn btn-primary">Back</a>
        </div>

      </div>
    </section>

  </main><!-- End #main -->
@include('layout.footer')

</body>

</html>
