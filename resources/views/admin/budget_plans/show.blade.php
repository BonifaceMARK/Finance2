
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
                        <div class="card-header">Budget Plan Details</div>

                        <div class="card-body">
                            <p><strong>Title:</strong> {{ $budgetPlan->title }}</p>
                            <p><strong>Description:</strong> {{ $budgetPlan->description ?: 'N/A' }}</p>
                            <p><strong>Total Amount:</strong> ${{ $budgetPlan->total_amount }}</p>
                            <p><strong>Start Date:</strong> {{ $budgetPlan->start_date->format('Y-m-d') }}</p>
                            <p><strong>End Date:</strong> {{ $budgetPlan->end_date->format('Y-m-d') }}</p>

                            <a href="{{ route('budget-plans.edit', $budgetPlan->id) }}" class="btn btn-primary">Edit</a>

                            <form action="{{ route('budget-plans.destroy', $budgetPlan->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this budget plan?')">Delete</button>
                            </form>

                            <a href="{{ route('budget-plans.index') }}" class="btn btn-secondary">Back</a>
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
