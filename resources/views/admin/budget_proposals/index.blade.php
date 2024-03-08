
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
                        <div class="card-header">Budget Proposals</div>

                        <div class="card-body">
                            <a href="{{ route('budget-proposals.create') }}" class="btn btn-primary mb-3">Create Budget Proposal</a>

                            @if ($budgetProposals->isEmpty())
                                <p>No budget proposals found.</p>
                            @else
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Title</th>
                                                <th>Budget Plan</th>
                                                <th>Amount</th>
                                                <th>Date</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($budgetProposals as $budgetProposal)
                                                <tr>
                                                    <td>{{ $budgetProposal->id }}</td>
                                                    <td>{{ $budgetProposal->title }}</td>
                                                    <td>{{ $budgetProposal->budgetPlan->title }}</td>
                                                    <td>{{ $budgetProposal->amount }}</td>
                                                    <td>{{ $budgetProposal->date }}</td>
                                                    <td>
                                                        <a href="{{ route('budget-proposals.show', $budgetProposal->id) }}" class="btn btn-info btn-sm">View</a>
                                                        <a href="{{ route('budget-proposals.edit', $budgetProposal->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                                        <form action="{{ route('budget-proposals.destroy', $budgetProposal->id) }}" method="POST" style="display: inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this budget proposal?')">Delete</button>
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
