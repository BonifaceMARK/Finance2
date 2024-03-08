
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
                        <div class="card-header">Edit Budget Proposal</div>

                        <div class="card-body">
                            <form action="{{ route('budget-proposals.update', $budgetProposal->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label for="budget_plan_id">Budget Plan</label>
                                    <select id="budget_plan_id" name="budget_plan_id" class="form-control" required>
                                        @foreach ($budgetPlans as $plan)
                                            <option value="{{ $plan->id }}" {{ $plan->id == $budgetProposal->budget_plan_id ? 'selected' : '' }}>{{ $plan->title }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" id="title" name="title" class="form-control" value="{{ $budgetProposal->title }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea id="description" name="description" class="form-control" rows="4">{{ $budgetProposal->description }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="amount">Amount</label>
                                    <input type="number" id="amount" name="amount" class="form-control" value="{{ $budgetProposal->amount }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="date">Date</label>
                                    <input type="date" id="date" name="date" class="form-control" value="{{ $budgetProposal->date }}" required>
                                </div>

                                <button type="submit" class="btn btn-primary">Update Budget Proposal</button>
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
