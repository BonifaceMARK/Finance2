
@extends('layout.title')

@section('title','Finance Manager')
@include('layout.title')
<body>

  <!-- ======= Header ======= -->
@include('User.header')

  <!-- ======= Sidebar ======= -->
  @include('User.sidebar')

  <main id="main" class="main">

    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
            @if(Session::has('success'))
            <div class="alert alert-success" role="alert">
                {{ Session::get('success') }}
            </div>
        @endif
          </ol>
        </nav>
      </div><!-- End Page Title -->

      <section class="section dashboard">
        <div class="row">

          <!-- Left side columns -->
          <div class="col-lg-8">
            <div class="row">

<!-- Reports -->
<div class="col-12">
    <div class="card">

      <div class="card-body">
        <h5 class="card-title">Reports <span>/Today</span></h5>

        <!-- Line Chart -->
        <div id="reportsChart"></div>

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

      </div>

    </div>
  </div><!-- End Reports -->
              <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Finance Trends</h5>

                        <!-- Bar Chart -->
                        <div id="barChart"></div>

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

                    </div>
                </div>
            </div>







 <!-- Area Chart -->
<div class="col-12">
    <div class="card">
        <div class="card-body pb-0">
            <h5 class="card-title">Finance Movements<span>/Today</span></h5>
            <!-- Area Chart -->
            <div id="areaChart"></div>
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
                        subtitle: {
                            text: 'Budget Trends',
                            align: 'left'
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
            </script>
            <!-- End Area Chart -->
        </div>
    </div>
</div>
           <!-- Second Card -->
           <div class="col-md-15">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Created Receipts</h5>

                    <!-- Slides with indicators -->
                    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-indicators">
                            <!-- Dynamically generate carousel indicators based on image count -->
                            @foreach ($images as $key => $image)
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="{{ $key }}" class="{{ $key == 0 ? 'active' : '' }}" aria-label="Slide {{ $key + 1 }}"></button>
                            @endforeach
                        </div>
                        <div class="carousel-inner">
                            <!-- Dynamically generate carousel items based on image filenames -->
                            @foreach ($images as $key => $image)
                            <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                <img src="{{ asset('images/' . $image) }}" class="d-block w-100" alt="{{ $image }}">
                            </div>
                            @endforeach
                        </div>

                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div><!-- End Slides with indicators -->
                </div>
            </div>
        </div>


<!-- Recent Expenses -->
<div class="col-15">
    <div class="card recent-expenses overflow-auto">

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
            <h5 class="card-title">Recent Expenses <span>| Today</span></h5>

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



 <!-- Recent Budget Proposals -->
<div class="col-12">
    <div class="card recent-budget-proposals overflow-auto">

        <div class="card-body">
            <h5 class="card-title">Recent Budget Proposals <span>| Today</span></h5>

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
  </div><!-- End Recent Budget Proposals -->


<!-- Recent Sales -->
<div class="col-15">
    <div class="card recent-sales overflow-auto">
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
            <h5 class="card-title">Recent Cost Allocated <span>| Today</span></h5>

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
</div><!-- End Recent Sales -->


            </div>
          </div><!-- End Left side columns -->

          <!-- Right side columns -->
          <div class="col-lg-4">

<!-- Recent Activity -->
<div class="card">
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
      <h5 class="card-title">Recent Activity <span>| Today</span></h5>

      <div class="activity">
        <!-- Display recent activities from CostAllocation -->
        @foreach($costAllocations as $costAllocation)
        <div class="activity-item d-flex">
          <div class="activite-label">{{ $costAllocation->created_at instanceof \Carbon\Carbon ? $costAllocation->created_at->diffForHumans() : $costAllocation->created_at }}</div>
          <i class="bi bi-circle-fill activity-badge text-primary align-self-start"></i>
          <div class="activity-content">
            Created a cost allocation for {{ $costAllocation->cost_center }}.
          </div>
        </div><!-- End activity item-->
        @endforeach

        <!-- Display recent activities from Expense -->
        @foreach($expenses as $expense)
        <div class="activity-item d-flex">
          <div class="activite-label">{{ $expense->created_at instanceof \Carbon\Carbon ? $expense->created_at->diffForHumans() : $expense->created_at }}</div>
          <i class="bi bi-circle-fill activity-badge text-danger align-self-start"></i>
          <div class="activity-content">
            Recorded an expense of {{ $expense->amount }} for {{ $expense->category }}.
          </div>
        </div><!-- End activity item-->
        @endforeach

        <!-- Display recent activities from RequestBudget -->
        @foreach($requestBudgets as $requestBudget)
        <div class="activity-item d-flex">
          <div class="activite-label">{{ $requestBudget->created_at instanceof \Carbon\Carbon ? $requestBudget->created_at->diffForHumans() : $requestBudget->created_at }}</div>
          <i class="bi bi-circle-fill activity-badge text-success align-self-start"></i>
          <div class="activity-content">
            Created a budget request titled "{{ $requestBudget->title }}".
          </div>
        </div><!-- End activity item-->
        @endforeach

      </div>
    </div>
  </div><!-- End Recent Activity -->





             <!-- Cost Center -->
      <div class="card">

        <div class="card-body pb-0">
          <h5 class="card-title">Allocated Cost <span>| Today</span></h5>

          <div id="trafficChart" style="min-height: 400px;" class="echart"></div>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            // Initialize ECharts
            var trafficChart = echarts.init(document.querySelector("#trafficChart"));

            // Chart options
            var options = {
                tooltip: {
                    trigger: 'item'
                },
                legend: {
                    top: '5%',
                    left: 'center'
                },
                series: [{
                    name: 'Access From',
                    type: 'pie',
                    radius: ['40%', '70%'],
                    avoidLabelOverlap: false,
                    label: {
                        show: false,
                        position: 'center'
                    },
                    emphasis: {
                        label: {
                            show: true,
                            fontSize: '18',
                            fontWeight: 'bold'
                        }
                    },
                    labelLine: {
                        show: false
                    },
                    // Use chartData passed from the controller
                    data: @json($chartData)
                }]
            };

            // Set options
            trafficChart.setOption(options);
        });
    </script>
  </div>
</div><!-- End Cost Centers -->

<div class="card">
    <div class="card-body pb-0">
        <h5 class="card-title">News &amp; Updates <span>| Today</span></h5>
        <div class="news" id="news-feed">
            <!-- News articles will be dynamically loaded here -->
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // News API URL for finance news
        var newsApiUrl = 'https://newsapi.org/v2/everything?q=finance&pageSize=5&apiKey=014d72b0e8ae42aeab34e2163a269a83';

        // Fetch news articles from the News API
        $.ajax({
            url: newsApiUrl,
            success: function(response) {
                // Extract news articles from the response
                var articles = response.articles;
                articles.forEach(function(article) {
                    var title = article.title;
                    var link = article.url;
                    var description = article.description;
                    var imageUrl = article.urlToImage;

                    // Append news article to the news feed
                    var articleHtml = '<div class="post-item clearfix">';
                    articleHtml += '<h4><a href="' + link + '" target="_blank">' + title + '</a></h4>';
                    if (imageUrl) {
                        articleHtml += '<img src="' + imageUrl + '" alt="' + title + '" style="max-width: 100%;">';
                    }
                    articleHtml += '<p>' + description + '</p>';
                    articleHtml += '</div>';
                    $('#news-feed').append(articleHtml);
                });
            }
        });
    });
</script>



          </div><!-- End Right side columns -->

        </div>
      </section>

    </main><!-- End #main -->
@include('layout.footer')

</body>

</html>
