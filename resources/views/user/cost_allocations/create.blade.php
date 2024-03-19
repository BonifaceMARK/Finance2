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
            <div class="container">
                <div class="row">

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
<!-- End Cost Allocated Card -->


                    <!-- First Card -->
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                Allocate Cost
                            </div>
                            <div class="card-body">

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

                    <div class="col-md-6">
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


                </div>
            </div>
        </section>

        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            Cost Allocation
                        </div>

                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Cost Center</th>
                                        <th>Cost Category</th>
                                        <th>Allocation Method</th>
                                        <th>Amount</th>
                                        <th>Description</th>
                                        <th>Action</th>
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
                                                <a class="btn btn-primary btn-sm" href="{{ route('cost_allocations.show', $costAllocation->id) }}">Show</a>
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
