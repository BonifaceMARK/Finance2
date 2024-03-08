
@extends('layout.title')

@section('title', 'Employee Dashboard')
@include('layout.title')
<body>

  <!-- ======= Header ======= -->
@include('layout.header')


  <!-- ======= Sidebar ======= -->
 @include('Employee.sidebar')

  <main id="main" class="main">

    <section class="section dashboard">
      <div class="row">

        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">Create Budget Plan</div>

                        <div class="card-body">
                            <form action="{{ route('budget-plans.store') }}" method="POST">
                                @csrf

                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" id="title" name="title" class="form-control" value="{{ old('title') }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea id="description" name="description" class="form-control" rows="4">{{ old('description') }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="total_amount">Total Amount</label>
                                    <input type="number" id="total_amount" name="total_amount" class="form-control" value="{{ old('total_amount') }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="start_date">Start Date</label>
                                    <input type="date" id="start_date" name="start_date" class="form-control" value="{{ old('start_date') }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="end_date">End Date</label>
                                    <input type="date" id="end_date" name="end_date" class="form-control" value="{{ old('end_date') }}" required>
                                </div>

                                <button type="submit" class="btn btn-primary">Create Budget Plan</button>
                                <a href="{{ route('budget-plans.index') }}" class="btn btn-secondary">Cancel</a>
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
