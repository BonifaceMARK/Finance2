
@extends('layout.title')

@section('title','Home')
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
        <div class="d-flex justify-content-between align-items-center">
            <h1 class="mb-0"><i class="bi bi-house-door"></i> Home</h1>
            <div class="d-flex">
                <button type="button" class="btn btn-outline-primary me-2" data-bs-toggle="modal" data-bs-target="#newsModal">News & Updates</button>
                <button type="button" class="btn btn-outline-primary me-2" data-bs-toggle="modal" data-bs-target="#financeReportModal">Finance Report</button>
                <button type="button" class="btn btn-outline-primary me-2" data-bs-toggle="modal" data-bs-target="#recentTransactionsModal">Search</button>

            </div>
        </div>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
                @if(Session::has('success'))
                <div class="alert alert-success" role="alert">
                    {{ Session::get('success') }}
                </div>
                @endif
                @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

            </ol>
        </nav>
    </div>


      <section class="section dashboard">
        <div class="row">

            <div class="card">
                <div class="card-body">
                    <h1 class="card-title"><i class="bi bi-grid-1x2-fill"></i> Introduction <!-- Button to trigger modal -->
                       </h1>

                    <!-- Integration of Expense, Budget, Cost, & Forecasting -->
                    <div class="card mb-3">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="{{ asset('assets/img/unsplash4.jpg') }}" class="img-fluid rounded-start" alt="...">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title">Integration of Expense, Budget, Cost, & Forecasting</h5>
                                    <p class="card-text">In expense budgeting and forecasting, "forecast" refers to the estimation or prediction of future expenses based on historical data, trends, and other relevant factors. This process involves analyzing past expenditure patterns, economic conditions, industry trends, and any other relevant factors to make informed projections about future expenses.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Expense Forecasting Process -->
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">


                                <!-- Step 1: Historical Data Analysis -->
                                <div class="card mb-3">
                                    <div class="row g-0">
                                        <div class="col-md-8">
                                            <div class="card-body">
                                                <h5 class="card-title"><strong><i class="bi bi-clock-history"></i> 1. Historical Data Analysis:</strong></h5>
                                                <p> The first step in expense forecasting is to analyze historical expenditure data. This involves examining past expenses over a specific period, such as monthly, quarterly, or annually. By analyzing historical data, organizations can identify patterns, trends, and seasonal variations in expenses.</p>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <img src="{{ asset('assets/img/data.jpg') }}" class="img-fluid rounded-start" alt="...">
                                        </div>
                                    </div>
                                </div>

                                <!-- Step 2: Identification of Key Drivers -->
                                <div class="card mb-3">
                                    <div class="row g-0">
                                        <div class="col-md-4">
                                            <img src="{{ asset('assets/img/key.jpg') }}" class="img-fluid rounded-start" alt="...">
                                        </div>
                                        <div class="col-md-8">
                                            <div class="card-body">
                                                <h5 class="card-title"><strong><i class="bi bi-search"></i> 2. Identification of Key Drivers:</strong></h5>
                                                <p> After analyzing historical data, the next step is to identify the key drivers that influence expenses. This may include factors such as inflation rates, changes in market conditions, business expansion or contraction, regulatory changes, and other variables that impact expenses.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Step 3: Forecasting Methods -->
                                <div class="card mb-3">
                                    <div class="row g-0">
                                        <div class="col-md-8">
                                            <div class="card-body">
                                                <h5 class="card-title"><strong><i class="bi bi-clipboard2-data-fill"></i> 3. Forecasting Methods:</strong></h5>
                                                <p> There are various methods and techniques used for expense forecasting, including quantitative methods (e.g., time series analysis, regression analysis) and qualitative methods (e.g., expert judgment, market research). The choice of forecasting method depends on factors such as the availability of data, the complexity of the expense patterns, and the level of accuracy required.</p>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <img src="{{ asset('assets/img/forecast.jpg') }}" class="img-fluid rounded-start" alt="...">
                                        </div>
                                    </div>
                                </div>

                                <!-- Step 4: Budgeting Process -->
                                <div class="card mb-3">
                                    <div class="row g-0">
                                        <div class="col-md-4">
                                            <img src="{{ asset('assets/img/calculate.jpg') }}" class="img-fluid rounded-start" alt="...">
                                        </div>
                                        <div class="col-md-8">
                                            <div class="card-body">
                                                <h5 class="card-title"><strong><i class="bi bi-calculator"></i> 4. Budgeting Process:</strong></h5>
                                                <p> Once the forecasted expenses are determined, they are incorporated into the budgeting process. Budgeting involves allocating financial resources to different expense categories based on the forecasted amounts. This helps organizations plan and allocate resources effectively to meet their financial goals and objectives.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Step 5: Monitoring and Adjustments -->
                                <div class="card mb-3">
                                    <div class="row g-0">
                                        <div class="col-md-8">
                                            <div class="card-body">
                                                <h5 class="card-title"><strong><i class="bi bi-eye-fill"></i> 5. Monitoring and Adjustments:</strong></h5>
                                                <p> Expense forecasting is an ongoing process that requires regular monitoring and adjustments. As actual expenses are incurred, they are compared to the forecasted amounts, and any significant variances are investigated. Adjustments may be made to the forecast based on new information, changes in business conditions, or other factors that impact expenses.</p>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <img src="{{ asset('assets/img/monitor.jpg') }}" class="img-fluid rounded-start" alt="...">
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>












<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>



          </div><!-- End Right side columns -->

        </div>
      </section>




        <!-- Recent Activity Modal -->
    <div class="modal fade" id="recentActivityModal" tabindex="-1" role="dialog" aria-labelledby="recentActivityModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="recentActivityModalLabel">Recent Activity | Today</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Recent Activity Content -->
                    <div class="activity">
                        <!-- Display recent activities from CostAllocation -->
                        @foreach($costAllocations as $costAllocation)
                        <div class="activity-item d-flex">
                            <div class="activity-label">{{ $costAllocation->created_at instanceof \Carbon\Carbon ? $costAllocation->created_at->diffForHumans() : $costAllocation->created_at }}</div>
                            <i class="bi bi-circle-fill activity-badge text-primary align-self-start"></i>
                            <div class="activity-content">
                                Created a cost allocation for {{ $costAllocation->cost_center }}.
                            </div>
                        </div><!-- End activity item-->
                        @endforeach

                        <!-- Display recent activities from Expense -->
                        @foreach($expenses as $expense)
                        <div class="activity-item d-flex">
                            <div class="activity-label">{{ $expense->created_at instanceof \Carbon\Carbon ? $expense->created_at->diffForHumans() : $expense->created_at }}</div>
                            <i class="bi bi-circle-fill activity-badge text-danger align-self-start"></i>
                            <div class="activity-content">
                                Recorded an expense of {{ $expense->amount }} for {{ $expense->category }}.
                            </div>
                        </div><!-- End activity item-->
                        @endforeach

                        <!-- Display recent activities from RequestBudget -->
                        @foreach($requestBudgets as $requestBudget)
                        <div class="activity-item d-flex">
                            <div class="activity-label">{{ $requestBudget->created_at instanceof \Carbon\Carbon ? $requestBudget->created_at->diffForHumans() : $requestBudget->created_at }}</div>
                            <i class="bi bi-circle-fill activity-badge text-success align-self-start"></i>
                            <div class="activity-content">
                                Created a budget request titled "{{ $requestBudget->title }}".
                            </div>
                        </div><!-- End activity item-->
                        @endforeach
                    </div>
                    <!-- End Recent Activity Content -->
                </div>
            </div>
        </div>
    </div>
    <!-- End Recent Activity Modal -->
    <!-- Modal -->
<div class="modal fade" id="financeReportModal" tabindex="-1" aria-labelledby="financeReportModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="card-title" id="financeReportModalLabel"><i class="bi bi-bar-chart-fill"></i> Finance Report</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-body">


                        <!-- Default Tabs -->
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <!-- Tabs content -->
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Categories Reports</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Categories Trends</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Categories Chart</button>
                            </li>
                        </ul>
                        <div class="tab-content pt-2" id="myTabContent">
                            <!-- Tab panes -->
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <!-- Reports -->
                                <div class="col-12">
                                    <div class="card">

                                        <div class="card-body">
                                            <h5 class="card-title">Reports <span>/Today</span></h5>

                                            <!-- Line Chart -->
                                            <div id="reportsChart"></div>

                                            <!-- End Line Chart -->

                                        </div>

                                    </div>
                                </div><!-- End Reports -->
                            </div>
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">Categories Trends</h5>

                                            <!-- Bar Chart -->
                                            <div id="barChart"></div>

                                            <!-- End Bar Chart -->

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">

                                <!-- Area Chart -->
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body pb-0">
                                            <h5 class="card-title">Categories Chart<span>/Today</span></h5>
                                            <!-- Area Chart -->
                                            <div id="areaChart"></div>
                                            <!-- End Area Chart -->
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div><!-- End Default Tabs -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", () => {
      fetch('/user/expenses-data')
          .then(response => response.json())
          .then(data => {
              const categories = [];
              const expenseAmounts = [];
              const costAllocationAmounts = [];
              const requestBudgetAmounts = [];

              data.expenses.forEach(expense => {
                  categories.push(expense.category);
                  expenseAmounts.push(expense.amount);
              });

              data.costAllocations.forEach(costAllocation => {
                  costAllocationAmounts.push(costAllocation.amount);
              });

              data.requestBudgets.forEach(requestBudget => {
                  requestBudgetAmounts.push(requestBudget.amount);
              });

              new ApexCharts(document.querySelector("#reportsChart"), {
                  series: [
                      {
                          name: 'Expense',
                          data: expenseAmounts,
                      },
                      {
                          name: 'Cost Allocation',
                          data: costAllocationAmounts,
                      },
                      {
                          name: 'Request Budget',
                          data: requestBudgetAmounts,
                      }
                  ],
                  chart: {
                      height: 350,
                      type: 'area',
                      toolbar: {
                          show: false
                      },
                  },
                  markers: {
                      size: 4
                  },
                  fill: {
                      type: "gradient",
                      gradient: {
                          shadeIntensity: 1,
                          opacityFrom: 0.3,
                          opacityTo: 0.4,
                          stops: [0, 90, 100]
                      }
                  },
                  dataLabels: {
                      enabled: false
                  },
                  stroke: {
                      curve: 'smooth',
                      width: 2
                  },
                  xaxis: {
                      categories: categories
                  },
                  tooltip: {
                      x: {
                          format: 'dd/MM/yy'
                      },
                  }
              }).render();
          });
    });
  </script>
  <!-- End Line Chart -->

  <script>
    document.addEventListener("DOMContentLoaded", () => {
        // Fetch expense data from the database and pass it to the chart
        let expenses = @json($expenses);
        // Fetch cost allocation data from the database and pass it to the chart
        let costAllocations = @json($costAllocations);

        // Combine both expense and cost allocation data into one dataset
        let dataset = [...expenses, ...costAllocations];

        new ApexCharts(document.querySelector("#barChart"), {
            series: [{
                data: dataset.map(data => data.amount)
            }],
            chart: {
                type: 'bar',
                height: 350
            },
            plotOptions: {
                bar: {
                    borderRadius: 4,
                    horizontal: true,
                }
            },
            dataLabels: {
                enabled: false
            },
            xaxis: {
                categories: dataset.map(data => data.category || data.cost_category)
            }
        }).render();
    });
</script>
<!-- End Bar Chart -->
<script>
    document.addEventListener("DOMContentLoaded", () => {
        const budgetChartData = @json($budgetChartData);
        const expenses = @json($expenses);
        const costAllocations = @json($costAllocations);

        // Extracting data from expenses and costAllocations
        const expenseData = expenses.map(expense => ({
            x: new Date(expense.date).getTime(),
            y: expense.amount
        }));

        const costAllocationData = costAllocations.map(costAllocation => ({
            x: new Date(costAllocation.created_at).getTime(), // Assuming created_at field represents date
            y: costAllocation.amount
        }));

        const allData = [...expenseData, ...costAllocationData];

        new ApexCharts(document.querySelector("#areaChart"), {
            series: [{
                name: "Budget Amount",
                data: budgetChartData.prices
            }, {
                name: "Expense Amount",
                data: expenseData
            }, {
                name: "Cost Allocation Amount",
                data: costAllocationData
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
            labels: budgetChartData.dates,
            xaxis: {
                type: 'datetime',
            },
            yaxis: {
                opposite: true
            },
            legend: {
                horizontalAlign: 'left'
            }
        }).render();
    });
</script><!-- Modal -->
<div class="modal fade" id="newsModal" tabindex="-1" aria-labelledby="newsModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newsModalLabel">News &amp; Updates</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="news" id="news-feed">
          @foreach($articles as $article)
          <div class="card mb-3">
            <div class="row g-0">
              <div class="col-md-12">
                <div class="card-body">
                  <h5 class="card-title">{{ $article['title'] }}</h5>
                  <img src="{{ $article['urlToImage'] }}" class="card-img img-fluid" alt="News Image">
                  <p class="card-text">{{ $article['description'] }}</p>
                  <a href="{{ $article['url'] }}" class="btn btn-primary">Read more</a>
                </div>
                <div class="card-footer">
                  <small class="text-muted">{{ $article['publishedAt'] }}</small>
                  <small class="text-muted">{{ $article['source']['name'] }}</small>
                </div>
              </div>
            </div>
          </div>
          @endforeach
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


  <!-- Modal -->
  <div class="modal fade" id="recentTransactionsModal" tabindex="-1" aria-labelledby="recentTransactionsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="card-title" id="recentTransactionsModalLabel"><i class="bi bi-receipt"></i> Search Data</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <!-- Pills Tabs -->
          <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
              <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Expenses</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Budget</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Cost</button>
            </li>
          </ul>
          <div class="tab-content pt-2" id="myTabContent">
            <!-- Tab panes for Recent Transactions -->
            <!-- Expenses -->
            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="home-tab">
              <!-- Recent Expenses -->
              <div class="col-15">
                <div class="card recent-expenses overflow-auto">

                  <div class="card-body">
                    <h5 class="card-title">Expenses <span></span></h5>
                    <table class="table table-borderless datatable">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Date</th>
                          <th scope="col">Category</th>
                          <th scope="col">Amount</th>
                          <th scope="col">Description</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($expenses as $index => $expense)
                        <tr>
                          <th scope="row"><a href="#">{{ $index + 1 }}</a></th>
                          <td>{{ $expense->date }}</td>
                          <td>{{ $expense->category }}</td>
                          <td>${{ $expense->amount }}</td>
                          <td>{{ $expense->description }}</td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <!-- End Recent Expenses -->
            </div>
            <!-- Budget -->
            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="profile-tab">
              <!-- Recent Budget Proposals -->
              <div class="col-12">
                <div class="card recent-budget-proposals overflow-auto">
                  <div class="card-body">
                    <h5 class="card-title">Budget Proposals <span></span></h5>
                    <table class="table table-borderless datatable">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Title</th>
                          <th scope="col">Description</th>
                          <th scope="col">Amount</th>
                          <th scope="col">Start Date</th>
                          <th scope="col">End Date</th>
                          <th scope="col">Status</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($recentRequestBudgets as $proposal)
                        <tr>
                          <th scope="row"><a href="#">{{ $proposal->id }}</a></th>
                          <td>{{ $proposal->title }}</td>
                          <td>{{ $proposal->description }}</td>
                          <td>${{ number_format($proposal->amount, 2) }}</td>
                          <td>{{ $proposal->start_date }}</td>
                          <td>{{ $proposal->end_date }}</td>
                          <td><span class="badge {{ $proposal->status === 'Pending' ? 'bg-success' : ($proposal->status === 'Rejected' ? 'bg-warning' : 'bg-danger') }}">{{ $proposal->status }}</span></td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <!-- End Recent Budget Proposals -->
            </div>
            <!-- Cost -->
            <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="contact-tab">
              <!-- Recent Sales -->
              <div class="col-15">
                <div class="card recent-sales overflow-auto">

                  <div class="card-body">
                    <h5 class="card-title">Cost Allocated <span></span></h5>
                    <table class="table table-borderless datatable">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Cost Center</th>
                          <th scope="col">Cost Category</th>
                          <th scope="col">Amount</th>
                          <th scope="col">Description</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($recentCostAllocations as $allocation)
                        <tr>
                          <th scope="row"><a href="#">{{ $allocation->id }}</a></th>
                          <td>{{ $allocation->cost_center }}</td>
                          <td>{{ $allocation->cost_category }}</td>
                          <td>{{ $allocation->amount }}</td>
                          <td>{{ $allocation->description }}</td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <!-- End Recent Sales -->
            </div>
          </div><!-- End Pills Tabs -->
        </div>
      </div>
    </div>
  </div>

<!-- End Area Chart -->
    </main><!-- End #main -->


@include('layout.footer')

</body>

</html>
