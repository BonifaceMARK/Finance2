
@extends('layout.title')

@section('title', 'Finance Manager')
@include('layout.title')
<body>

  <!-- ======= Header ======= -->
@include('Sub-admin.header')

  <!-- ======= Sidebar ======= -->
@include('Sub-admin.sidebar')

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

      <!-- Expense Card -->
<div class="col-xxl-4 col-md-6">
    <div class="card info-card sales-card">
        <div class="card-body">
            <h5 class="card-title">Expense <span>| Today</span></h5>
            <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-coin"></i>
                </div>
                <div class="ps-3">
                    <h6>${{ number_format($currentDayExpenses, 2) }}</h6>
                    @php
                        $previousDayExpenses = App\Models\Expense::whereDate('expense_date', now()->subDay())->sum('amount');
                        $increasePercentage = $previousDayExpenses != 0 ? ($currentDayExpenses - $previousDayExpenses) / $previousDayExpenses * 100 : 0;
                    @endphp
                    <span class="text-success small pt-1 fw-bold">{{ number_format($increasePercentage, 2) }}%</span>
                    <span class="text-muted small pt-2 ps-1">increase</span>
                </div>
            </div>
        </div>
    </div>
</div><!-- End Sales Card -->
 <!-- Expenses Card -->
<div class="col-xxl-4 col-md-6">
    <div class="card info-card revenue-card">

        <div class="card-body">
            <h5 class="card-title">Expenses <span>| This Month</span></h5>

            <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-currency-dollar"></i>
                </div>
                <div class="ps-3">
                    <h6>${{ number_format($currentMonthExpenses, 2) }}</h6>
                    @php
                        $increasePercentage = $previousMonthExpenses != 0 ? ($currentMonthExpenses - $previousMonthExpenses) / $previousMonthExpenses * 100 : 0;
                    @endphp
                    <span class="text-success small pt-1 fw-bold">{{ number_format($increasePercentage, 2) }}%</span>
                    <span class="text-muted small pt-2 ps-1">increase</span>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- End Expenses Card -->

<!-- Expenses Card -->
<div class="col-xxl-4 col-xl-12">
    <div class="card info-card customers-card">
        <div class="card-body">
            <h5 class="card-title">Expenses <span>| This Year</span></h5>
            <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-bank2"></i>
                </div>
                <div class="ps-3">
                    <h6>${{ number_format( $currentYearExpenses, 2) }}</h6>
                    <!-- Calculation for the decrease can be done dynamically in your controller -->
                    @php
                        $currentYearExpenses = App\Models\Expense::whereYear('expense_date', now())->sum('amount');
                        $previousYearExpenses = App\Models\Expense::whereYear('expense_date', now()->subYear())->sum('amount');
                        $decreasePercentage = $previousYearExpenses != 0 ? ($currentYearExpenses - $previousYearExpenses) / $previousYearExpenses * 100 : 0;
                    @endphp
                    <span class="text-danger small pt-1 fw-bold">{{ number_format($decreasePercentage, 2) }}%</span>
                    <span class="text-muted small pt-2 ps-1">decrease</span>
                </div>
            </div>
        </div>
    </div>
</div><!-- End Customers Card -->

 <!-- Reports -->
<div class="col-12">
    <div class="card">

        <div class="card-body">
            <h5 class="card-title">Expense Report <span>/Today</span></h5>

            <!-- Line Chart -->
            <div id="reportsChart"></div>

            <script>
                document.addEventListener("DOMContentLoaded", () => {
                    const categories = {!! json_encode($reports->pluck('category')) !!};
                    const expenses = {!! json_encode($reports->pluck('expense')) !!};
                    const dates = {!! json_encode($reports->pluck('date')) !!};

                    new ApexCharts(document.querySelector("#reportsChart"), {
                        series: [{
                            name: 'Expenses',
                            data: expenses
                        }],
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
                        colors: ['#4154f1'],
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
                            type: 'datetime',
                            categories: dates
                        },
                        tooltip: {
                            x: {
                                format: 'dd/MM/yy HH:mm'
                            },
                        }
                    }).render();
                });
            </script>
            <!-- End Line Chart -->

        </div>

    </div>
</div>
<!-- End Reports -->


        <!-- Recent Sales -->
<div class="col-12">
    <div class="card recent-sales overflow-auto">
        <div class="card-body">
            <h5 class="card-title">Budget Proposals Status<span>| Today</span></h5>

            <table class="table table-borderless datatable">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Budget Plan</th>
                        <th scope="col">Title</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($budgetProposals as $proposal)
                    <tr>
                        <th scope="row"><a href="#">{{ $proposal->id }}</a></th>
                        <td>{{ $proposal->budgetPlan->name }}</td>
                        <td><a href="#" class="text-primary">{{ $proposal->title }}</a></td>
                        <td>${{ $proposal->amount }}</td>
                        <td><span class="badge bg-success">{{ $proposal->status }}</span></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- End Recent Sales -->


            <div class="col-12">
                <div class="card top-selling overflow-auto">
                    <div class="card-body pb-0">
                        <h5 class="card-title">Created BudgetPlans <span>| Today</span></h5>

                        <table class="table table-borderless">
                            <thead>
                                <tr>
                                    <th scope="col">Title</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Total Amount</th>
                                    <th scope="col">Start Date</th>
                                    <th scope="col">End Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($budgetPlans as $plan)
                                <tr>
                                    <td><a href="#" class="text-primary fw-bold">{{ $plan->title }}</a></td>
                                    <td>{{ $plan->description }}</td>
                                    <td>{{ $plan->total_amount }}</td>
                                    <td>{{ $plan->start_date }}</td>
                                    <td>{{ $plan->end_date }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div><!-- End Top Selling -->
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
        <h5 class="card-title">Allocated Cost <span>| Today</span></h5>

        <table class="table table-borderless">
          <thead>
            <tr>
              <th scope="col">Cost Center</th>
              <th scope="col">Cost Category</th>
              <th scope="col">Allocation Method</th>
              <th scope="col">Amount</th>
              <th scope="col">Description</th>
            </tr>
          </thead>
          <tbody>
            @foreach($costAllocations as $allocation)
            <tr>
              <td>{{ $allocation->cost_center }}</td>
              <td>{{ $allocation->cost_category }}</td>
              <td>{{ $allocation->allocation_method }}</td>
              <td>{{ $allocation->amount }}</td>
              <td>{{ $allocation->description }}</td>
            </tr>
            @endforeach
          </tbody>
        </table>

      </div>

    </div>
  </div><!-- End Top Selling -->

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Financial Report <span>| Today</span></h5>
                    <!-- Display Uploaded Image in Carousel -->
                    @if (isset($carouselItems))
                        <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                @foreach ($carouselItems as $index => $item)
                                    <div class="carousel-item {{ $item['active'] }}">
                                        <img src="{{ asset($item['image']) }}" class="d-block w-100" alt="Uploaded Image">
                                    </div>
                                @endforeach
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    @endif
                </div>
            </div>



          </div>
        </div><!-- End Left side columns -->


        <!-- Right side columns -->
        <div class="col-lg-4">
      <!-- Recent Activity -->
<div class="card">

    <div class="card-body">
        <h5 class="card-title">Recent Budget Proposals</h5>

        <div class="activity">
            @foreach($budgetProposals as $proposal)
            <div class="activity-item d-flex">
                <div class="activite-label">{{ $proposal->created_at->diffForHumans() }}</div>
                <i class='bi bi-circle-fill activity-badge text-success align-self-start'></i>
                <div class="activity-content">
                    {{ $proposal->title }} - <span class="fw-bold">${{ $proposal->amount }}</span> - {{ $proposal->description }}
                </div>
            </div><!-- End activity item-->
            @endforeach
        </div>

    </div>
</div><!-- End Recent Activity -->




<!-- Budget Report -->
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

    <div class="card-body pb-0">
        <h5 class="card-title">Budget Report <span>| This Month</span></h5>
        <div id="budgetChart" style="min-height: 400px;" class="echart"></div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            var budgetChart = echarts.init(document.querySelector("#budgetChart"));


            var budgetCategories = {!! $budgetCategories !!};

            var indicatorData = [];
            var allocatedBudgetData = [];
            var actualSpendingData = [];


            budgetCategories.forEach(function(category) {
                indicatorData.push({ name: category.name, max: category.max });
                allocatedBudgetData.push(category.allocated_budget);
                actualSpendingData.push(category.actual_spending);
            });


            budgetChart.setOption({
                legend: {
                    data: ['Allocated Budget', 'Actual Spending']
                },
                radar: {
                    indicator: indicatorData
                },
                series: [{
                    name: 'Budget vs spending',
                    type: 'radar',
                    data: [{
                            value: allocatedBudgetData,
                            name: 'Allocated Budget'
                        },
                        {
                            value: actualSpendingData,
                            name: 'Actual Spending'
                        }
                    ]
                }]
            });
        });
    </script>
</div>
<!-- End Budget Report -->



       <!-- Website Traffic -->
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



          <!-- News & Updates Traffic -->
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

            <div class="card-body pb-0">
              <h5 class="card-title">News &amp; Updates <span>| Today</span></h5>

              <div class="news">
                <div class="post-item clearfix">
                  <img src="assets/img/news-1.jpg" alt="">
                  <h4><a href="#">Nihil blanditiis at in nihil autem</a></h4>
                  <p>Sit recusandae non aspernatur laboriosam. Quia enim eligendi sed ut harum...</p>
                </div>

                <div class="post-item clearfix">
                  <img src="assets/img/news-2.jpg" alt="">
                  <h4><a href="#">Quidem autem et impedit</a></h4>
                  <p>Illo nemo neque maiores vitae officiis cum eum turos elan dries werona nande...</p>
                </div>

                <div class="post-item clearfix">
                  <img src="assets/img/news-3.jpg" alt="">
                  <h4><a href="#">Id quia et et ut maxime similique occaecati ut</a></h4>
                  <p>Fugiat voluptas vero eaque accusantium eos. Consequuntur sed ipsam et totam...</p>
                </div>

                <div class="post-item clearfix">
                  <img src="assets/img/news-4.jpg" alt="">
                  <h4><a href="#">Laborum corporis quo dara net para</a></h4>
                  <p>Qui enim quia optio. Eligendi aut asperiores enim repellendusvel rerum cuder...</p>
                </div>

                <div class="post-item clearfix">
                  <img src="assets/img/news-5.jpg" alt="">
                  <h4><a href="#">Et dolores corrupti quae illo quod dolor</a></h4>
                  <p>Odit ut eveniet modi reiciendis. Atque cupiditate libero beatae dignissimos eius...</p>
                </div>

              </div><!-- End sidebar recent posts-->

            </div>
          </div><!-- End News & Updates -->

        </div><!-- End Right side columns -->

      </div>
    </section>

  </main><!-- End #main -->
@include('layout.footer')

</body>

</html>
