@extends('layout.title')

@section('title', 'Budget Manager')
@include('layout.title')

<body>

  <!-- ======= Header ======= -->
  @extends('user.header')
@include('user.header')

  <!-- ======= Sidebar ======= -->
@include('user.sidebar')

  <main id="main" class="main">

    <div class="pagetitle">
      <h1><i class="bi bi-file-text"></i> Budgets</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="#">Budgets</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">
        <div class="container">
            <div class="col-xxl-4 col-md-6">
                <div class="card info-card revenue-card">
                    <div class="card-body">
                        <h5 class="card-title">Budget <span>| This Month</span></h5>

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
            <div class="card mb-3">
                <div class="row g-0">
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title"><i class="bi bi-geo"></i> Budgeting</h5>
                            <p class="card-text">
                                Budgeting is the process of creating a detailed plan that outlines an organization's financial goals and objectives for a specific period, typically a fiscal year. It involves estimating future revenues and expenses, allocating resources, and setting targets to guide financial activities and decision-making.
                            </p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <img src="{{ asset('assets/img/budget.jpg') }}" class="img-fluid rounded-start" alt="...">
                    </div>
                </div>
            </div><!-- End Card with an image on left -->

            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">All Request Budgets</div>

                            <div class="card-body">


                                <div class="row">
                                    <div class="col">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Title</th>
                                                    <th>Created</th>
                                                    <th>Description</th>
                                                    <th>Amount</th>
                                                    <th>Start Date</th>
                                                    <th>End Date</th>
                                                    <th>Status</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($requestBudgets as $requestBudget)
                                                    <tr>
                                                        <td>{{ $requestBudget->
                                                        title }}</td>
                                                        <td>{{ $requestBudget->created_at }}</td>
                                                        <td>{{ $requestBudget->description }}</td>
                                                        <td>{{ $requestBudget->amount }}</td>
                                                        <td>{{ $requestBudget->start_date }}</td>
                                                        <td>{{ $requestBudget->end_date }}</td>
                                                        <td>
                                                            @if($requestBudget->status === 'Pending')
                                                                <span class="badge bg-danger">{{ $requestBudget->status }}</span>
                                                            @else
                                                                <span class="badge bg-success">{{ $requestBudget->status }}</span>
                                                            @endif
                                                        </td>

                                                        <td>
                                                            <a href="{{ route('request_budgets.show', $requestBudget->id) }}" class="btn btn-primary"><i class="bi bi-printer"></i></a>
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
                </div>
            </div>
        </div>
            </div>

            <section class="section dashboard">
                <div class="row">

                  <!-- Left side columns -->
                  <div class="col-lg-12">
                    <div class="row">

                      <!-- Default Tabs -->
                      <div class="card">
                        <div class="card-body">
                          <h5 class="card-title">Budget Proposal</h5>

                          <!-- Default Tabs -->
                          <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                              <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Create</button>
                            </li>
                            <li class="nav-item" role="presentation">
                              <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Upload</button>
                            </li>

                          </ul>
                          <div class="tab-content pt-2" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                              <!-- Insert the Blade template for Home tab here -->
                                  <!-- End Revenue Card -->
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header"><i class="bi bi-file-earmark-plus"></i> Create Budget Proposal</div>
                            @if(session('success'))
                            <div class="row">
                                <div class="col">
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                </div>
                            </div>
                        @endif
                            <div class="card-body">
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
            </div>
                            </div>
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="card-title">Upload Receipt</h5>
                                        </div>
                                        <div class="card-body">
                                            <form action="{{ route('upload.image') }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <div class="mb-3">
                                                    <label for="image" class="form-label">Please insert receipt:</label>
                                                    <input class="form-control" type="file" id="image" name="image">
                                                    @error('image')
                                                    <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <button type="submit" class="btn btn-primary">Upload</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                              <!-- Insert the Blade template for Contact tab here -->

                            </div>
                          </div><!-- End Default Tabs -->

                        </div>
                      </div><!-- End Default Tabs -->

                    </div>
                  </div><!-- End Left side columns -->

                  <!-- Right side columns -->
                  <div class="col-lg-4">
                    <!-- Insert content for the right side columns here -->
                  </div><!-- End Right side columns -->

                </div>
              </section>


      </div>
    </section>

  </main><!-- End #main -->
@include('layout.footer')


</body>

</html>
