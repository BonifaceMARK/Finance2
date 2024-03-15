
@extends('layout.title')

@section('title', 'Expense Manager')
@include('layout.title')
<body>

  <!-- ======= Header ======= -->
@include('user.header')

  <!-- ======= Sidebar ======= -->
@include('user.sidebar')

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
            <div class="container-fluid">
                <div class="row">
                    <div class="col">
                        <h1>All Request Budgets</h1>
                    </div>
                </div>

                @if(session('success'))
                    <div class="row">
                        <div class="col">
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        </div>
                    </div>
                @endif

                <div class="row">
                    <div class="col">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Amount</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($requestBudgets as $requestBudget)
                                    <tr>
                                        <td>{{ $requestBudget->title }}</td>
                                        <td>{{ $requestBudget->description }}</td>
                                        <td>{{ $requestBudget->amount }}</td>
                                        <td>{{ $requestBudget->start_date }}</td>
                                        <td>{{ $requestBudget->end_date }}</td>
                                        <td>
                                            <a href="{{ route('request_budgets.show', $requestBudget->id) }}" class="btn btn-primary">View</a>
                                            <a href="{{ route('request_budgets.edit', $requestBudget->id) }}" class="btn btn-secondary">Edit</a>
                                            <form action="{{ route('request_budgets.destroy', $requestBudget->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this request budget?')">Delete</button>
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
    </section>

  </main><!-- End #main -->
@include('layout.footer')

</body>

</html>
