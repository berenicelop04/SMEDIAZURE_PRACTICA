<aside class="sidebar-left border-right bg-white shadow" id="leftSidebar" data-simplebar>
  <a href="#" class="btn collapseSidebar toggle-btn d-lg-none text-muted ml-2 mt-3" data-toggle="toggle">
    <i class="fe fe-x"><span class="sr-only"></span></i>
  </a>
  <nav class="vertnav navbar navbar-light">
    <div class="w-100 mb-4 d-flex">
      <a class="navbar-brand mx-auto mt-2 flex-fill text-center" href="./index.html">
        <svg version="1.1" id="logo" class="navbar-brand-img brand-sm" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 120 120">
          <g>
            <polygon class="st0" points="78,105 15,105 24,87 87,87" />
            <polygon class="st0" points="96,69 33,69 42,51 105,51" />
            <polygon class="st0" points="78,33 15,33 24,15 87,15" />
          </g>
        </svg>
      </a>
    </div>
    <ul class="navbar-nav flex-fill w-100 mb-2">
        <li class="nav-item">
            <a class="nav-link pl-3" href="{{ route('dashboard') }}">
            <i class="fe fe-home fe-16"></i>
            <span class="ml-1 item-text">Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link pl-3" href="{{ route('municipios.index') }}">
            <i class="fe fe-map fe-16"></i>
            <span class="ml-1 item-text">Municipios</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link pl-3" href="{{ route('localidades.index') }}">
            <i class="fe fe-map fe-16"></i>
            <span class="ml-1 item-text">Localidades</span>
            </a>
        </li>
    </ul>
  </nav>
</aside>
