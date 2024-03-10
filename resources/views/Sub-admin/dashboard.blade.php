
@extends('layout.title')

@section('title', 'Welcome to Sub-admin Dashboard')
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
                  <h5 class="card-title">Recent Sales <span>| Today</span></h5>

                  <table class="table table-borderless datatable">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Customer</th>
                        <th scope="col">Product</th>
                        <th scope="col">Price</th>
                        <th scope="col">Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <th scope="row"><a href="#">#2457</a></th>
                        <td>Brandon Jacob</td>
                        <td><a href="#" class="text-primary">At praesentium minu</a></td>
                        <td>$64</td>
                        <td><span class="badge bg-success">Approved</span></td>
                      </tr>
                      <tr>
                        <th scope="row"><a href="#">#2147</a></th>
                        <td>Bridie Kessler</td>
                        <td><a href="#" class="text-primary">Blanditiis dolor omnis similique</a></td>
                        <td>$47</td>
                        <td><span class="badge bg-warning">Pending</span></td>
                      </tr>
                      <tr>
                        <th scope="row"><a href="#">#2049</a></th>
                        <td>Ashleigh Langosh</td>
                        <td><a href="#" class="text-primary">At recusandae consectetur</a></td>
                        <td>$147</td>
                        <td><span class="badge bg-success">Approved</span></td>
                      </tr>
                      <tr>
                        <th scope="row"><a href="#">#2644</a></th>
                        <td>Angus Grady</td>
                        <td><a href="#" class="text-primar">Ut voluptatem id earum et</a></td>
                        <td>$67</td>
                        <td><span class="badge bg-danger">Rejected</span></td>
                      </tr>
                      <tr>
                        <th scope="row"><a href="#">#2644</a></th>
                        <td>Raheem Lehner</td>
                        <td><a href="#" class="text-primary">Sunt similique distinctio</a></td>
                        <td>$165</td>
                        <td><span class="badge bg-success">Approved</span></td>
                      </tr>
                    </tbody>
                  </table>

                </div>

              </div>
            </div><!-- End Recent Sales -->

            <!-- Top Selling -->
            <div class="col-12">
              <div class="card top-selling overflow-auto">

                <div class="card-body pb-0">
                  <h5 class="card-title">Top Expenses <span>| Today</span></h5>

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

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Recent Activity <span>| Today</span></h5>

                    <div class="activity">
                        @foreach($costAllocations as $costAllocation)
                            <div class="activity-item d-flex">
                                <div class="activite-label">Now</div>
                                <i class='bi bi-circle-fill activity-badge text-success align-self-start'></i>
                                <div class="activity-content">
                                    @if ($costAllocation->destination_cost_center && $costAllocation->source_cost_center)
                                        New cost allocation of ${{ $costAllocation->amount }} to <a href="#" class="fw-bold text-dark">{{ $costAllocation->destination_cost_center->name }}</a> from {{ $costAllocation->source_cost_center->name }}
                                    @else
                                        Cost allocation details not available
                                    @endif
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



         <!-- Cost Allocated -->
<div class="card">
    <div class="card-body pb-0">
      <h5 class="card-title">Cost Allocation <span>| Today</span></h5>

      <div id="trafficChart" style="min-height: 400px;" class="echart"></div>

      <script>
       document.addEventListener("DOMContentLoaded", () => {
    // Fetch dynamic data from the server using Laravel's Eloquent ORM
    let costAllocations = @json($costAllocations);

    let data = [];
    let legendData = [];

    // Populate data dynamically
    costAllocations.forEach(allocation => {
        // Check if allocation and source_cost_center are not null or undefined
        if (allocation && allocation.source_cost_center) {
            data.push({ value: allocation.amount, name: allocation.source_cost_center.name });
            legendData.push(allocation.source_cost_center.name);
        }
    });

    echarts.init(document.querySelector("#trafficChart")).setOption({
        tooltip: {
            trigger: 'item'
        },
        legend: {
            top: '5%',
            left: 'center',
            data: legendData // Use dynamic legend data
        },
        series: [{
            name: 'Cost Allocation',
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
            data: data // Use dynamic data
        }]
    });
});
      </script>

    </div>
  </div><!-- End Website Traffic -->

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
