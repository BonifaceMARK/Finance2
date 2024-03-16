
@extends('layout.title')

@section('title', 'Cost Allocation')
@include('layout.title')
<body>

  <!-- ======= Header ======= -->
@include('user.header')

  <!-- ======= Sidebar ======= -->
@include('user.sidebar')

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

            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                Edit Cost Allocation
                            </div>
                            <div class="card-body">
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <form action="{{ route('cost_allocations.update', $costAllocation->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <label for="cost_center">Cost Center:</label>
                                        <input type="text" class="form-control" id="cost_center" name="cost_center" value="{{ $costAllocation->cost_center }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="cost_category">Cost Category:</label>
                                        <input type="text" class="form-control" id="cost_category" name="cost_category" value="{{ $costAllocation->cost_category }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="allocation_method">Allocation Method:</label>
                                        <input type="text" class="form-control" id="allocation_method" name="allocation_method" value="{{ $costAllocation->allocation_method }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="amount">Amount:</label>
                                        <input type="number" class="form-control" id="amount" name="amount" value="{{ $costAllocation->amount }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Description:</label>
                                        <textarea class="form-control" id="description" name="description">{{ $costAllocation->description }}</textarea>
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