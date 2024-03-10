<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link collapsed " href="{{route('adminDash')}}">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->



      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav"   href="{{route('images.create')}}">
            <i class="bi bi-lightbulb"></i><span>Create Receipt</span>
        </a>
      </li><!-- End Components Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav"   href="{{route('budget-proposals.create')}}">
            <i class="bi bi-lightbulb"></i><span>Budget Proposal</span>
        </a>
      </li><!-- End Components Nav -->


      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav"   href="{{route('FinancialReport')}}">
            <i class="bi bi-lightbulb"></i><span>Financial Report</span>
        </a>
      </li><!-- End Components Nav -->


    </ul>

  </aside><!-- End Sidebar-->
