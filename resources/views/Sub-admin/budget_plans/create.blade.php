
@extends('layout.title')

@section('title', 'Employee Dashboard')
@include('layout.title')
<body>

  <!-- ======= Header ======= -->
@include('sub-admin.header')


  <!-- ======= Sidebar ======= -->
 @include('sub-admin.sidebar')

  <main id="main" class="main">

    <section class="section dashboard">
      <div class="row">

        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">Create Budget Plan</div>

                        <div class="card-body">
                            <form action="{{ route('budget-plans.store') }}" method="POST">
                                @csrf

                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <select id="title" name="title" class="form-control" required onchange="showDescription()">
                                        <option value="">Select Title</option>
                                        <option value="Incremental Budgeting">Incremental Budgeting</option>
                                        <option value="Zero-Based Budgeting (ZBB)">Zero-Based Budgeting (ZBB)</option>
                                        <option value="Flexible Budgeting">Flexible Budgeting</option>
                                        <option value="Activity-Based Budgeting">Activity-Based Budgeting</option>
                                        <option value="Cash Budgeting">Cash Budgeting</option>
                                    </select>
                                </div>


                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea id="descriptionTextarea" name="description" class="form-control" rows="4"></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="total_amount">Total Amount</label>
                                    <input type="number" id="total_amount" name="total_amount" class="form-control" value="{{ old('total_amount') }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="start_date">Start Date</label>
                                    <input type="date" id="start_date" name="start_date" class="form-control" value="{{ old('start_date') }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="end_date">End Date</label>
                                    <input type="date" id="end_date" name="end_date" class="form-control" value="{{ old('end_date') }}" required>
                                </div>

                                <button type="submit" class="btn btn-primary">Create Budget Plan</button>
                                <a href="{{ route('budget-plans.index') }}" class="btn btn-secondary">Cancel</a>
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
<script>
    function showDescription() {
        var titleSelect = document.getElementById("title");
        var descriptionTextarea = document.getElementById("descriptionTextarea");
        var selectedOption = titleSelect.options[titleSelect.selectedIndex].value;
        var description = "";

        switch (selectedOption) {
            case "Incremental Budgeting":
                description = "Incremental budgeting involves making adjustments to the previous period's budget based on changes in economic conditions, inflation rates, and other factors. Changes are typically incremental rather than radical.";
                break;
            case "Zero-Based Budgeting (ZBB)":
                description = "Zero-based budgeting requires departments to justify all expenses from scratch, starting from zero. Every expense must be justified regardless of whether it was included in the previous budget.";
                break;
            case "Flexible Budgeting":
                description = "Flexible budgeting adjusts the budget based on changes in activity levels or other variables. It allows for more flexibility in resource allocation compared to traditional fixed budgets.";
                break;
            case "Activity-Based Budgeting":
                description = "Activity-based budgeting allocates resources based on the anticipated level of activity or workload in each department or area of the organization.";
                break;
            case "Cash Budgeting":
                description = "Cash budgeting focuses on managing cash flow by forecasting cash inflows and outflows over a specific period. It helps ensure that the organization has sufficient liquidity to meet its financial obligations.";
                break;
            default:
                description = "";
        }

        descriptionTextarea.value = description;
    }
    </script>
</body>

</html>
