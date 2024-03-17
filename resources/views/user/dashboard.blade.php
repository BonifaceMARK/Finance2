
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
          </ol>
        </nav>
      </div><!-- End Page Title -->

      <section class="section dashboard">
        <div class="row">

          <!-- Left side columns -->
          <div class="col-lg-8">
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


    <div class="col-xxl-4 col-md-6">
        <div class="card info-card revenue-card">
            <div class="card-body">
                <h5 class="card-title">Budget <span>| This Month</span></h5>

                <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bi bi-currency-dollar"></i>
                    </div>
                    <div class="ps-3">
                        <h6>${{ number_format($totalRevenueThisMonth, 2) }}</h6>
                        <span class="text-{{ $revenuePercentageChange >= 0 ? 'success' : 'danger' }} small pt-1 fw-bold">{{ number_format($revenuePercentageChange, 2) }}%</span>
                        <span class="text-muted small pt-2 ps-1">{{ $revenuePercentageChange >= 0 ? 'increase' : 'decrease' }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Revenue Card -->


<!-- Cost Allocated Card -->
<div class="col-xxl-4 col-xl-12">
    <div class="card info-card customers-card">
        <div class="card-body">
            <h5 class="card-title">Cost Allocated <span>| This Year</span></h5>

            <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-people"></i>
                </div>
                <div class="ps-3">
                    <h6>{{ $totalCostAllocatedThisYear }}</h6>
                    <span class="text-{{ $costAllocationPercentageChange >= 0 ? 'danger' : 'success' }} small pt-1 fw-bold">{{ number_format($costAllocationPercentageChange, 2) }}%</span>
                    <span class="text-muted small pt-2 ps-1">{{ $costAllocationPercentageChange >= 0 ? 'increase' : 'decrease' }}</span>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- End Cost Allocated Card -->

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




      <!-- Area Chart -->
<div class="col-12">
    <div class="card">
        <div class="card-body pb-0">
            <h5 class="card-title">Budget Trends<span>/Today</span></h5>
            <!-- Area Chart -->
            <div id="areaChart"></div>
            <script>
                document.addEventListener("DOMContentLoaded", () => {
                    const budgetChartData = @json($budgetChartData);

                    new ApexCharts(document.querySelector("#areaChart"), {
                        series: [{
                            name: "Budget Amount",
                            data: budgetChartData.prices
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




<div class="col-15">
    <div class="card recent-request-budgets overflow-auto">
        <div class="card-body">
            <h5 class="card-title">Recent Request Budgets</h5>
            <table class="table table-borderless datatable">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Start Date</th>
                        <th scope="col">End Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recentRequestBudgets as $budget)
                    <tr>
                        <th scope="row"><a href="#">{{ $budget->id }}</a></th>
                        <td>{{ $budget->title }}</td>
                        <td>${{ $budget->amount }}</td>
                        <td>{{ $budget->start_date }}</td>
                        <td>{{ $budget->end_date }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div><!-- End Recent Request Budgets -->

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
              <!-- Top Selling -->
              <div class="col-12">
                <div class="card top-selling overflow-auto">

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

                  <div class="card-body pb-0">
                    <h5 class="card-title">Top Selling <span>| Today</span></h5>

                    <table class="table table-borderless">
                      <thead>
                        <tr>
                          <th scope="col">Preview</th>
                          <th scope="col">Product</th>
                          <th scope="col">Price</th>
                          <th scope="col">Sold</th>
                          <th scope="col">Revenue</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <th scope="row"><a href="#"><img src="assets/img/product-1.jpg" alt=""></a></th>
                          <td><a href="#" class="text-primary fw-bold">Ut inventore ipsa voluptas nulla</a></td>
                          <td>$64</td>
                          <td class="fw-bold">124</td>
                          <td>$5,828</td>
                        </tr>
                        <tr>
                          <th scope="row"><a href="#"><img src="assets/img/product-2.jpg" alt=""></a></th>
                          <td><a href="#" class="text-primary fw-bold">Exercitationem similique doloremque</a></td>
                          <td>$46</td>
                          <td class="fw-bold">98</td>
                          <td>$4,508</td>
                        </tr>
                        <tr>
                          <th scope="row"><a href="#"><img src="assets/img/product-3.jpg" alt=""></a></th>
                          <td><a href="#" class="text-primary fw-bold">Doloribus nisi exercitationem</a></td>
                          <td>$59</td>
                          <td class="fw-bold">74</td>
                          <td>$4,366</td>
                        </tr>
                        <tr>
                          <th scope="row"><a href="#"><img src="assets/img/product-4.jpg" alt=""></a></th>
                          <td><a href="#" class="text-primary fw-bold">Officiis quaerat sint rerum error</a></td>
                          <td>$32</td>
                          <td class="fw-bold">63</td>
                          <td>$2,016</td>
                        </tr>
                        <tr>
                          <th scope="row"><a href="#"><img src="assets/img/product-5.jpg" alt=""></a></th>
                          <td><a href="#" class="text-primary fw-bold">Sit unde debitis delectus repellendus</a></td>
                          <td>$79</td>
                          <td class="fw-bold">41</td>
                          <td>$3,239</td>
                        </tr>
                      </tbody>
                    </table>

                  </div>

                </div>
              </div><!-- End Top Selling -->

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

                  <div class="activity-item d-flex">
                    <div class="activite-label">32 min</div>
                    <i class='bi bi-circle-fill activity-badge text-success align-self-start'></i>
                    <div class="activity-content">
                      Quia quae rerum <a href="#" class="fw-bold text-dark">explicabo officiis</a> beatae
                    </div>
                  </div><!-- End activity item-->

                  <div class="activity-item d-flex">
                    <div class="activite-label">56 min</div>
                    <i class='bi bi-circle-fill activity-badge text-danger align-self-start'></i>
                    <div class="activity-content">
                      Voluptatem blanditiis blanditiis eveniet
                    </div>
                  </div><!-- End activity item-->

                  <div class="activity-item d-flex">
                    <div class="activite-label">2 hrs</div>
                    <i class='bi bi-circle-fill activity-badge text-primary align-self-start'></i>
                    <div class="activity-content">
                      Voluptates corrupti molestias voluptatem
                    </div>
                  </div><!-- End activity item-->

                  <div class="activity-item d-flex">
                    <div class="activite-label">1 day</div>
                    <i class='bi bi-circle-fill activity-badge text-info align-self-start'></i>
                    <div class="activity-content">
                      Tempore autem saepe <a href="#" class="fw-bold text-dark">occaecati voluptatem</a> tempore
                    </div>
                  </div><!-- End activity item-->

                  <div class="activity-item d-flex">
                    <div class="activite-label">2 days</div>
                    <i class='bi bi-circle-fill activity-badge text-warning align-self-start'></i>
                    <div class="activity-content">
                      Est sit eum reiciendis exercitationem
                    </div>
                  </div><!-- End activity item-->

                  <div class="activity-item d-flex">
                    <div class="activite-label">4 weeks</div>
                    <i class='bi bi-circle-fill activity-badge text-muted align-self-start'></i>
                    <div class="activity-content">
                      Dicta dolorem harum nulla eius. Ut quidem quidem sit quas
                    </div>
                  </div><!-- End activity item-->

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
