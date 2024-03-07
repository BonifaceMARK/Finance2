
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
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Reports</div>

                        <div class="card-body">
                            @if (session('success'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('success') }}
                                </div>
                            @endif

                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Category</th>
                                        <th>Expense</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($reports as $report)
                                        <tr>
                                            <td>{{ $report->category }}</td>
                                            <td>{{ $report->expense }}</td>
                                            <td>{{ $report->date }}</td>
                                            <td>
                                                <a href="{{ route('reports.show', $report->id) }}" class="btn btn-primary btn-sm">View</a>
                                                <a href="{{ route('reports.edit', $report->id) }}" class="btn btn-secondary btn-sm">Edit</a>
                                                <form action="{{ route('reports.destroy', $report->id) }}" method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this report?')">Delete</button>
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
