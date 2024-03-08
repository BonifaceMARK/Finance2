
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

            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">Create New Cost Allocation Rule</div>

                            <div class="card-body">
                                <form method="POST" action="{{ route('costAllocationRules.store') }}">
                                    @csrf

                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" name="name" id="name" class="form-control" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea name="description" id="description" class="form-control"></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="allocation_method">Allocation Method</label>
                                        <select name="allocation_method" id="allocation_method" class="form-control" required>
                                            <option value="none"></option>
                                            <option value="Direct Allocation">Direct Allocation</option>
                                            <option value="Step-Down Allocation">Step-Down Allocation</option>
                                            <option value="Fixed Percentage Allocation">Fixed Percentage Allocation</option>
                                        </select>
                                    </div>

                                    <button type="submit" class="btn btn-primary">Create Cost Allocation Rule</button>
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
