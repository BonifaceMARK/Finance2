
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
                            <div class="card-header">Choose Cost Category</div>

                            <div class="card-body">
                                <form method="POST" action="{{ route('cost_categories.store') }}">
                                    @csrf

                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <select name="name" id="name" class="form-control" required>
                                            <option value="">Select Name</option>
                                            <option value="Direct Labor Costs">Direct Labor Costs</option>
                                            <option value="Indirect Labor Costs">Materials and Supplies</option>
                                            <option value="Overhead Costs">Overhead Costs</option>
                                            <option value="Utilities Expenses">Utilities Expenses</option>
                                            <option value="Rent and Lease Expenses">Rent and Lease Expenses</option>
                                            <option value="Depreciation and Amortization">Depreciation and Amortization</option>
                                            <option value="Marketing and Advertising Expenses">Marketing and Advertising Expenses</option>
                                            <option value="Administrative Expenses">Administrative Expenses</option>
                                            <option value="Travel and Entertainment Expenses">Travel and Entertainment Expenses</option>
                                            <option value="Travel and Entertainment Expenses">Insurance Costs</option>
                                            <option value="Taxes and Licenses">Taxes and Licenses</option>
                                            <option value="Research and Development Costs">Research and Development Costs</option>
                                            <option value="Equipment Maintenance Costs">Equipment Maintenance Costs</option>
                                            <option value="Professional Services Fees">Professional Services Fees</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea name="description" id="description" class="form-control" rows="3" required></textarea>
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

<script>
    // Define descriptions for each cost category
    var costCategoryDescriptions = {
        'Direct Labor Costs': 'Direct labor costs are wages paid to employees who are directly involved in the production of goods or delivery of services.',
        'Indirect Labor Costs': 'Indirect labor costs are wages paid to employees who are not directly involved in production, such as administrative staff and supervisors.',
        'Overhead Costs': 'Overhead costs are expenses incurred by a business that are not directly tied to a specific product or service, such as rent, utilities, and insurance.',
        'Utilities Expenses': 'Utilities expenses are the costs associated with the consumption of utilities such as electricity, water, and gas.',
        'Rent and Lease Expenses': 'Rent and lease expenses are the costs associated with renting or leasing office space, equipment, or other assets.',
        'Depreciation and Amortization': 'Depreciation and amortization expenses are the allocation of the cost of tangible and intangible assets over their useful lives.',
        'Marketing and Advertising Expenses': 'Marketing and advertising expenses are the costs associated with promoting and advertising products or services to customers.',
        'Administrative Expenses': 'Administrative expenses are the costs associated with running the day-to-day operations of a business, such as salaries for administrative staff and office supplies.',
        'Travel and Entertainment Expenses': 'Travel and entertainment expenses are the costs associated with business travel, meals, and entertainment for employees.',
        'Insurance Costs': 'Insurance costs are the expenses paid to insurance companies to protect against various risks, such as property damage, liability, and employee injuries.',
        'Taxes and Licenses': 'Taxes and licenses are the payments made to government authorities for various taxes and licenses required to operate a business.',
        'Research and Development Costs': 'Research and development costs are the expenses incurred by a business to develop new products or improve existing ones.',
        'Equipment Maintenance Costs': 'Equipment maintenance costs are the expenses associated with maintaining and repairing machinery, vehicles, and other equipment used in the business.',
        'Professional Services Fees': 'Professional services fees are payments made to external professionals, such as lawyers, accountants, and consultants, for their services.'
    };

    // Function to populate description based on selected option
    document.getElementById('name').addEventListener('change', function() {
        var selectedOption = this.value;
        var description = document.getElementById('description');

        // Populate description based on selected option
        if (costCategoryDescriptions[selectedOption]) {
            description.innerText = costCategoryDescriptions[selectedOption];
        } else {
            description.innerText = ''; // Reset description if not needed
        }
    });
</script>
</body>

</html>
