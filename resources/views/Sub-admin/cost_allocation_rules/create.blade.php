
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
                                        <label for="allocation_method">Allocation Method</label>
                                        <select name="allocation_method" id="allocation_method" class="form-control" required>
                                            <option value="none"></option>
                                            <option value="Direct Allocation">Direct Allocation</option>
                                            <option value="Step-Down Allocation">Step-Down Allocation</option>
                                            <option value="Fixed Percentage Allocation">Fixed Percentage Allocation</option>
                                            <option value="Reciprocal Allocation">Reciprocal Allocation</option>
                                            <option value="Activity-Based Costing (ABC)">Activity-Based Costing (ABC)</option>
                                            <option value="Proportional Allocation">Proportional Allocation</option>
                                            <option value="Fixed vs. Variable Allocation">Fixed vs. Variable Allocation</option>
                                            <option value="Equal Allocation">Equal Allocation</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea name="description" id="description" class="form-control"></textarea>
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
  <script>
    // Define descriptions for each allocation method
    var allocationDescriptions = {
        'Direct Allocation': 'This method allocates costs directly to the cost objects without any intermediate steps.',
        'Step-Down Allocation': 'This method allocates costs to the primary cost object first, then to the secondary cost objects in subsequent steps.',
        'Fixed Percentage Allocation': 'This method allocates costs based on a fixed percentage for each cost object.',
        'Reciprocal Allocation': 'This method allocates costs reciprocally between interconnected cost objects.',
        'Activity-Based Costing (ABC)': 'This method allocates costs based on the activities that drive the costs.',
        'Proportional Allocation': 'This method allocates costs proportionally based on predefined criteria.',
        'Fixed vs. Variable Allocation': 'This method allocates fixed and variable costs separately based on cost behavior.',
        'Equal Allocation': 'This method allocates costs equally among the cost objects.'
    };

    // Function to populate description based on selected option
    document.getElementById('allocation_method').addEventListener('change', function() {
        var selectedOption = this.value;
        var description = document.getElementById('description');

        // Populate description based on selected option
        if (allocationDescriptions[selectedOption]) {
            description.innerText = allocationDescriptions[selectedOption];
        } else {
            description.innerText = ''; // Reset description if not needed
        }
    });
</script>
@include('layout.footer')

</body>

</html>
