
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
                        <div class="card-header">Create Budget Proposal</div>

                        <div class="card-body">
                            <form action="{{ route('budget-proposals.store') }}" method="POST">
                                @csrf

                                <div class="form-group">
                                    <label for="budget_plan_id">Budget Plan</label>
                                    <select id="budget_plan_id" name="budget_plan_id" class="form-control" required>
                                        <option value="">Select Budget Plan</option>
                                        @foreach ($budgetPlans as $budgetPlan)
                                            <option value="{{ $budgetPlan->id }}">{{ $budgetPlan->title }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" id="title" name="title" class="form-control" value="{{ old('title') }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea id="description" name="description" class="form-control" rows="4">{{ old('description') }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="amount">Amount</label>
                                    <input type="number" id="amount" name="amount" class="form-control" value="{{ old('amount') }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="date">Date</label>
                                    <input type="date" id="date" name="date" class="form-control" value="{{ old('date') }}" required>
                                </div>

                                <button type="submit" class="btn btn-primary">Create Budget Proposal</button>
                                <a href="{{ route('budget-proposals.index') }}" class="btn btn-secondary">Cancel</a>
                            </form>
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
