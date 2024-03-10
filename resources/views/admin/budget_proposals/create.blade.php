
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
                                    <select id="title" name="title" class="form-control" required onchange="showDescription()">
                                        <option value="">Select Title</option>
                                        <option value="Operating Budget Proposal">Operating Budget Proposal</option>
                                        <option value="Capital Budget Proposal">Capital Budget Proposal</option>
                                        <option value="Expense Reduction Proposal">Expense Reduction Proposal</option>
                                        <option value="Revenue Enhancement Proposal">Revenue Enhancement Proposal</option>
                                        <option value="Departmental Budget Proposal">Departmental Budget Proposal</option>
                                        <option value="Project Budget Proposal">Project Budget Proposal</option>
                                        <option value="Research and Development Budget Proposal">Research and Development Budget Proposal</option>
                                        <option value="Strategic Investment Proposal">Strategic Investment Proposal</option>
                                        <option value="Contingency Budget Proposal">Contingency Budget Proposal</option>
                                        <option value="Sustainability Budget Proposal">Sustainability Budget Proposal</option>
                                    </select>
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
<script>
    function showDescription() {
        var titleSelect = document.getElementById("title");
        var descriptionTextarea = document.getElementById("description");
        var selectedOption = titleSelect.options[titleSelect.selectedIndex].value;
        var description = "";

        switch (selectedOption) {
            case "Operating Budget Proposal":
                description = "This type of proposal outlines the projected expenses and revenues for the day-to-day operations of an organization.";
                break;
            case "Capital Budget Proposal":
                description = "This proposal focuses on investments in long-term assets such as equipment, infrastructure, or facilities.";
                break;
            case "Expense Reduction Proposal":
                description = "This proposal aims to identify areas where costs can be reduced or eliminated to improve the organization's financial health.";
                break;
            case "Revenue Enhancement Proposal":
                description = "This proposal suggests strategies for increasing revenue streams through methods such as new product lines, expanded services, or marketing initiatives.";
                break;
            case "Departmental Budget Proposal":
                description = "Each department within an organization may submit its own budget proposal outlining its resource needs and objectives for the upcoming period.";
                break;
            case "Project Budget Proposal":
                description = " For specific projects or initiatives, a budget proposal may be developed to outline the financial requirements and expected outcomes.";
                break;
            case "Research and Development Budget Proposal":
                description = "If the organization invests in research and development activities, a budget proposal may be developed specifically for these purposes.";
                break;
            case "Strategic Investment Proposal":
                description = " This proposal outlines investments in initiatives aligned with the organization's long-term strategic goals.";
                break;
            case "Contingency Budget Proposal":
                description = "In uncertain times or when facing potential risks, a contingency budget proposal may be developed to allocate resources for unforeseen events or emergencies.";
                break;
            case "Sustainability Budget Proposal":
                description = " This proposal focuses on allocating resources towards sustainability initiatives, such as energy efficiency projects or waste reduction programs.";
                break;
            default:
                description = "";
        }

        descriptionTextarea.value = description;
    }
</script>

</body>

</html>
