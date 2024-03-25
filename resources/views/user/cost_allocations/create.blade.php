@extends('layout.title')

@section('title', 'Cost Allocation')
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
            <h1><i class="bi bi-coin"></i> Costs</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Costs</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="container">
                <div class="row">
                    <div class="card mb-3">
                        <div class="row g-0">
                          <div class="col-md-4">
                            <img src="{{asset('assets/img/allocated.jpg')}}" class="img-fluid rounded-start" alt="...">
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

                            </div>
                          </div>
                        </div>
                      </div><!-- End Card with an image on left -->




              <!-- Modal -->
<div class="modal fade" id="costAllocationModal" tabindex="-1" aria-labelledby="costAllocationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="costAllocationModalLabel">
                    <i class="bi bi-file-earmark-plus"></i> Allocate Cost

                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('cost_allocations.store') }}" method="POST">
                    @csrf
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
                        <label for="allocation_method">Allocation Method:</label>
                        <select class="form-control" id="allocation_method" name="allocation_method">
                            <option value="Straight-Line Method">Straight-Line Method</option>
                            <option value="Activity-Based Costing (ABC)">Activity-Based Costing (ABC)</option>
                            <option value="Step-Down Allocation">Step-Down Allocation</option>
                            <option value="Direct Allocation">Direct Allocation</option>
                            <option value="Absorption Costing">Absorption Costing</option>
                            <option value="Variable Costing">Variable Costing</option>
                            <option value="Overhead Rate Method">Overhead Rate Method</option>
                            <option value="Dual-Rate Overhead Allocation">Dual-Rate Overhead Allocation</option>
                            <option value="Reciprocal Allocation">Reciprocal Allocation</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="amount">Amount:</label>
                        <input type="number" class="form-control" id="amount" name="amount">
                    </div>
                    <div class="form-group">
                        <label for="description">Description:</label>
                        <textarea class="form-control" id="description" name="description" readonly></textarea>
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

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            Cost Allocation
                        </div>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#costAllocationModal">
                            Allocate Cost
                        </button>

                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="background-color: #87CEEB;">No</th>
                                        <th style="background-color: #87CEEB;">Cost Center</th>
                                        <th style="background-color: #87CEEB;">Cost Category</th>
                                        <th style="background-color: #87CEEB;">Allocation Method</th>
                                        <th style="background-color: #87CEEB;">Amount</th>
                                        <th style="background-color: #87CEEB;">Description</th>
                                        <th style="background-color: #87CEEB;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($costAllocations as $key => $costAllocation)
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td>{{ $costAllocation->cost_center }}</td>
                                        <td>{{ $costAllocation->cost_category }}</td>
                                        <td>{{ $costAllocation->allocation_method }}</td>
                                        <td>{{ $costAllocation->amount }}</td>
                                        <td>{{ $costAllocation->description }}</td>
                                        <td>
                                            <form action="{{ route('cost_allocations.destroy', $costAllocation->id) }}" method="POST">
                                                <a class="btn btn-primary btn-sm" href="{{ route('cost_allocations.show', $costAllocation->id) }}"><i class="bi bi-printer"></i>Print</a>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>





    </main><!-- End #main -->

    @include('layout.footer')

    <script>
        document.getElementById('allocation_method').addEventListener('change', function() {
            var method = this.value;
            var description = '';

            switch (method) {
                case 'Straight-Line Method':
                    description = 'Allocates an equal amount of cost to each accounting period.';
                    break;
                case 'Activity-Based Costing (ABC)':
                    description = 'Allocates costs based on the activities that drive them, providing more accurate cost information.';
                    break;
                case 'Step-Down Allocation':
                    description = 'Allocates costs sequentially from one service department to another, then to production departments.';
                    break;
                case 'Direct Allocation':
                    description = 'Allocates costs directly to a cost object without any intermediate allocation.';
                    break;
                case 'Absorption Costing':
                    description = 'Allocates all manufacturing costs to the product, including both fixed and variable costs.';
                    break;
                case 'Variable Costing':
                    description = 'Allocates only variable manufacturing costs to the product, treating fixed manufacturing costs as period expenses.';
                    break;
                case 'Overhead Rate Method':
                    description = 'Allocates overhead costs based on predetermined rates applied to specific cost drivers.';
                    break;
                case 'Dual-Rate Overhead Allocation':
                    description = 'Allocates overhead costs using two different rates for different cost pools.';
                    break;
                case 'Reciprocal Allocation':
                    description = 'Allocates reciprocal costs between service departments based on simultaneous equations.';
                    break;
                default:
                    description = '';
            }

            document.getElementById('description').value = description;
        });
    </script>

</body>

</html>
