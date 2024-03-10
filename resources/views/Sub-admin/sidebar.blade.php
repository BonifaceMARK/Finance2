<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link collapsed " href="{{route('display')}}">
            <i class="bi bi-graph-up"></i>
          <span>Forecast</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#exp-nav" data-bs-toggle="collapse"  href="#">
            <i class="bi bi-wallet2"></i><span>Expense Management</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="exp-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
            <li>
                <a href="{{route('expense-categories.create')}}">
                  <span>Category</span>
                </a>
              </li>
            <li>
                <a href="{{route('expenses.create')}}">
                  <span>Expenses</span>
                </a>
              </li>
              <li>
                <a href="{{route('reports.create')}}">
                    <span>Reports</span>
                </a>
              </li>
            </ul>
      </li><!-- End Components Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#bud-nav" href="{{route('budget.create')}}">
            <i class="bi bi-lightbulb"></i><span>Allocate Budget</span>
        </a>
      </li><!-- End Components Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav"   href="{{route('budget-plans.create')}}">
            <i class="bi bi-lightbulb"></i><span>Budget Plan</span>
        </a>
      </li><!-- End Components Nav -->


      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav"   href="{{route('cost_allocations.create')}}">
            <i class="bi bi-lightbulb"></i><span>Allocate Cost</span>
        </a>
      </li><!-- End Components Nav -->



    </ul>

  </aside><!-- End Sidebar-->
