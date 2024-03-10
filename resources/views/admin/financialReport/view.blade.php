
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
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            Cost Allocations
                        </div>
                        <div class="card-body">
                            @if ($message = Session::get('success'))
                                <div class="alert alert-success">
                                    {{ $message }}
                                </div>
                            @endif
                            @if ($costAllocations->count() > 0)
                            <table class="table table-bordered">
                                <tr>
                                    <th>No</th>
                                    <th>Cost Center</th>
                                    <th>Cost Category</th>
                                    <th>Allocation Method</th>
                                    <th>Amount</th>
                                    <th>Description</th>
                                </tr>
                                @foreach ($costAllocations as $key => $costAllocation)
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td>{{ $costAllocation->cost_center }}</td>
                                        <td>{{ $costAllocation->cost_category }}</td>
                                        <td>{{ $costAllocation->allocation_method }}</td>
                                        <td>{{ $costAllocation->amount }}</td>
                                        <td>{{ $costAllocation->description }}</td>
                                    </tr>
                                @endforeach
                            </table>
                            @else
                            <p>No Cost Allocation found.</p>
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

        <div class="card">
            <div class="card-header">
                <h2>Upload Images to Forecast</h2>
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('images.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="image">Choose Image</label>
                        <input type="file" id="image" name="image" class="@error('image') is-invalid @enderror">
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Upload</button>
                </form>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-header">
                <h2>Forecast</h2>
            </div>
            <div class="card-body">
                @if ($images->isEmpty())
                    <p>No images found.</p>
                @else
                    <div class="row">
                        @foreach ($images as $image)
                            <div class="col-md-3 mb-4">
                                <div class="card">
                                    <img src="{{ asset($image->image_path) }}" class="card-img-top" alt="Image">
                                    <div class="card-body">
                                        <p class="card-text">Uploaded: {{ $image->created_at->diffForHumans() }}</p>
                                        <!-- Add delete button here -->
                                        <form action="{{ route('images.destroy', $image->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
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
     document.getElementById('captureScreenshotBtn').addEventListener('click', function() {
        // Trigger a request to capture the screenshot
        fetch('/api/capture-screenshot')
            .then(response => {
                if (response.ok) {
                    // Redirect to the captured screenshot
                    window.location.href = response.url;
                } else {
                    console.error('Failed to capture screenshot:', response.statusText);
                }
            })
            .catch(error => {
                console.error('Failed to capture screenshot:', error);
            });
    });
</script>

</body>

</html>
