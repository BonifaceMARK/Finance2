
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
                                <h1>Index Page</h1>

                                <h2>Cost Centers</h2>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Description</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($costCenters as $costCenter)
                                        <tr>
                                            <td>{{ $costCenter->id }}</td>
                                            <td>{{ $costCenter->name }}</td>
                                            <td>{{ $costCenter->description }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <h2>Cost Categories</h2>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Description</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($costCategories as $costCategory)
                                        <tr>
                                            <td>{{ $costCategory->id }}</td>
                                            <td>{{ $costCategory->name }}</td>
                                            <td>{{ $costCategory->description }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <h2>Cost Allocation Rules</h2>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Description</th>
                                            <th>Allocation Method</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($costAllocationRules as $costAllocationRule)
                                        <tr>
                                            <td>{{ $costAllocationRule->id }}</td>
                                            <td>{{ $costAllocationRule->name }}</td>
                                            <td>{{ $costAllocationRule->description }}</td>
                                            <td>{{ $costAllocationRule->allocation_method }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <h2>Cost Entries</h2>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Cost Center</th>
                                            <th>Cost Category</th>
                                            <th>Amount</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($costEntries as $costEntry)
                                        <tr>
                                            <td>{{ $costEntry->id }}</td>
                                            <td>{{ $costEntry->costCenter->name }}</td>
                                            <td>{{ $costEntry->costCategory->name }}</td>
                                            <td>{{ $costEntry->amount }}</td>
                                            <td>{{ $costEntry->date }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <h2>Cost Allocations</h2>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Source Cost Center</th>
                                            <th>Destination Cost Center</th>
                                            <th>Cost Category</th>
                                            <th>Amount</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($costAllocations as $costAllocation)
                                        <tr>
                                            <td>{{ $costAllocation->id }}</td>
                                            <td>{{ $costAllocation->sourceCostCenter->name }}</td>
                                            <td>{{ $costAllocation->destinationCostCenter->name }}</td>
                                            <td>{{ $costAllocation->costCategory->name }}</td>
                                            <td>{{ $costAllocation->amount }}</td>
                                            <td>{{ $costAllocation->date }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
      </div>
    </section>

  </main><!-- End #main -->
@include('layout.footer')

</body>

</html>
