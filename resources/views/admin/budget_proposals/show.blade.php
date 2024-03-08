
@extends('layout.title')

@section('title', 'Employee Dashboard')
@include('layout.title')
<body>

  <!-- ======= Header ======= -->
@include('admin.header')


  <!-- ======= Sidebar ======= -->
 @include('admin.sidebar')

  <main id="main" class="main">

    <section class="section dashboard">
      <div class="row">

        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">Budget Proposal Details</div>

                        <div class="card-body">
                            <p><strong>Title:</strong> {{ $budgetProposal->title }}</p>
                            <p><strong>Description:</strong> {{ $budgetProposal->description ?: 'N/A' }}</p>
                            <p><strong>Amount:</strong> ${{ $budgetProposal->amount }}</p>
                            <p><strong>Date:</strong> {{ $budgetProposal->date }}</p>
                            <p><strong>Budget Plan:</strong> {{ $budgetProposal->budgetPlan->title }}</p>

                            <a href="{{ route('budget-proposals.edit', $budgetProposal->id) }}" class="btn btn-primary">Edit</a>

                            <form action="{{ route('budget-proposals.destroy', $budgetProposal->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this budget proposal?')">Delete</button>
                            </form>

                            <a href="{{ route('budget-proposals.index') }}" class="btn btn-secondary">Back</a>
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
