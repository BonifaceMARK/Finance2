<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link collapsed " href="{{route('display')}}">
          <i class="bi bi-grid"></i>
          <span>Forecast</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav"   href="{{route('budget.create')}}">
            <i class="bi bi-lightbulb"></i><span>Allocate Budget</span>
        </a>
      </li><!-- End Components Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav"   href="{{route('reports.create')}}">
            <i class="bi bi-lightbulb"></i><span>Create ExpenseReport</span>
        </a>
      </li><!-- End Components Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav"   href="{{route('expenses.create')}}">
            <i class="bi bi-lightbulb"></i><span>Create Expenses</span>
        </a>
      </li><!-- End Components Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav"   href="{{route('expense-categories.create')}}">
            <i class="bi bi-lightbulb"></i><span>Add ExpensesCategories</span>
        </a>
      </li><!-- End Components Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav"   href="{{route('cost_management.create')}}">
            <i class="bi bi-lightbulb"></i><span>Add CostAllocation</span>
        </a>
      </li><!-- End Components Nav -->



    </ul>

  </aside><!-- End Sidebar-->
