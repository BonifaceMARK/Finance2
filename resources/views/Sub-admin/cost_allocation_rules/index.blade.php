
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
                            <div class="card-header">Cost Allocation Rules</div>

                            <div class="card-body">
                                <a href="{{ route('costAllocationRules.create') }}" class="btn btn-primary mb-3">Create New Cost Allocation Rule</a>

                                @if ($costAllocationRules->count() > 0)
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Description</th>
                                                <th>Allocation Method</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($costAllocationRules as $rule)
                                                <tr>
                                                    <td>{{ $rule->name }}</td>
                                                    <td>{{ $rule->description }}</td>
                                                    <td>{{ $rule->allocation_method }}</td>
                                                    <td>
                                                        <a href="{{ route('costAllocationRules.show', $rule->id) }}" class="btn btn-info btn-sm">View</a>
                                                        <a href="{{ route('costAllocationRules.edit', $rule->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                                        <form action="{{ route('costAllocationRules.destroy', $rule->id) }}" method="POST" style="display: inline-block;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this cost allocation rule?')">Delete</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @else
                                    <p>No cost allocation rules found.</p>
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
