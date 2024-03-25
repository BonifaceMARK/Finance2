
@extends('layout.title')

@section('title', 'Expense')
@include('layout.title')
<body>

  <!-- ======= Header ======= -->

  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="index.html" class="logo d-flex align-items-center">
        <img src="{{ asset('assets/img/fmslogo.png')}}" alt="">
        <span class="d-none d-lg-block">Financial Guardians</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->



    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item d-block d-lg-none">
          <a class="nav-link nav-icon search-bar-toggle " href="#">
            <i class="bi bi-search"></i>
          </a>
        </li><!-- End Search Icon-->

        <li class="nav-item dropdown">

     <!-- Notifications Nav -->
<li class="nav-item dropdown">
    <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
        <i class="bi bi-bell"></i>
        @if ($totalNotifications > 0)
            <span class="badge bg-primary badge-number">{{ $totalNotifications }}</span>
        @endif
    </a>
    <!-- Notification Dropdown Items -->
    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
        <li class="dropdown-header">
            @if ($totalNotifications > 0)
                You have {{ $totalNotifications }} new notifications
            @else
                No new notifications
            @endif
        </li>
        <li><hr class="dropdown-divider"></li>
        <!-- Notification Items -->
        <div class="notification-scroll">
            <!-- Notification Items for Expenses -->
            @foreach ($expenses as $expense)
                <li class="notification-item">
                    <i class="bi bi-exclamation-circle text-warning"></i>
                    <div>
                        <h4>{{ $expense->title }}</h4>
                        <p>{{ $expense->description }}</p>
                        <p>{{ $expense->created_at->diffForHumans() }}</p>
                    </div>
                </li>
                <li><hr class="dropdown-divider"></li>
            @endforeach
            <!-- End of Notification Items for Expenses -->

            <!-- Notification Items for RequestBudget -->
            @foreach ($requestBudgets as $requestBudget)
                <li class="notification-item">
                    <i class="bi bi-exclamation-circle text-warning"></i>
                    <div>
                        <h4>{{ $requestBudget->title }}</h4>
                        <p>{{ $requestBudget->description }}</p>
                        <p>{{ $requestBudget->created_at->diffForHumans() }}</p>
                    </div>
                </li>
                <li><hr class="dropdown-divider"></li>
            @endforeach
            <!-- End of Notification Items for RequestBudget -->

            <!-- Notification Items for CostAllocation -->
            @foreach ($costAllocations as $costAllocation)
                <li class="notification-item">
                    <i class="bi bi-exclamation-circle text-warning"></i>
                    <div>
                        <h4>{{ $costAllocation->cost_center }}</h4>
                        <p>{{ $costAllocation->description }}</p>
                        <p>{{ $costAllocation->created_at->diffForHumans() }}</p>
                    </div>
                </li>
                <li><hr class="dropdown-divider"></li>
            @endforeach
            <!-- End of Notification Items for CostAllocation -->
        </div>
        <li class="dropdown-footer">
        </li>
    </ul>
    <!-- End Notification Dropdown Items -->
</li>
<!-- End Notifications Nav -->


          <li class="nav-item dropdown">


          </li><!-- End Messages Nav -->



        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="{{asset('assets/img/admin.png')}}" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2">{{ auth()->user()->name }}</span>

          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6> {{ auth()->user()->email }} </h6>
              <span>{{ auth()->user()->department }}</span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="{{route('profile.show')}}">
                <i class="bi bi-person"></i>
                <span>My Profile</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="{{route('faqs')}}">
                <i class="bi bi-question-circle"></i>
                <span>Need Help?</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="/logout">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out</span>
              </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->

        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
@include('user.sidebar')

  <main id="main" class="main">

    <div class="pagetitle">
      <h1><i class="bi bi-cash-stack"></i> Expenses</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="#">Expenses</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">



         <!-- Expenses Card -->
<div class="col-xxl-4 col-md-6">
    <div class="card info-card sales-card">
        <div class="card-body">
            <h5 class="card-title">Expenses <span>| Today</span></h5>

            <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-cart"></i>
                </div>
                <div class="ps-3">
                    <h6>{{ $totalExpensesToday }}</h6>
                    <span class="text-{{ $expensesPercentageChange >= 0 ? 'danger' : 'success' }} small pt-1 fw-bold">{{ number_format($expensesPercentageChange, 2) }}%</span>
                    <span class="text-muted small pt-2 ps-1">{{ $expensesPercentageChange >= 0 ? 'increase' : 'decrease' }}</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Expenses Card -->

<!-- Revenue Card -->
<div class="col-xxl-4 col-md-6">
    <div class="card info-card revenue-card">

        <div class="filter">
            <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                <li class="dropdown-header text-start">
                    <h6>Filter</h6>
                </li>

                <li><a class="dropdown-item" href="#">Today</a></li>
                <li><a class="dropdown-item" href="#">This Month</a></li>
                <li><a class="dropdown-item" href="#">This Year</a></li>
            </ul>
        </div>

        <div class="card-body">
            <h5 class="card-title">Expenses <span>| This Month</span></h5>

            <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-currency-dollar"></i>
                </div>
                <div class="ps-3">
                    <h6>${{ number_format($totalExpensesThisMonth, 2) }}</h6>
                    <span class="text-success small pt-1 fw-bold">{{ $expensesPercentageChange }}%</span>
                    <span class="text-muted small pt-2 ps-1">{{ $expensesPercentageChange > 0 ? 'increase' : 'decrease' }}</span>
                </div>
            </div>
        </div>

    </div>
</div><!-- End Revenue Card -->
<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title"><i class="bi bi-pie-chart-fill"></i> Expense Category</h5>

            <!-- Pie Chart -->
            <div id="pieChart"></div>

            <!-- Script for fetching data and updating chart -->
            <script>
                document.addEventListener("DOMContentLoaded", () => {
                    // Fetch data from the server
                    fetch('/user/fetch-expense-data')
                        .then(response => response.json())
                        .then(data => updateChart(data));
                });

                function updateChart(data) {
                    new ApexCharts(document.querySelector("#pieChart"), {
                        series: data.series,
                        chart: {
                            height: 350,
                            type: 'pie',
                            toolbar: {
                                show: true
                            }
                        },
                        labels: data.labels
                    }).render();
                }
            </script>
            <!-- End Pie Chart -->

        </div>
    </div>
</div>
        <div class="container">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header"><i class="bi bi-file-earmark-plus"></i> Create Expense</div>

                            <div class="card-body">
                                @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif
                                @if (session('success'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('success') }}
                                </div>
                            @endif

                                <form action="{{ route('expenses.store') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="date">Date:</label>
                                        <input type="date" id="date" name="date" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="amount">Amount:</label>
                                        <input type="number" id="amount" name="amount" class="form-control" step="0.01">
                                    </div>
                                    <div class="form-group">
                                        <label for="category">Category:</label>
                                        <select id="category" name="category" class="form-control">
                                            <option value="">Choose Category</option>
                                            <option value="Salaries and Wages">Salaries and Wages</option>
                                            <option value="Rent or Lease">Rent or Lease</option>
                                            <option value="Utilities">Utilities</option>
                                            <option value="Supplies">Supplies</option>
                                            <option value="Inventory">Inventory</option>
                                            <option value="Marketing and Advertising">Marketing and Advertising</option>
                                            <option value="Travel and Entertainment">Travel and Entertainment</option>
                                            <option value="Professional Services">Professional Services</option>
                                            <option value="Insurance">Insurance</option>
                                            <option value="Maintenance and Repairs">Maintenance and Repairs</option>
                                            <option value="Taxes and Licenses">Taxes and Licenses</option>
                                            <option value="Depreciation">Depreciation</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Description:</label>
                                        <textarea id="description" name="description" class="form-control" rows="3"></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary"><i class="bi bi-send"></i> Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">Expenses</div>

                            <div class="card-body">


                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th style="background-color: #87CEEB;">Date</th>
                                            <th style="background-color: #87CEEB;">Amount</th>
                                            <th style="background-color: #87CEEB;">Category</th>
                                            <th style="background-color: #87CEEB;">Description</th>
                                            <th style="background-color: #87CEEB;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($expenses as $expense)
                                            <tr>
                                                <td>{{ $expense->created_at }}</td>
                                                <td>{{ $expense->amount }}</td>
                                                <td>{{ $expense->category }}</td>
                                                <td>{{ $expense->description }}</td>
                                                <td>
                                                    <a href="{{ route('expenses.show', $expense) }}" class="btn btn-sm btn-primary"><i class="bi bi-printer"></i>Print</a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5">No expenses found.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
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
    // Define an object with descriptions for each category
    const categoryDescriptions = {
        "Salaries and Wages": "Expenses related to employee compensation, including salaries, wages, bonuses, and benefits.",
        "Rent or Lease": " Expenses for renting or leasing office space, equipment, or other assets.",
        "Utilities": "Expenses for essential services such as electricity, Expenses for office supplies, equipment, or other materials, heating, and internet.",
        "Supplies": "Expenses for office supplies, stationery, and other consumable items needed for day-to-day operations.",
        "Inventory": " Expenses related to purchasing or producing goods for sale, including raw materials, components, and finished products.",
        "Marketing and Advertising": "Expenses for promoting the organization's products or services, including advertising campaigns, marketing materials, and promotional events.",
        "Travel and Entertainment": "Expenses for business travel, accommodations, meals, and entertainment related to business activities.",
        "Professional Services": "Expenses for hiring external professionals such as consultants, legal advisors, accountants, and other service providers.",
        "Insurance": "Expenses for insurance premiums to protect the organization against various risks, such as property damage, liability claims, and employee injuries.",
        "Maintenance and Repairs": " Expenses for maintaining and repairing equipment, vehicles, buildings, or other assets.",
        "Taxes and Licenses": " Expenses for various taxes, licenses, permits, and regulatory fees required for operating the business legally.",
        "Depreciation": "Expenses representing the gradual loss of value of assets over time, typically for fixed assets such as buildings, machinery, and equipment."
    };

    // Get the category and description elements
    const categorySelect = document.getElementById("category");
    const descriptionTextarea = document.getElementById("description");

    // Add event listener to category select
    categorySelect.addEventListener("change", function() {
        // Get the selected category
        const selectedCategory = this.value;

        // Update the description textarea with the corresponding description
        descriptionTextarea.value = categoryDescriptions[selectedCategory] || "";
    });
</script>
</body>

</html>
