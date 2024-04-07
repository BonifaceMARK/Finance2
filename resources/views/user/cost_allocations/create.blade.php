@extends('layout.title')

@section('title', 'Cost Allocation')
@include('layout.title')

<body>

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
                <i class="bi bi-coin"> Costs</i>
                <div class="d-flex">
                    <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#allocate">
                        Allocate Cost
                    </button>
                    <!-- Button to trigger the modal -->
                    <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#costAllocationModal">
                        View Cost Allocations
                    </button>
                </div>
            </h1>
        </div>


            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Costs</a></li>
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
            <div class="container">
                <div class="row">
                    <div class="card mb-3">
                        <div class="row g-0">
                          <div class="col-md-4">
                            <img src="{{asset('assets/img/allocated.jpg')}}" class="img-fluid rounded-start" alt="...">
                            <br>

                          </div>
                          <div class="col-md-8">
                            <div class="card-body">
                              <h5 class="card-title"><i class="bi bi-geo"></i> <strong>Cost Allocation</strong></h5>
                              <p class="card-text">Cost allocation refers to the process of distributing indirect costs across different cost centers, products, services, or other entities within an organization. It is a vital aspect of managerial accounting and financial management, helping organizations accurately assess the true cost of their products or services and make informed business decisions.</p>
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
<div class="container-fluid">
    <div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><i class="bi bi-geo-alt-fill"></i> Allocated Cost <span>| Today</span></h5>

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
        </div>
    </div>
</div><!-- End Allocated Cost -->



                </div>
            </div>
        </div>
    </div>


                            </div>
                          </div>
                        </div>
                      </div><!-- End Card with an image on left -->




<!-- Modal -->
<div class="modal fade" id="costAllocationModal" tabindex="-1" aria-labelledby="costAllocationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="costAllocationModalLabel">Cost Allocations <!-- Button to trigger the modal -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#Indirect">
                        View Indirect Costs
                    </button></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Item</th>
                                                    <th>Cost Center</th>
                                                    <th>Cost Category</th>
                                                    <th>Cost Type</th>
                                                    <th>Amount</th>
                                                    <th>Description</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($costAllocations as $costAllocation)
                                                <tr>
                                                    <td>{{ $costAllocation->item }}</td>
                                                    <td>{{ $costAllocation->cost_center }}</td>
                                                    <td>{{ $costAllocation->cost_category }}</td>
                                                    <td>{{ $costAllocation->cost_type }}</td>
                                                    <td>${{ number_format($costAllocation->amount, 2) }}</td>
                                                    <td>{{ $costAllocation->description }}</td>
                                                </tr>
                                                @empty
                                                <tr>
                                                    <td colspan="6">No cost allocations found.</td>
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
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>



<!-- Modal -->
<div class="modal fade" id="Indirect" tabindex="-1" aria-labelledby="Indirect" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="Indirect">Indirect Costs</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row justify-content-center">
                        <div class="col-md-12">
                                        <div class="card-body">
                                            <div class="row row-cols-1 row-cols-md-2 g-4">
                                                @foreach($indirectCostAllocations as $costAllocation)
                                                <div class="col">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <h5 class="card-title">{{ $costAllocation->item }}</h5>
                                                            <p class="card-text"><strong>Cost Center:</strong> {{ $costAllocation->cost_center }}</p>
                                                            <p class="card-text"><strong>Cost Category:</strong> {{ $costAllocation->cost_category }}</p>
                                                            <p class="card-text"><strong>Amount:</strong> ${{ number_format($costAllocation->amount, 2) }}</p>
                                                            <p class="card-text"><strong>Description:</strong> {{ $costAllocation->description }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            {{ $indirectCostAllocations->links() }}
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

              <!-- Modal -->
<div class="modal fade" id="allocate" tabindex="-1" aria-labelledby="allocate" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="allocate">
                    <i class="bi bi-file-earmark-plus"></i> Allocate Cost
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('cost_allocations.store') }}" method="POST">
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
                        <label for="cost_center">Cost Center:</label>
                        <select class="form-control" id="cost_center" name="cost_center">
                            <option value="Administration">Administration</option>
                            <option value="Logistics">Logistics</option>
                            <option value="Human Resource">Human Resource</option>
                            <option value="Hotel & Restaurant">Hotel & Restaurant</option>
                            <option value="E-Commerce">E-Commerce</option>
                            <option value="Local Government Unit">Local Government Unit</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="cost_category">Cost Category:</label>
                        <select class="form-control" id="cost_category" name="cost_category">
                            <option value="Administrative Expenses">Administrative Expenses</option>
                            <option value="Marketing and Advertising">Marketing and Advertising</option>
                            <option value="Employee Benefits">Employee Benefits</option>
                            <option value="Travel and Entertainment">Travel and Entertainment</option>
                            <option value="Research and Development">Research and Development</option>
                            <option value="Raw Materials and Inventory">Raw Materials and Inventory</option>
                            <option value="Technology Expenses">Technology Expenses</option>
                            <option value="Legal and Professional Fees">Legal and Professional Fees</option>
                            <option value="Maintenance and Repairs">Maintenance and Repairs</option>
                            <option value="Utilities">Utilities</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="cost_type">Cost Type:</label>
                        <select class="form-control" id="cost_type" name="cost_type">
                            <option value="Indirect">Indirect</option>
                            <option value="Direct">Direct</option>

                        </select>
                    </div>
                    <div class="form-group">
                        <label for="amount">Amount:</label>
                        <input type="number" class="form-control" id="amount" name="amount">
                    </div>
                    <div class="form-group">
                        <label for="description">Description:</label>
                        <textarea class="form-control" id="description" name="description"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
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



</body>

</html>
