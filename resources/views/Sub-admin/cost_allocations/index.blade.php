
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
                            <div class="card-header">Cost Allocations</div>

                            <div class="card-body">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Source Cost Center</th>
                                            <th>Destination Cost Center</th>
                                            <th>Cost Category</th>
                                            <th>Amount</th>
                                            <th>Date</th>
                                            <th>Allocation Method</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($costAllocations as $allocation)
                                            <tr>
                                                <td>{{ $allocation->id }}</td>
                                                <td>{{ $allocation->sourceCostCenter->name }}</td>
                                                <td>{{ $allocation->destinationCostCenter->name }}</td>
                                                <td>{{ $allocation->costCategory->name }}</td>
                                                <td>{{ $allocation->amount }}</td>
                                                <td>{{ $allocation->date }}</td>

                                                <td>
                                                    <a href="{{ route('cost_allocations.edit', $allocation->id) }}" class="btn btn-primary">Edit</a>
                                                    <form action="{{ route('cost_allocations.destroy', $allocation->id) }}" method="POST" style="display: inline-block;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
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
