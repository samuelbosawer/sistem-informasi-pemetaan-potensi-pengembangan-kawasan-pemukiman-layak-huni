     <!--  BEGIN SIDEBAR  -->
     <div class="sidebar-wrapper sidebar-theme">

         <nav id="sidebar">

             <div class="navbar-nav theme-brand flex-row  text-center">
                 <div class="nav-logo">
                     <div class="nav-item theme-logo">
                         <a href="#">
                             <img hidden src="/src/assets/img/logo.svg" class="navbar-logo" alt="logo">
                             <img src="/src/assets/img/logo.svg" class="navbar-logo" alt="logo">
                         </a>
                     </div>
                     <div class="nav-item theme-text">
                         <a href="#" class="nav-link"> SIP4LH </a>
                     </div>
                 </div>
                 <div class="nav-item sidebar-toggle">
                     <div class="btn-toggle sidebarCollapse">
                         <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                             fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                             stroke-linejoin="round" class="feather feather-chevrons-left">
                             <polyline points="11 17 6 12 11 7"></polyline>
                             <polyline points="18 17 13 12 18 7"></polyline>
                         </svg>
                     </div>
                 </div>
             </div>

             <div class="shadow-bottom"></div>
             <ul class="list-unstyled menu-categories" id="accordionExample">
                 <ul class="list-unstyled menu-categories" id="accordionExample">
                     <li class="menu @if (Request::segment(1) == 'dashboard' && Request::segment(2) == null || Request::segment(2) == 'peta'  )  active @endif">
                         <a href="{{ route('dashboard.home') }}" aria-expanded="false" class="dropdown-toggle">
                             <div class="">
                                 <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                     viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                     stroke-linecap="round" stroke-linejoin="round" class="feather feather-map">
                                     <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                     <polyline points="9 22 9 12 15 12 15 22"></polyline>
                                 </svg>
                                 <span>Dashboard</span>
                             </div>
                         </a>
                     </li>


                     @if (Auth::user()->hasRole('admin'))
                         <li class="menu menu-heading">
                             <div class="heading"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                     viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                     stroke-linecap="round" stroke-linejoin="round" class="feather feather-minus">
                                     <line x1="5" y1="12" x2="19" y2="12"></line>
                                 </svg><span>DATA</span></div>
                         </li>

                         <li class="menu @if (Request::segment(2) == 'distrik' || Request::segment(3) == 'distrik') active @endif">
                             <a href="{{ route('dashboard.distrik') }}" aria-expanded="false" class="dropdown-toggle">
                                 <div class="">
                                     <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                         viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                         stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit">
                                         <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                         <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                     </svg>
                                     <span>Distrik</span>
                                 </div>
                             </a>
                         </li>

                         <li class="menu @if (Request::segment(2) == 'jenis-kriteria' || Request::segment(3) == 'jenis-kriteria') active @endif">
                             <a href="{{ route('dashboard.jenis-kriteria') }}" aria-expanded="false"
                                 class="dropdown-toggle">
                                 <div class="">
                                     <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                         viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                         stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit">
                                         <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                         <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                     </svg>
                                     <span>Jenis Kriteria</span>
                                 </div>
                             </a>
                         </li>



                         {{-- <li class="menu @if (Request::segment(2) == 'strategi' || Request::segment(3) == 'strategi') active @endif">
                             <a href="{{ route('dashboard.strategi') }}" aria-expanded="false" class="dropdown-toggle">
                                 <div class="">
                                     <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                         viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                         stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit">
                                         <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                         <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                     </svg>
                                     <span> Strategi </span>
                                 </div>
                             </a>
                         </li> --}}





                         <li class="menu menu-heading">
                             <div class="heading"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                                     height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                     stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                     class="feather feather-minus">
                                     <line x1="5" y1="12" x2="19" y2="12"></line>
                                 </svg><span>PERHITUNGAN</span></div>
                         </li>

                         <li class="menu @if (Request::segment(2) == 'swot' || Request::segment(3) == 'swot') active @endif">
                             <a href="{{ route('dashboard.swot') }}" aria-expanded="false" class="dropdown-toggle">
                                 <div class="">
                                     <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                         viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                         stroke-linecap="round" stroke-linejoin="round"
                                         class="feather feather-clipboard">
                                         <path
                                             d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2">
                                         </path>
                                         <rect x="8" y="2" width="8" height="4" rx="1"
                                             ry="1">
                                         </rect>
                                     </svg>
                                     <span> SWOT </span>
                                 </div>
                             </a>
                         </li>


                         <li class="menu @if (Request::segment(2) == 'topsis' || Request::segment(3) == 'topsis') active @endif">
                             <a href="{{ route('dashboard.topsis') }}" aria-expanded="false" class="dropdown-toggle">
                                 <div class="">
                                     <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                         viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                         stroke-linecap="round" stroke-linejoin="round"
                                         class="feather feather-clipboard">
                                         <path
                                             d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2">
                                         </path>
                                         <rect x="8" y="2" width="8" height="4" rx="1"
                                             ry="1">
                                         </rect>
                                     </svg>
                                     <span> Topsis </span>
                                 </div>
                             </a>
                         </li>


                         <li class="menu @if (Request::segment(2) == 'rekomendasi' || Request::segment(3) == 'rekomendasi') active @endif">
                             <a href="{{ route('dashboard.rekomendasi') }}" aria-expanded="false"
                                 class="dropdown-toggle">
                                 <div class="">
                                     <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                         viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                         stroke-linecap="round" stroke-linejoin="round"
                                         class="feather feather-clipboard">
                                         <path
                                             d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2">
                                         </path>
                                         <rect x="8" y="2" width="8" height="4" rx="1"
                                             ry="1">
                                         </rect>
                                     </svg>
                                     <span> Rekomendasi </span>
                                 </div>
                             </a>
                         </li>


                         <li class="menu @if (Request::segment(2) == 'periode' || Request::segment(3) == 'periode') active @endif">
                             <a href="{{ route('dashboard.periode') }}" aria-expanded="false"
                                 class="dropdown-toggle">
                                 <div class="">
                                     <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                         viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                         stroke-linecap="round" stroke-linejoin="round"
                                         class="feather feather-clipboard">
                                         <path
                                             d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2">
                                         </path>
                                         <rect x="8" y="2" width="8" height="4" rx="1"
                                             ry="1">
                                         </rect>
                                     </svg>
                                     <span> Periode Perhitungan </span>
                                 </div>
                             </a>
                         </li>


                         <li class="menu menu-heading">
                             <div class="heading"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                                     height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                     stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                     class="feather feather-minus">
                                     <line x1="5" y1="12" x2="19" y2="12"></line>
                                 </svg><span>LAPORAN</span></div>
                         </li>


                         <li class="menu @if (Request::segment(2) == 'keluhan' || Request::segment(3) == 'keluhan') active @endif">
                             <a href="{{ route('dashboard.keluhan') }}" aria-expanded="false"
                                 class="dropdown-toggle">
                                 <div class="">
                                     <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                         viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                         stroke-linecap="round" stroke-linejoin="round"
                                         class="feather feather-clipboard">
                                         <path
                                             d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2">
                                         </path>
                                         <rect x="8" y="2" width="8" height="4" rx="1"
                                             ry="1">
                                         </rect>
                                     </svg>
                                     <span> Keluhan </span>
                                 </div>
                             </a>
                         </li>
                     @endif


                     @if (Auth::user()->hasRole('investor'))
                         <li class="menu menu-heading">
                             <div class="heading"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                                     height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                     stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                     class="feather feather-minus">
                                     <line x1="5" y1="12" x2="19" y2="12"></line>
                                 </svg><span>DATA</span></div>
                         </li>

                         <li class="menu @if (Request::segment(2) == 'keluhan' || Request::segment(3) == 'keluhan') active @endif">
                             <a href="{{ route('dashboard.keluhan') }}" aria-expanded="false"
                                 class="dropdown-toggle">
                                 <div class="">
                                     <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                         viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                         stroke-linecap="round" stroke-linejoin="round"
                                         class="feather feather-clipboard">
                                         <path
                                             d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2">
                                         </path>
                                         <rect x="8" y="2" width="8" height="4" rx="1"
                                             ry="1">
                                         </rect>
                                     </svg>
                                     <span> Keluhan </span>
                                 </div>
                             </a>
                         </li>


                         <li class="menu @if (Request::segment(2) == 'rekomendasi' || Request::segment(3) == 'rekomendasi') active @endif">
                             <a href="{{ route('dashboard.rekomendasi') }}" aria-expanded="false"
                                 class="dropdown-toggle">
                                 <div class="">
                                     <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                         viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                         stroke-linecap="round" stroke-linejoin="round"
                                         class="feather feather-clipboard">
                                         <path
                                             d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2">
                                         </path>
                                         <rect x="8" y="2" width="8" height="4" rx="1"
                                             ry="1">
                                         </rect>
                                     </svg>
                                     <span> Rekomendasi </span>
                                 </div>
                             </a>
                         </li>
                     @endif
                     @if (Auth::user()->hasRole('kepalaBidang'))
                         <li class="menu menu-heading">
                             <div class="heading"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                                     height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                     stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                     class="feather feather-minus">
                                     <line x1="5" y1="12" x2="19" y2="12"></line>
                                 </svg><span>Laporan</span></div>
                         </li>

                         <li class="menu @if (Request::segment(2) == 'keluhan' || Request::segment(3) == 'keluhan') active @endif">
                             <a href="{{ route('dashboard.keluhan') }}" aria-expanded="false"
                                 class="dropdown-toggle">
                                 <div class="">
                                     <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                         viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                         stroke-linecap="round" stroke-linejoin="round"
                                         class="feather feather-clipboard">
                                         <path
                                             d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2">
                                         </path>
                                         <rect x="8" y="2" width="8" height="4" rx="1"
                                             ry="1">
                                         </rect>
                                     </svg>
                                     <span> Keluhan </span>
                                 </div>
                             </a>
                         </li>


                         <li class="menu @if (Request::segment(2) == 'rekomendasi' || Request::segment(3) == 'rekomendasi') active @endif">
                             <a href="{{ route('dashboard.rekomendasi') }}" aria-expanded="false"
                                 class="dropdown-toggle">
                                 <div class="">
                                     <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                         viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                         stroke-linecap="round" stroke-linejoin="round"
                                         class="feather feather-clipboard">
                                         <path
                                             d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2">
                                         </path>
                                         <rect x="8" y="2" width="8" height="4" rx="1"
                                             ry="1">
                                         </rect>
                                     </svg>
                                     <span> Rekomendasi </span>
                                 </div>
                             </a>
                         </li>
                     @endif











                     <li class="menu menu-heading">
                         <div class="heading"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                 viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                 stroke-linecap="round" stroke-linejoin="round" class="feather feather-minus">
                                 <line x1="5" y1="12" x2="19" y2="12"></line>
                             </svg><span>LOGOUT</span></div>
                     </li>

                     <li class="menu">


                         <a href="{{ route('logout') }}" aria-expanded="false" class="dropdown-toggle"
                             onclick="event.preventDefault();
                              document.getElementById('logout-form').submit();">
                             <div class="">
                                 <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                     viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                     stroke-linecap="round" stroke-linejoin="round" class="feather feather-log-out">
                                     <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                     <polyline points="16 17 21 12 16 7"></polyline>
                                     <line x1="21" y1="12" x2="9" y2="12"></line>
                                 </svg>
                                 <span>Log Out</span>
                             </div>
                         </a>
                     </li>

                     <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                         @csrf
                     </form>

                 </ul>


             </ul>

         </nav>

     </div>
     <!--  END SIDEBAR  -->
