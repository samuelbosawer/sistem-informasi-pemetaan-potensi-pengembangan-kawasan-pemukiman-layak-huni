
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>@yield('title', 'Sistem Informasi Pemetaan Potensi Pengembangan Kawasan Pemukiman Layak Huni')</title>
    <link rel="icon" type="image/x-icon" href="/src/assets/img/logo.svg"/>
    <link href="/layouts/semi-dark-menu/css/light/loader.css" rel="stylesheet" type="text/css" />
    <link href="/layouts/semi-dark-menu/css/dark/loader.css" rel="stylesheet" type="text/css" />
    <script src="/layouts/semi-dark-menu/loader.js"></script>

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="/src/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="/layouts/semi-dark-menu/css/light/plugins.css" rel="stylesheet" type="text/css" />
    <link href="/layouts/semi-dark-menu/css/dark/plugins.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    <link href="/src/plugins/src/apex/apexcharts.css" rel="stylesheet" type="text/css">
    <link href="/src/assets/css/light/dashboard/dash_1.css" rel="stylesheet" type="text/css" />
    <link href="/src/assets/css/dark/dashboard/dash_1.css" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->


    <link rel="stylesheet" href="/src/plugins/src/font-icons/fontawesome/css/regular.css">
    <link rel="stylesheet" href="/src/plugins/src/font-icons/fontawesome/css/fontawesome.css">
    <link href="/src/assets/css/light/scrollspyNav.css" rel="stylesheet" type="text/css">
    <link href="/src/assets/css/light/components/font-icons.css" rel="stylesheet" type="text/css">

    <link href="/src/assets/css/dark/scrollspyNav.css" rel="stylesheet" type="text/css">
    <link href="/src/assets/css/dark/components/font-icons.css" rel="stylesheet" type="text/css">

    @stack('script-header')

</head>
<body class="layout-boxed">
    @include('sweetalert::alert')
    <!-- BEGIN LOADER -->
    <div id="load_screen"> <div class="loader"> <div class="loader-content">
        <div class="spinner-grow align-self-center"></div>
    </div></div></div>
    <!--  END LOADER -->

    <!--  BEGIN NAVBAR  -->
    <div class="header-container container-xxl">
        <header class="header navbar navbar-expand-sm expand-header">

            <a href="javascript:void(0);" class="sidebarCollapse">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>
            </a>

            <ul class="navbar-item flex-row ms-lg-auto ms-0">

                <li class="nav-item theme-toggle-item">

                </li>



                <li class="nav-item dropdown user-profile-dropdown  order-lg-0 order-1">
                    <a href="javascript:void(0);" class="nav-link dropdown-toggle user" id="userProfileDropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="avatar-container">
                            <div class="avatar avatar-sm avatar-indicators avatar-online">
                                <img alt="avatar" src="/src/assets/img/profile-30.png" class="rounded-circle">
                            </div>
                        </div>
                    </a>

                    <div class="dropdown-menu position-absolute" aria-labelledby="userProfileDropdown">
                        <div class="user-profile-section">
                            <div class="media mx-auto">
                                <div class="emoji me-2">
                                    &#x1F44B;
                                </div>
                                <div class="media-body">
                                    <h5> {{Auth::user()->nama}} </h5>
                                    <p>Admin</p>
                                </div>
                            </div>
                        </div>
                        <div class="dropdown-item">
                            <a href="user-profile.html">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg> <span>Profile</span>
                            </a>
                        </div>

                        <div class="dropdown-item">
                            <a href="auth-boxed-signin.html">


                                <a class="" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                              document.getElementById('logout-form').submit();">

                              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-log-out"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg> <span>Log Out</span>
                             </a>

                             <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                 @csrf
                             </form>


                            </a>
                        </div>
                    </div>

                </li>
            </ul>
        </header>
    </div>
    <!--  END NAVBAR  -->

    <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container" id="container">

        <div class="overlay"></div>
        <div class="search-overlay"></div>


