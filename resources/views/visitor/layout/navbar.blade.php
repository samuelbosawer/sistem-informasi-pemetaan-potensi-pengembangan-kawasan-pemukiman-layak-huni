  <!--Navbar Start-->
  @if (Request::segment(1) == null)
        <nav class="navbar navbar-expand-lg fixed-top sticky custom-nav" style="">
 @else
       <nav class="navbar navbar-expand-lg fixed-top sticky bg-light p-3 shadow">
  @endif
  <div class="container">
      <!-- LOGO -->
      <a class="logo navbar-brand" href="/">
          @if (Request::segment(1) == null)
              <img src="assets/images/logo.png" alt="" class="img-fluid logo-light">
              <img src="assets/images/logo-dark.png" alt="" class="img-fluid logo-dark">
          @else
              <img src="assets/images/logo-dark.png" alt="" class="img-fluid">
          @endif

      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
          aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <i class="mdi mdi-menu"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
          <ul class="navbar-nav ms-auto navbar-center   " id="mySidenav">
              <li class="nav-item @if (Request::segment(1) == null) active @endif">
                  <a href="/" class="nav-link">Beranda</a>
              </li>
              <li class="nav-item @if (Request::segment(1) == 'swot') active @endif">
                  <a href="{{ route('swot') }}" class="nav-link  @if (Request::segment(1) == 'swot') text-success fw-bold  @endif">SWOT</a>
              </li>
              <li class="nav-item @if (Request::segment(1) == 'topsis') active @endif">
                  <a href="{{ route('topsis') }}" class="nav-link @if (Request::segment(1) == 'topsis') text-success fw-bold  @endif">Topsis</a>
              </li>
              <li class="nav-item  @if (Request::segment(1) == 'rekomendasi') active @endif">
                  <a href="{{ route('rekomendasi') }}" class="nav-link @if (Request::segment(1) == 'rekomendasi') text-success fw-bold  @endif">Rekomendasi</a>
              </li>
              <li class="nav-item @if (Request::segment(1) == 'tentang') active @endif">
                  <a href="{{ route('tentang') }}" class="nav-link @if (Request::segment(1) == 'tentang') text-success fw-bold  @endif">Tentang</a>
              </li>
              <li class="nav-item @if (Request::segment(1) == 'kontak') active @endif">
                  <a href="{{ route('kontak') }}" class="nav-link @if (Request::segment(1) == 'kontak') text-success fw-bold  @endif">Kontak</a>
              </li>

              @if (!Auth::user())
                  <li class="nav-item">
                      <a href="{{ route('login') }}" class="nav-link">Login</a>
                  </li>

                  <li class="nav-item">
                      <a href="{{ route('daftar') }}" class="nav-link">Buat Akun</a>
                  </li>
              @else
                  <li class="nav-item">
                      <a href="{{ route('dashboard.home') }}" class="nav-link">Dashboard</a>
                  </li>

                  <li class="nav-item">
                      <a href="{{ route('logout') }}"class="nav-link"
                          onclick="event.preventDefault();
                              document.getElementById('logout-form').submit();">Logout</a>
                  </li>

                  <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                      @csrf
                  </form>
              @endif


          </ul>
      </div>
  </div>
  </nav>
  <!-- Navbar End -->
