
  <header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

      <a href="index.html" class="logo d-flex align-items-center me-auto">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="{{asset('/')}}front/img/logo.png" alt=""> -->
        <h1 class="sitename">eNno</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="{{route('home')}}" {!!url()->current() == route('home') ? 'class="active"' : ''!!}>Home</a></li>
          <li><a href="{{route('peta')}}" {!!url()->current() == route('peta') ? 'class="active"' : '' !!}>Peta</a></li>
          <li><a href="{{route('lapor')}}" {!!url()->current() == route('lapor') ? 'class="active"' : '' !!}>Lapor</a></li>
          {{-- <li><a href="#portfolio">Portfolio</a></li>
          <li><a href="#team">Team</a></li>
          <li class="dropdown"><a href="#"><span>Dropdown</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
              <li><a href="#">Dropdown 1</a></li>
              <li class="dropdown"><a href="#"><span>Deep Dropdown</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                <ul>
                  <li><a href="#">Deep Dropdown 1</a></li>
                  <li><a href="#">Deep Dropdown 2</a></li>
                  <li><a href="#">Deep Dropdown 3</a></li>
                  <li><a href="#">Deep Dropdown 4</a></li>
                  <li><a href="#">Deep Dropdown 5</a></li>
                </ul>
              </li>
              <li><a href="#">Dropdown 2</a></li>
              <li><a href="#">Dropdown 3</a></li>
              <li><a href="#">Dropdown 4</a></li>
            </ul>
          </li> --}}
          {{-- <li><a href="#contact">Contact</a></li> --}}
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

      @if (auth()->check())
      <a class="btn-getstarted" href="{{route('dashboard')}}">Dashboard</a>
      @else
      <a class="btn-getstarted" href="{{route('login')}}">Masuk</a>
      @endif
      

    </div>
  </header>