
@extends('layout.title')

@section('title', 'Employee Dashboard')
@include('layout.title')
<body>

  <!-- ======= Header ======= -->
@include('layout.header')


  <!-- ======= Sidebar ======= -->
 @include('Employee.sidebar')

  <main id="main" class="main">

    <section class="section dashboard">
      <div class="row">

        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">Budget Plans</div>

                        <div class="card-body">
                            <a href="{{ route('budget-plans.create') }}" class="btn btn-primary mb-3">Create Budget Plan</a>

                            @if ($budgetPlans->isEmpty())
                                <p>No budget plans found.</p>
                            @else
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Title</th>
                                                <th>Total Amount</th>
                                                <th>Start Date</th>
                                                <th>End Date</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($budgetPlans as $budgetPlan)
                                                <tr>
                                                    <td>{{ $budgetPlan->id }}</td>
                                                    <td>{{ $budgetPlan->title }}</td>
                                                    <td>{{ $budgetPlan->total_amount }}</td>
                                                    <td>{{ $budgetPlan->start_date }}</td>
                                                    <td>{{ $budgetPlan->end_date }}</td>
                                                    <td>
                                                        <a href="{{ route('budget-plans.show', $budgetPlan->id) }}" class="btn btn-info btn-sm">View</a>
                                                        <a href="{{ route('budget-plans.edit', $budgetPlan->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                                        <form action="{{ route('budget-plans.destroy', $budgetPlan->id) }}" method="POST" style="display: inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this budget plan?')">Delete</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
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
