
@extends('layout.title')

@section('title', 'Expense Manager')
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
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">Edit Expense</div>

                            <div class="card-body">
                                <form action="{{ route('expenses.update', $expense->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <label for="date">Date:</label>
                                        <input type="date" id="date" name="date" class="form-control" value="{{ $expense->date }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="amount">Amount:</label>
                                        <input type="number" id="amount" name="amount" class="form-control" step="0.01" value="{{ $expense->amount }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="category">Category:</label>
                                        <input type="text" id="category" name="category" class="form-control" value="{{ $expense->category }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Description:</label>
                                        <textarea id="description" name="description" class="form-control" rows="3">{{ $expense->description }}</textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Update</button>
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
