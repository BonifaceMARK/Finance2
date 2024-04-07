@extends('layout.title')

@section('title', 'Budget')
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
            <i class="bi bi-file-text"> Budgets</i>
            <div class="d-flex">
                <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#requestBudgetsModal">
                    View Budget Proposals
                </button>
                <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#createBudgetProposalModal">
                    Create Budget Proposal
                </button>
            </div>
        </h1>
    </div>


        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Budgets</a></li>
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
        <div class="container">

            <div class="card mb-3">
                <div class="row g-0">
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title"><i class="bi bi-geo"></i> <strong>Budgeting</strong></h5>
                            <p class="card-text">
                                Budgeting is the process of creating a detailed plan that outlines an organization's financial goals and objectives for a specific period, typically a fiscal year. It involves estimating future revenues and expenses, allocating resources, and setting targets to guide financial activities and decision-making.
                            </p>
                            <div class="col-xxl-4 col-md-6">
                                <div class="card info-card revenue-card">
                                    <div class="card-body">
                                        <h5 class="card-title">Budget Proposed<span> | This Month</span></h5>

                                        <div class="d-flex align-items-center">
                                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                <i class="bi bi-cash-coin"></i>
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
                        </div>
                    </div>
                    <div class="col-md-4">
                        <img src="{{ asset('assets/img/budget.jpg') }}" class="img-fluid rounded-start" alt="...">
                        <!-- Button to trigger modal -->
                        <br>
                        <br>

                    </div>
                </div>
            </div><!-- End Card with an image on left -->


<!-- Modal -->
<div class="modal fade" id="createBudgetProposalModal" tabindex="-1" role="dialog" aria-labelledby="createBudgetProposalModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createBudgetProposalModalLabel"><i class="bi bi-file-earmark-plus"></i> Create Budget Proposal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('request_budgets.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="title">Title:</label>
                        <input type="text" id="title" name="title" class="form-control" value="{{ old('title') }}">
                    </div>
                    <div class="form-group">
                        <label for="description">Description:</label>
                        <textarea id="description" name="description" class="form-control" rows="3">{{ old('description') }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="amount">Amount:</label>
                        <input type="number" id="amount" name="amount" class="form-control" step="0.01" value="{{ old('amount') }}">
                    </div>
                    <div class="form-group">
                        <label for="start_date">Start Date:</label>
                        <input type="date" id="start_date" name="start_date" class="form-control" value="{{ old('start_date') }}">
                    </div>
                    <div class="form-group">
                        <label for="end_date">End Date:</label>
                        <input type="date" id="end_date" name="end_date" class="form-control" value="{{ old('end_date') }}">
                        @error('end_date')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="status">Status:</label>
                        <input type="text" id="status" name="status" class="form-control readonly-input" value="Pending" readonly>
                    </div>

                    <button type="submit" class="btn btn-primary"><i class="bi bi-send"></i> Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>



<!-- Modal -->
<div class="modal fade" id="requestBudgetsModal" tabindex="-1" role="dialog" aria-labelledby="requestBudgetsModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="card-title" id="requestBudgetsModalLabel">Budget Proposals</h5>
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
                                                    <th>Title</th>
                                                    <th>Created</th>
                                                    <th>Description</th>
                                                    <th>Amount</th>
                                                    <th>Start Date</th>
                                                    <th>End Date</th>
                                                    <th>Status</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($requestBudgets as $requestBudget)
                                                <tr>
                                                    <td>{{ $requestBudget->title }}</td>
                                                    <td>{{ $requestBudget->created_at }}</td>
                                                    <td>{{ $requestBudget->description }}</td>
                                                    <td>${{ number_format($requestBudget->amount, 2) }}</td>
                                                    <td>{{ $requestBudget->start_date }}</td>
                                                    <td>{{ $requestBudget->end_date }}</td>
                                                    <td>
                                                        @if($requestBudget->status === 'pending')
                                                        <span class="badge bg-warning">{{ $requestBudget->status }}</span>
                                                        @else
                                                        <span class="badge bg-success">{{ $requestBudget->status }}</span>
                                                        @endif
                                                    </td>

                                                </tr>
                                                @empty
                                                <tr>
                                                    <td colspan="8">No budget requests found.</td>
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
        </div>
    </div>
</div>


    </section>

  </main><!-- End #main -->
@include('layout.footer')


</body>

</html>
