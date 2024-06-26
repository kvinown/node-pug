  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
{{--          <a href="#" class="d-block">{{\Illuminate\Support\Facades\Auth::user()->name  }}</a>--}}
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="{{route('fam-card')}}" class="nav-link">
              <p>
                Kartu Keluarga
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('citizen')}}" class="nav-link">
              <p>
                Penduduk
              </p>
            </a>
          </li><li class="nav-item">
            <a href="" class="nav-link">
              <p>
                User
              </p>
            </a>
          </li>
            <li class="nav-item">
                <form id="logoutForm" method="POST" action="">
                    @csrf


                </form>
            <a href="javascript:void(0)" class="nav-link" onclick="$('#logoutForm').submit()">
                <i class="nav-icon fa fa-sign-out"></i>
              <p>
                Logout
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
