@extends('layout.title')

@section('title', 'Expense Manager')

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
                    <a class="dropdown-item d-flex align-items-center btn btn-primary btn-notification" data-bs-toggle="modal" data-bs-target="#recentActivityModal">
                            <i class="bi bi-bell-fill"></i> View Recent Activity
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
            <h1 class="d-flex justify-content-between align-items-center">
                <i class="bi bi-cash-stack"> Expenses</i>
                <div class="d-flex">
                    <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#expenseModal">
                        Add Expense
                    </button>
                    <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#expensesPredictionsModal">Expenses Predictions</button>
                </div>
            </h1>
        </div>

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Expenses</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                </ol>
            </nav>
            @if(Session::has('success'))
            <div class="alert alert-success" role="alert">
                {{ Session::get('success') }}
            </div>
            @endif
            @if ($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                {{ $error }}
                @endforeach
            </div>
            @endif
        </div><!-- End Page Header -->


        <section class="section dashboard">
            <div class="row">
                <div class="col-md-6">
                    <div class="card info-card sales-card">
                        <div class="card-body">
                            <h5 class="card-title">Expenses | Today</h5>

                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-cart"></i>
                                </div>
                                <div class="ps-3">
                                    <h6>{{ $totalExpensesToday }}</h6>
                                    <span
                                        class="{{ $expensesPercentageChange >= 0 ? 'danger' : 'success' }} text-small pt-1 fw-bold">{{ number_format($expensesPercentageChange, 2) }}%</span>
                                    <span class="text-muted small pt-2 ps-1">{{ $expensesPercentageChange >= 0 ? 'increase' : 'decrease' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card info-card revenue-card">
                        <div class="card-body">
                            <h5 class="card-title">Expenses | This Month</h5>
                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-currency-dollar"></i>
                                </div>
                                <div class="ps-3">
                                    <h6>${{ number_format($totalExpensesThisMonth, 2) }}</h6>
                                    <span
                                        class="text-success small pt-1 fw-bold">{{ $expensesPercentageChange }}%</span>
                                    <span
                                        class="text-muted small pt-2 ps-1">{{ $expensesPercentageChange > 0 ? 'increase' : 'decrease' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="expenseModal" tabindex="-1" role="dialog"
                aria-labelledby="expenseModal" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="expenseModal">Create Expense</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Expense creation form -->
                            <form action="{{ route('expenses.store') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="item">Item:</label>
                                    <input type="text" id="item" name="item" class="form-control"
                                        value="{{ old('item') }}" required>
                                    @error('item')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="date">Date:</label>
                                    <input type="date" id="date" name="date" class="form-control"
                                        value="{{ old('date') }}" required>
                                    @error('date')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="amount">Amount:</label>
                                    <input type="number" id="amount" name="amount" class="form-control"
                                        value="{{ old('amount') }}" step="0.01" required>
                                    @error('amount')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="category">Category:</label>
                                    <select id="category" name="category" class="form-control" required>
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
                                    @error('category')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="description">Description:</label>
                                    <textarea id="description" name="description" class="form-control"
                                        rows="3">{{ old('description') }}</textarea>
                                    @error('description')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary"><i class="bi bi-send"></i>
                                    Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>






            </div>


            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><i class="bi bi-pie-chart-fill"></i> Expenses Analytics     <!-- Button to trigger modal -->
                             </h5>

                        <!-- Pie Chart -->
                        <div id="pieChart"></div>
     <!-- End Pie Chart -->
     <div id="charot"></div>
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


                        <script>
                            // Data for expenses
                            const categories = ['Salaries', 'Rent or Lease', 'Utilities', 'Supplies', 'Inventory', 'Marketing and Advertising', 'Travel and Entertainment', 'Professional Services', 'Insurance', 'Maintenance and Repairs', 'Taxes and Licenses', 'Depreciation'];
                            const expenses = [
                                {!! $salariesExpenses !!},
                                {!! $rentLeaseExpenses !!},
                                {!! $utilitiesExpenses !!},
                                {!! $suppliesExpenses !!},
                                {!! $inventoryExpenses !!},
                                {!! $marketingExpenses !!},
                                {!! $travelExpenses !!},
                                {!! $professionalServicesExpenses !!},
                                {!! $insuranceExpenses !!},
                                {!! $maintenanceExpenses !!},
                                {!! $taxesExpenses !!},
                                {!! $depreciationExpenses !!}
                            ];

                            // Generate series data for each category
                            const seriesData = categories.map((category, index) => {
                                return {
                                    name: category,
                                    data: expenses[index].map(expense => ({
                                        x: new Date(expense.date),  // Assuming date is the x-axis data
                                        y: parseFloat(expense.amount) // Assuming amount is the y-axis data
                                    }))
                                }
                            });

                            // Create chart
                            const options = {
                                chart: {
                                    type: 'area',
                                    height: 350
                                },
                                series: seriesData,
                                xaxis: {
                                    type: 'datetime' // Assuming date is in datetime format
                                }
                            };

                            const charot = new ApexCharts(document.querySelector("#charot"), options);
                            charot.render();
                        </script>
                    </div>
                </div>
            </div>



        </section>
    </main><!-- End #main -->
 <!-- Modal -->
 <div class="modal fade" id="expensesPredictionsModal" tabindex="-1" aria-labelledby="expensesPredictionsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="expensesPredictionsModalLabel"><i class="bi bi-graph-up"></i> Expenses Predictions</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <!-- Bordered Tabs Justified -->
          <ul class="nav nav-tabs nav-tabs-bordered d-flex" id="borderedTabJustified" role="tablist">
            <li class="nav-item flex-fill" role="presentation">
              <button class="nav-link w-100 active" id="home-tab" data-bs-toggle="tab" data-bs-target="#bordered-justified-home" type="button" role="tab" aria-controls="home" aria-selected="true"> Exponential Smoothing</button>
            </li>
            <li class="nav-item flex-fill" role="presentation">
              <button class="nav-link w-100" id="profile-tab" data-bs-toggle="tab" data-bs-target="#bordered-justified-profile" type="button" role="tab" aria-controls="profile" aria-selected="false"> Moving Average</button>
            </li>
           <!--   <li class="nav-item flex-fill" role="presentation">
                <button class="nav-link w-100" id="contact" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="profile" aria-selected="false">Linear Regression</button>
              </li> -->
          </ul>
          <div class="tab-content pt-2" id="borderedTabJustifiedContent">
            <div class="tab-pane fade show active" id="bordered-justified-home" role="tabpanel" aria-labelledby="home-tab">
              <!-- Exponential Smoothing Content -->
              <div class="col-lg-12">
                <div class="card">
                  <div class="card-body">
                    <h5 class="card-title">Exponential Smoothing</h5>
                    <!-- Line Chart -->
                    <div id="expChart"></div>
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
                            new ApexCharts(document.querySelector("#expChart"), {
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
                                categories: Array.from({
                                  length: combinedData.length
                                }, (_, i) => i + 1)
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
            </div>
            <div class="tab-pane fade" id="bordered-justified-profile" role="tabpanel" aria-labelledby="profile-tab">
              <!-- Moving Average Content -->
              <div class="col-lg-12">
                <div class="card">
                  <div class="card-body">
                    <h5 class="card-title">Moving Average</h5>
                    <!-- Line Chart -->
                    <div id="movChart"></div>
                    <!-- Script for fetching data and updating chart -->
                    <script>
                      document.addEventListener("DOMContentLoaded", () => {
                        // Fetch data from the server
                        fetch('/user/fetch-expense-chart-with-moving-average')
                          .then(response => response.json())
                          .then(data => {
                            // Calculate moving averages
                            const movingAverages = calculateMovingAverages(data, 3); // Change the window size as needed
                            // Extend data with moving average values
                            const extendedData = [...data, ...movingAverages];
                            new ApexCharts(document.querySelector("#movChart"), {
                              series: [{
                                name: "Expenses",
                                data: extendedData
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
                                categories: Array.from({
                                  length: data.length + movingAverages.length
                                }, (_, i) => i + 1)
                              }
                            }).render();
                          });
                      });
                      // Function to calculate moving averages
                      function calculateMovingAverages(data, windowSize) {
                        const movingAverages = [];
                        for (let i = 0; i < data.length - windowSize + 1; i++) {
                          let sum = 0;
                          for (let j = i; j < i + windowSize; j++) {
                            sum += data[j];
                          }
                          movingAverages.push(sum / windowSize);
                        }
                        return movingAverages;
                      }
                    </script>
                    <!-- End Line Chart -->
                  </div>
                </div>
              </div>
            </div>
            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="profile-tab">
                <div class="col-lg-12">
                    <div class="card">
                      <div class="card-body">
                        <h5 class="card-title">Linear Regression</h5>

<!-- Area Chart -->
<div id="areaChart"></div>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        // Fetched expense data from the controller
        const expenses = @json($expenses);

        // Extract dates and amounts from expense data
        const dates = expenses.map(expense => expense.date);
        const amounts = expenses.map(expense => expense.amount);

        new ApexCharts(document.querySelector("#areaChart"), {
            series: [{
                name: "Expenses",
                data: amounts
            }],
            chart: {
                type: 'area',
                height: 350,
                zoom: {
                    enabled: false
                }
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'straight'
            },
            subtitle: {
                text: 'Expense Amounts Over Time',
                align: 'left'
            },
            labels: dates,
            xaxis: {
                type: 'datetime'
            },
            yaxis: {
                opposite: true
            },
            legend: {
                horizontalAlign: 'left'
            }
        }).render();
    });
</script>
<!-- End Area Chart -->

</div>
</div>
</div>
          </div>
        </div>
        </div><!-- End Bordered Tabs Justified -->
      </div>
    </div>
  </div>
    @include('layout.footer')
</body>

</html>
