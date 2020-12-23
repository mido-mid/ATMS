<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
    <title>ATMS</title>

   <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/all.css') }}" rel="stylesheet">
    <link href="{{ asset('css/normalize.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<body>
<!--Modals-->

                <!--Login Modal-->

                <div class="modal fade" id="LoginModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div>
                        <h1 id="exampleModalLabel">Welcome Back</h1>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                        <form>
                            <div class="form-group">
                                <div class="col-sm-10">
                                  <input type="email"  class="form-control form-control-lg @error('email') is-invalid @enderror" name="email" placeholder="Email">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-10">
                                    <input id="password" type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group text-center">
                                <button class="tableButton">Login</button><a href="#">Forgot password ?</a>
                            </div>
                        </form>
                      <div class="text-center">
                        <label>Don't have an account &nbsp;</label><a data-toggle="modal" data-target="#LoginModal">SignUp</a>
                      </div>
                    </div>
                  </div>
                </div>

                <!--/Login Modal-->

                <!--SignUp Modal-->

                <div class="modal fade" id="SignUpModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div>
                            <h1 id="exampleModalLabel">SignUp</h1>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                            <form method="POST" action="{{ route('login') }}">
                                <div class="form-group">
                                    <div class="col-sm-10">
                                      <input type="text" name="name" class="form-control form-control-lg"  placeholder="Full Name">

                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-10">
                                      <input type="email" class="form-control form-control-lg"  placeholder="Email">

                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-10">
                                      <input type="password" class="form-control form-control-lg"  placeholder="Password">

                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-10">
                                      <input type="password" class="form-control form-control-lg"  placeholder="Confirm Password">

                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="dropdown col-sm-10 ">
                                        <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Department</button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item" href="#">SE</a>
                                            <a class="dropdown-item" href="#">CS</a>
                                            <a class="dropdown-item" href="#">IT</a>
                                            <a class="dropdown-item" href="#">IS</a>
                                            <a class="dropdown-item" href="#">BIO</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-10">
                                        Birthdate: <input type="date">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-10">
                                      Profile Picture:<input type="file" class="form-control form-control-lg mx-auto" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-10">
                                        <i class="fa fa-phone fa-lg"></i><input type="tel" class="form-control form-control-lg"  placeholder="Phone">
                                    </div>
                                </div>
                                <div class="form-group text-center">
                                    <button class="tableButton">SignUp</button>
                                </div>
                            </form>
                          <div class="text-center">
                            <label>Already have an account &nbsp;</label><a data-toggle="modal" data-target="#LoginModal">Login</a>
                          </div>
                        </div>
                      </div>
                    </div>

                <!--/SignUp Modal-->

<!--/Modals-->
<!--Header-->

    <div id="landing-header">
        <div class="container">
            <img class="logo " src="images/ATMS.svg" >
            <div class="row">
                <div class="col-5 text-white landingleft">
                    <h3>Attendance Monitoring Made Easy</h3>
                    <h6>Manage your Working hours easily and efficiently</h6>
{{--                    <button id="login" class="landing-button" data-toggle="modal" data-target="#LoginModal">Login</button>--}}
{{--                    <button id="signup" class="landing-button" data-toggle="modal" data-target="#SignUpModal">SignUp</button>--}}

                    <button id="login" class="landing-button"><a id="login" href="{{ route('login') }}">Login</a></button>
                    <button id="signup" class="landing-button"><a id="signup" href="{{ route('register') }}" >sign up</a></button>
                </div>
                <img class="col-7" src="images/Ilustration 1.svg">
            </div>
        </div>
    </div>

<!--/Header-->

<!--PageContent-->



    <div class="container">
        <h3 class="text-center font-weight-normal mb-0 ">What will you get</h3><br>
        <p class="text-center">Get an easy to use Attendance monitoring service at your workplace</p>
        <div class="row pt-5">
            <div class="col-5 left-content">
                <ul class="list-unstyled">
                  <li class="media pt-5">
                    <img src="images/landing0.png" class="mr-3" alt="...">
                    <div class="media-body">
                      <h5 class="mt-0 mb-1">Attendance reports</h5>
                    Get detailed reports about all employees attendance in a specified time
                    </div>
                  </li>
                  <li class="media my-4 pt-5">
                    <img src="images/landing1.png" class="mr-3" alt="...">
                    <div class="media-body">
                      <h5 class="mt-0 mb-1">Currently Available Empoyees</h5>
                    Know which employees are currently at the workplace at any time
                    </div>
                  </li>
                  <li class="media pt-5">
                    <img src="images/landing2.png" class="mr-3" alt="...">
                    <div class="media-body">
                      <h5 class="mt-0 mb-1">Notifications for absence requests</h5>
                    Receive and respond to absence requests as you work easily without any paper work
                    </div>
                  </li>
                </ul>
            </div>
            <img  class="col-7 float-right" src="images/Ilustration 2.svg">
        </div>
    </div>

<!--/PageContent-->

<!--Footer-->

     <div class="footer">
        <div class="container text-white">
        <div class="row">
        <div class="col-2">
        <span>Contact Us</span>
         <img src="images/barcode.svg">
        </div>
        <div class="col-2">
        <span>+201007152472</span>
        <span>ATMS@Mail.com</span>
        </div>
        <div class="col-4 offset-4">
        <span class="d-block">&copy; ATMS 2020 &nbsp;&nbsp;<i class="fab fa-instagram fa-lg"></i>&nbsp;&nbsp;<i class="fab fa-twitter fa-lg"></i>&nbsp;&nbsp;<i class="fab fa-facebook fa-lg"></i></span>
        <img class="logo" src="images/ATMS.svg" >
        <span class="d-block">Terms of Service | Privacy Policy</span>
        </div>
        </div>
        </div>
    </div>

<!--/Footer-->

<!--ScriptIncludes-->

    <script src="{{ asset('js/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/script.js') }}"></script>
</body>
</html>
