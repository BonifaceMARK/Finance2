
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
            <h1>Budget Categories</h1>

            <a href="{{ route('budget.create') }}" class="btn btn-primary">Create New Category</a>

            <div class="table-responsive mt-3">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Allocated Budget</th>
                            <th>Actual Spending</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($budgetCategories as $category)
                        <tr>
                            <td>{{ $category->name }}</td>
                            <td>${{ number_format($category->allocated_budget, 2) }}</td>
                            <td>${{ number_format($category->actual_spending, 2) }}</td>
                            <td>
                                <a href="{{ route('budget.show', $category->id) }}" class="btn btn-primary">View</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

      </div>
    </section>

  </main><!-- End #main -->
@include('layout.footer')

</body>

</html>
