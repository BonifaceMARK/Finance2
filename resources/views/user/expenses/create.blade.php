
@extends('layout.title')

@section('title', 'Expense Manager')
@include('layout.title')
<body>

  <!-- ======= Header ======= -->
@include('user.header')

  <!-- ======= Sidebar ======= -->
@include('user.sidebar')

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="#">Expense</a></li>
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
<div class="col-lg-6">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Pie Chart</h5>

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

<div class="col-lg-6">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Line Chart with Future Predictions</h5>

            <!-- Line Chart -->
            <div id="lineChart"></div>

            <!-- Script for fetching data and updating chart -->
            <script>
                document.addEventListener("DOMContentLoaded", () => {
                    // Fetch data from the server
                    fetch('/user/fetch-expense-chart-data')
                        .then(response => response.json())
                        .then(data => {
                            // Perform exponential smoothing to predict future values
                            const smoothedData = exponentialSmoothing(data, 0.3, 6); // You can adjust the smoothing factor and forecast horizon

                            // Merge historical and predicted data
                            const combinedData = [...data, ...smoothedData];

                            // Render the chart
                            new ApexCharts(document.querySelector("#lineChart"), {
                                series: [{
                                    name: "Expenses",
                                    data: combinedData
                                }],
                                chart: {
                                    height: 350,
                                    type: 'line',
                                    zoom: {
                                        enabled: false
                                    }
                                },
                                dataLabels: {
                                    enabled: false
                                },
                                stroke: {
                                    curve: 'smooth'
                                },
                                grid: {
                                    row: {
                                        colors: ['#f3f3f3', 'transparent'],
                                        opacity: 0.5
                                    },
                                },
                                xaxis: {
                                    categories: Array.from({ length: combinedData.length }, (_, i) => i + 1)
                                }
                            }).render();
                        });
                });

                // Function to perform exponential smoothing
                function exponentialSmoothing(data, alpha, horizon) {
                    const smoothedData = [];
                    let prevSmoothedValue = data[0];

                    for (let i = 0; i < data.length + horizon; i++) {
                        if (i < data.length) {
                            smoothedData.push(data[i]);
                        } else {
                            const smoothedValue = alpha * data[i - 1] + (1 - alpha) * prevSmoothedValue;
                            smoothedData.push(smoothedValue);
                            prevSmoothedValue = smoothedValue;
                        }
                    }

                    return smoothedData;
                }
            </script>
            <!-- End Line Chart -->

        </div>
    </div>
</div>



        <div class="container">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">Create Expense</div>

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
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">Expenses</div>

                            <div class="card-body">


                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Amount</th>
                                            <th>Category</th>
                                            <th>Description</th>
                                            <th>Action</th>
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
