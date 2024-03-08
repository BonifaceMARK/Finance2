
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
                            <div class="card-header">Cost Centers</div>

                            <div class="card-body">
                                <a href="{{ route('cost_centers.create') }}" class="btn btn-primary mb-3">Create New Cost Center</a>

                                @if ($costCenters->count() > 0)
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Description</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($costCenters as $costCenter)
                                                <tr>
                                                    <td>{{ $costCenter->name }}</td>
                                                    <td>{{ $costCenter->description }}</td>
                                                    <td>
                                                        <a href="{{ route('cost_centers.show', $costCenter->id) }}" class="btn btn-info btn-sm">View</a>
                                                        <a href="{{ route('cost_centers.edit', $costCenter->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                                        <form action="{{ route('cost_centers.destroy', $costCenter->id) }}" method="POST" style="display: inline-block;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this cost center?')">Delete</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @else
                                    <p>No cost centers found.</p>
                                @endif
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
