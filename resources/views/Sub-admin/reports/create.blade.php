
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

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Create Report</div>

                        <div class="card-body">
                            <form method="POST" action="{{ route('reports.store') }}">
                                @csrf

                                <div class="form-group row">
                                    <label for="category" class="col-md-4 col-form-label text-md-right">Category</label>

                                    <div class="col-md-6">
                                        <input id="category" type="text" class="form-control @error('category') is-invalid @enderror" name="category" value="{{ old('category') }}" required autofocus>

                                        @error('category')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="expense" class="col-md-4 col-form-label text-md-right">Expense</label>

                                    <div class="col-md-6">
                                        <input id="expense" type="number" class="form-control @error('expense') is-invalid @enderror" name="expense" value="{{ old('expense') }}" required>

                                        @error('expense')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="date" class="col-md-4 col-form-label text-md-right">Date</label>

                                    <div class="col-md-6">
                                        <input id="date" type="date" class="form-control @error('date') is-invalid @enderror" name="date" value="{{ old('date') }}" required>

                                        @error('date')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            Create
                                        </button>
                                        <a href="{{ route('reports.index') }}" class="btn btn-secondary">
                                            Cancel
                                        </a>
                                    </div>
                                </div>
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
