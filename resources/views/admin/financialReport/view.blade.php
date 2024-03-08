
@extends('layout.title')

@section('title', 'Employee Dashboard')
@include('layout.title')
<body>

  <!-- ======= Header ======= -->
@include('admin.header')


  <!-- ======= Sidebar ======= -->
 @include('admin.sidebar')

  <main id="main" class="main">

    <section  class="section dashboard">
      <div id="print-container" class="flex-grow">
        <div class="container" >

            <div class="row justify-content-between mb-3">
                <div class="col-md-12">
                    <h2 class="text-center">Financial Report</h2>
                </div>
            </div>

            <div class="row justify-content-between">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">Budget Plans</div>

                        <div class="card-body">

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

        <div class="container">
            <div class="row justify-content-between">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">Budget Proposals</div>

                        <div class="card-body">

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

        <div  class="container">
            <div class="row justify-content-between">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">Cost Allocation Rules</div>

                        <div  id="print-container" class="card-body">

                            @if ($costAllocationRules->count() > 0)
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Description</th>
                                            <th>Allocation Method</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($costAllocationRules as $rule)
                                            <tr>
                                                <td>{{ $rule->name }}</td>
                                                <td>{{ $rule->description }}</td>
                                                <td>{{ $rule->allocation_method }}</td>

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
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">Cost Allocations</div>

                        <div class="card-body">

                            @if ($costAllocations->count() > 0)
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Source Cost Center</th>
                                            <th>Destination Cost Center</th>
                                            <th>Cost Category</th>
                                            <th>Amount</th>
                                            <th>Date</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($costAllocations as $costAllocation)
                                            <tr>
                                                <td>{{ $costAllocation->sourceCostCenter->name }}</td>
                                                <td>{{ $costAllocation->destinationCostCenter->name }}</td>
                                                <td>{{ $costAllocation->costCategory->name }}</td>
                                                <td>{{ $costAllocation->amount }}</td>
                                                <td>{{ $costAllocation->date }}</td>

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <p>No cost allocations found.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">Cost Categories</div>

                        <div class="card-body">

                            @if ($costCategories->count() > 0)
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Description</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($costCategories as $costCategory)
                                            <tr>
                                                <td>{{ $costCategory->name }}</td>
                                                <td>{{ $costCategory->description }}</td>

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <p>No cost categories found.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">Cost Centers</div>

                        <div class="card-body">

                            @if ($costCenters->count() > 0)
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Description</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($costCenters as $costCenter)
                                            <tr>
                                                <td>{{ $costCenter->name }}</td>
                                                <td>{{ $costCenter->description }}</td>

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <p>No cost centers found.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row justify-content-between">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">Cost Entries</div>

                        <div class="card-body">

                            @if ($costEntries->count() > 0)
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Cost Center</th>
                                            <th>Cost Category</th>
                                            <th>Amount</th>
                                            <th>Date</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($costEntries as $costEntry)
                                            <tr>
                                                <td>{{ $costEntry->costCenter->name }}</td>
                                                <td>{{ $costEntry->costCategory->name }}</td>
                                                <td>{{ $costEntry->amount }}</td>
                                                <td>{{ $costEntry->date }}</td>

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
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            Expense Categories
                               </div>
                        <div class="card-body">
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                            @if ($expenseCategories->count() > 0)
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Name</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($expenseCategories as $expenseCategory)
                                        <tr>
                                            <td>{{ $expenseCategory->id }}</td>
                                            <td>{{ $expenseCategory->name }}</td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @else
                            <p>No expense categories found.</p>
                        @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">Expenses</div>

                        <div class="card-body">
                            @if ($expenses->count() > 0)
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Category</th>
                                        <th>Amount</th>
                                        <th>Date</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($expenses as $expense)
                                        <tr>
                                            <td>{{ $expense->id }}</td>
                                            <td>{{ $expense->category_id }}</td>
                                            <td>{{ $expense->amount }}</td>
                                            <td>{{ $expense->expense_date }}</td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @else
                            <p>No expenses found.</p>
                        @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Reports</div>

                        <div class="card-body">
                            @if (session('success'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('success') }}
                                </div>
                            @endif
                            @if ($reports->count() > 0)
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Category</th>
                                        <th>Expense</th>
                                        <th>Date</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($reports as $report)
                                        <tr>
                                            <td>{{ $report->category }}</td>
                                            <td>{{ $report->expense }}</td>
                                            <td>{{ $report->date }}</td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @else
                            <p>No reports found.</p>
                        @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-between mt-3">
            <!-- Print button -->
            <div class="col-md-2">
                <button class="btn btn-primary" onclick="printDiv()">Print</button>
            </div>
        </div>

      </div>
    </section>

  </main><!-- End #main -->
@include('layout.footer')

<script>
    function printDiv() {
        var printContents = document.getElementById('print-container').innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }
</script>
</body>

</html>
