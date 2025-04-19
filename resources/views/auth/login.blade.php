
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>Masuk </title>
    <link rel="icon" type="image/x-icon" href="/src/assets/img/logo.svg"/>
    <link href="/layouts/semi-dark-menu/css/light/loader.css" rel="stylesheet" type="text/css" />
    <link href="/layouts/semi-dark-menu/css/dark/loader.css" rel="stylesheet" type="text/css" />
    <script src="/layouts/semi-dark-menu/loader.js"></script>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="/src/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />

    <link href="/layouts/semi-dark-menu/css/light/plugins.css" rel="stylesheet" type="text/css" />
    <link href="/src/assets/css/light/authentication/auth-boxed.css" rel="stylesheet" type="text/css" />

    <link href="/layouts/semi-dark-menu/css/dark/plugins.css" rel="stylesheet" type="text/css" />
    <link href="/src/assets/css/dark/authentication/auth-boxed.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->

</head>
<body class="form">

    <!-- BEGIN LOADER -->
    <div id="load_screen"> <div class="loader"> <div class="loader-content">
        <div class="spinner-grow align-self-center"></div>
    </div></div></div>
    <!--  END LOADER -->

    <div class="auth-container d-flex">

        <div class="container mx-auto align-self-center">

            <div class="row">

                <div class="col-xxl-4 col-xl-5 col-lg-5 col-md-8 col-12 d-flex flex-column align-self-center mx-auto">
                    <div class="card mt-3 mb-3">
                        <div class="card-body">

                            <form method="POST" action="{{ route('login') }}">
                                @csrf

                            <div class="row">
                                <div class="col-md-12 mb-3 text-center">

                                    <h2 class="fw-bolder text-primary">Login</h2>
                                    <p>Masukkan email dan kata sandi Anda untuk dapat login</p>

                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Email</label>
                                        <input type="email" name="email" value="{{ old('email') }}" class="form-control">

                                        @error('email')
                                        <div class="text-danger">
                                                {{ $message }}
                                        </div>
                                    @enderror

                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-4">
                                        <label class="form-label">Password</label>
                                        <input type="password" name="password" class="form-control">

                                        @error('password')
                                        <div class="text-danger">
                                                {{ $message }}
                                        </div>
                                    @enderror

                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-3">
                                        <div class="form-check form-check-primary form-check-inline">
                                            <input class="form-check-input me-3" type="checkbox" id="form-check-default" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                            <label class="form-check-label" for="form-check-default">
                                              Ingat Saya
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="mb-4">
                                        <button class="btn btn-primary w-100">Masuk</button>
                                    </div>
                                </div>



                                <div class="col-12">
                                    <div class="text-center">
                                        <p class="mb-0">Belum Punya Akun ? <a href="/daftar" class="text-warning">Daftar</a></p>
                                    </div>
                                </div>

                            </div>
                          </form>

                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="/src/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->


</body>
</html>
