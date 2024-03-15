<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{route('forecast')}}">
            <i class="bi bi-graph-up"></i>
          <span>Forecast</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav"   href="{{route('expenses.create')}}">
            <i class="bi bi-cash-stack"></i><span>Expense</span>
        </a>
      </li><!-- End Components Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav"   href="{{route('request_budgets.create')}}">
            <i class="bi bi-file-text"></i><span>Budget</span>
        </a>
      </li><!-- End Components Nav -->



      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav"   href="{{route('cost_allocations.create')}}">
            <i class="bi bi-coin"></i><span>Cost</span>
        </a>
      </li><!-- End Components Nav -->

    </ul>

  </aside><!-- End Sidebar-->
