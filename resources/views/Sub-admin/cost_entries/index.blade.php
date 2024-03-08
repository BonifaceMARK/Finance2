
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
                            <div class="card-header">Cost Entries</div>

                            <div class="card-body">
                                <a href="{{ route('cost_entries.create') }}" class="btn btn-primary mb-3">Create New Cost Entry</a>

                                @if ($costEntries->count() > 0)
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Cost Center</th>
                                                <th>Cost Category</th>
                                                <th>Amount</th>
                                                <th>Date</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($costEntries as $costEntry)
                                                <tr>
                                                    <td>{{ $costEntry->costCenter->name }}</td>
                                                    <td>{{ $costEntry->costCategory->name }}</td>
                                                    <td>{{ $costEntry->amount }}</td>
                                                    <td>{{ $costEntry->date }}</td>
                                                    <td>
                                                        <a href="{{ route('cost_entries.show', $costEntry->id) }}" class="btn btn-info btn-sm">View</a>
                                                        <a href="{{ route('cost_entries.edit', $costEntry->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                                        <form action="{{ route('cost_entries.destroy', $costEntry->id) }}" method="POST" style="display: inline-block;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this cost entry?')">Delete</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @else
                                    <p>No cost entries found.</p>
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
