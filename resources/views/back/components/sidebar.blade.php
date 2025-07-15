 <!-- Sidebar -->
 <div class="sidebar" data-background-color="dark">
    <div class="sidebar-logo">
      <!-- Logo Header -->
      <div class="logo-header" data-background-color="dark">
        <a href="{{route('dashboard')}}" class="logo text-white">
          <h1>eNNo</h1>
        </a>
        <div class="nav-toggle">
          <button class="btn btn-toggle toggle-sidebar">
            <i class="gg-menu-right"></i>
          </button>
          <button class="btn btn-toggle sidenav-toggler">
            <i class="gg-menu-left"></i>
          </button>
        </div>
        <button class="topbar-toggler more">
          <i class="gg-more-vertical-alt"></i>
        </button>
      </div>
      <!-- End Logo Header -->
    </div>
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
      <div class="sidebar-content">
        <ul class="nav nav-secondary">
          <li class="nav-item {{url()->current() == route('dashboard') ? 'active' : ''}}">
            <a href="{{route('dashboard')}}">
              <i class="fas fa-compass"></i>
              <p>Dashboard</p>
            </a>
          </li>
          <li class="nav-section">
            <span class="sidebar-mini-icon">
              <i class="fa fa-ellipsis-h"></i>
            </span>
            <h4 class="text-section">Data Master</h4>
          </li>
          <li class="nav-item {{url()->current() == route('mata_air') ? 'active' : ''}}">
            <a href="{{route('mata_air')}}">
              <i class="fas fa-eye"></i>
              <p>Data Sumber Mata Air</p>
            </a>
          </li>
          <li class="nav-item {{url()->current() == route('peta') ? 'active' : ''}}">
            <a href="{{route('peta')}}">
              <i class="fas fa-map-marked"></i>
              <p>Peta Sumber </p>
            </a>
          </li>
          
          <li class="nav-section">
            <span class="sidebar-mini-icon">
              <i class="fa fa-ellipsis-h"></i>
            </span>
            <h4 class="text-section">Pemantauan dan Pelaporan</h4>
          </li>
          <li class="nav-item {{url()->current() == route('pemantauan') ? 'active' : ''}}">
            <a href="{{route('pemantauan')}}">
              <i class="fas fa-search"></i>
              <p>Data Pemantauan</p>
            </a>
          </li>
          <li class="nav-item {{url()->current() == route('pelaporan') ? 'active' : ''}}">
            <a href="{{route('pelaporan')}}">
              <i class="fas fa-paste"></i>
              <p>Data Pelaporan</p>
            </a>
          </li>
          <li class="nav-section">
            <span class="sidebar-mini-icon">
              <i class="fa fa-ellipsis-h"></i>
            </span>
            <h4 class="text-section">Lainnya</h4>
          </li>
          <li class="nav-item {{url()->current() == route('pengguna') ? 'active' : ''}}">
            <a href="{{route('pengguna')}}">
              <i class="fas fa-users"></i>
              <p>Data Pengguna</p>
            </a>
          </li>
          <li class="nav-item">
            <a data-bs-toggle="collapse" href="#maps">
              <i class="fas fa-copy"></i>
              <p>Laporan</p>
              <span class="caret"></span>
            </a>
            <div class="collapse" id="maps">
              <ul class="nav nav-collapse">
                <li>
                  <a href="{{route('laporan.mata_air')}}">
                    <span class="sub-item">Laporan Mata Air</span>
                  </a>
                </li>
                <li>
                  <a href="{{route('laporan.pemantauan')}}">
                    <span class="sub-item">Laporan Pemantauan</span>
                  </a>
                </li>
                <li>
                  <a href="{{route('laporan.pelaporan')}}">
                    <span class="sub-item">Laporan Pelaporan</span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a href="{{route('logout')}}" class="a-confirm">
              <i class="fas fa-power-off"></i>
              <p>Logout</p>
            </a>
          </li>
          
        </ul>
      </div>
    </div>
  </div>
  <!-- End Sidebar -->
