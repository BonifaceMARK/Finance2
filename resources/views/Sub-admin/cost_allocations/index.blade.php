
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
                            <div class="card-header">
                                Cost Allocations
                                <a href="{{ route('cost_allocations.create') }}" class="btn btn-primary btn-sm float-end">Create New</a>
                            </div>
                            <div class="card-body">
                                @if ($message = Session::get('success'))
                                    <div class="alert alert-success">
                                        {{ $message }}
                                    </div>
                                @endif

                                <table class="table table-bordered">
                                    <tr>
                                        <th>No</th>
                                        <th>Cost Center</th>
                                        <th>Cost Category</th>
                                        <th>Allocation Method</th>
                                        <th>Amount</th>
                                        <th>Description</th>
                                        <th>Action</th>
                                    </tr>
                                    @foreach ($costAllocations as $key => $costAllocation)
                                        <tr>
                                            <td>{{ ++$key }}</td>
                                            <td>{{ $costAllocation->cost_center }}</td>
                                            <td>{{ $costAllocation->cost_category }}</td>
                                            <td>{{ $costAllocation->allocation_method }}</td>
                                            <td>{{ $costAllocation->amount }}</td>
                                            <td>{{ $costAllocation->description }}</td>
                                            <td>
                                                <form action="{{ route('cost_allocations.destroy',$costAllocation->id) }}" method="POST">
                                                    <a class="btn btn-primary btn-sm" href="{{ route('cost_allocations.show',$costAllocation->id) }}">Show</a>
                                                    <a class="btn btn-warning btn-sm" href="{{ route('cost_allocations.edit',$costAllocation->id) }}">Edit</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this item?')">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
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
