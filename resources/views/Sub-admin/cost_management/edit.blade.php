
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
                    <div class="col-md-6 offset-md-3">
                        <div class="card">
                            <div class="container">
                                <h1>Edit Page</h1>

                                <h2>Edit Cost Center</h2>
                                <form action="{{ route('cost_management.update', $costCenter->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <label for="name">Name:</label>
                                        <input type="text" name="name" class="form-control" id="name" value="{{ $costCenter->name }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Description:</label>
                                        <textarea name="description" class="form-control" id="description">{{ $costCenter->description }}</textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>

                                <h2>Edit Cost Category</h2>
                                <form action="{{ route('cost_management.update', $costCategory->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <label for="name">Name:</label>
                                        <input type="text" name="name" class="form-control" id="name" value="{{ $costCategory->name }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Description:</label>
                                        <textarea name="description" class="form-control" id="description">{{ $costCategory->description }}</textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>

                                <h2>Edit Cost Allocation Rule</h2>
                                <form action="{{ route('cost_management.update', $costAllocationRule->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <label for="name">Name:</label>
                                        <input type="text" name="name" class="form-control" id="name" value="{{ $costAllocationRule->name }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Description:</label>
                                        <textarea name="description" class="form-control" id="description">{{ $costAllocationRule->description }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="allocation_method">Allocation Method:</label>
                                        <select name="allocation_method" class="form-control" id="allocation_method">
                                            <option value="percentage" @if($costAllocationRule->allocation_method === 'percentage') selected @endif>Percentage Allocation</option>
                                            <option value="activity_based" @if($costAllocationRule->allocation_method === 'activity_based') selected @endif>Activity-based Costing</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>

                                <h2>Edit Cost Entry</h2>
                                <form action="{{ route('cost_management.update', $costEntry->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <label for="cost_center_id">Cost Center:</label>
                                        <select name="cost_center_id" class="form-control" id="cost_center_id">
                                            @foreach($costCenters as $costCenter)
                                                <option value="{{ $costCenter->id }}" @if($costCenter->id === $costEntry->cost_center_id) selected @endif>{{ $costCenter->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="cost_category_id">Cost Category:</label>
                                        <select name="cost_category_id" class="form-control" id="cost_category_id">
                                            @foreach($costCategories as $costCategory)
                                                <option value="{{ $costCategory->id }}" @if($costCategory->id === $costEntry->cost_category_id) selected @endif>{{ $costCategory->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="amount">Amount:</label>
                                        <input type="number" name="amount" class="form-control" id="amount" value="{{ $costEntry->amount }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="date">Date:</label>
                                        <input type="date" name="date" class="form-control" id="date" value="{{ $costEntry->date }}">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>

                                <h2>Edit Cost Allocation</h2>
                                <form action="{{ route('cost_management.update', $costAllocation->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <label for="source_cost_center_id">Source Cost Center:</label>
                                        <select name="source_cost_center_id" class="form-control" id="source_cost_center_id">
                                            @foreach($costCenters as $costCenter)
                                                <option value="{{ $costCenter->id }}" @if($costCenter->id === $costAllocation->source_cost_center_id) selected @endif>{{ $costCenter->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="destination_cost_center_id">Destination Cost Center:</label>
                                        <select name="destination_cost_center_id" class="form-control" id="destination_cost_center_id">
                                            @foreach($costCenters as $costCenter)
                                                <option value="{{ $costCenter->id }}" @if($costCenter->id === $costAllocation->destination_cost_center_id) selected @endif>{{ $costCenter->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="cost_category_id">Cost Category:</label>
                                        <select name="cost_category_id" class="form-control" id="cost_category_id">
                                            @foreach($costCategories as $costCategory)
                                                <option value="{{ $costCategory->id }}" @if($costCategory->id === $costAllocation->cost_category_id) selected @endif>{{ $costCategory->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="amount">Amount:</label>
                                        <input type="number" name="amount" class="form-control" id="amount" value="{{ $costAllocation->amount }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="date">Date:</label>
                                        <input type="date" name="date" class="form-control" id="date" value="{{ $costAllocation->date }}">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            </div>
      </div>
    </section>

  </main><!-- End #main -->
@include('layout.footer')

</body>

</html>
