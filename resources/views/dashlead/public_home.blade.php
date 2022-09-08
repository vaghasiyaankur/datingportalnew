<!-- Developed By CBS -->
    <!DOCTYPE html>
    <html class="no-js" lang="en">
        <head>
            <!--Site charset-->
            <meta charset="utf-8">
            <!--Site title-->
            <title>Dating Portalen</title>
            <!--Meta-->
            <meta name="description" content="Premium landing page for Lovers">
            <meta name="author" content="Seventh Queen">
            <!--Favicons-->
            <link rel="shortcut icon" href="{{ asset('dashlead/startup-page/images/dp-fav.png') }}">
            <!-- CSS File -->
                <!--Set the viewport width to device width for mobile-->
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <!--Foundation Framework-->
                <link rel="stylesheet" href="{{ asset('dashlead/startup-page/styles/foundation.min.css') }}">
                <!--Plugins-->
                <link rel="stylesheet" href="{{ asset('dashlead/startup-page/styles/font-awesome.min.css') }}">
                <!--Main Stylesheet (change this to modify template)-->
                <link rel="stylesheet" href="{{ asset('dashlead/startup-page/styles/app.css') }}">
                <link rel="stylesheet" href="{{ asset('dashlead/startup-page/styles/updates.css') }}">
                <link rel="stylesheet" href="{{ asset('dashlead/startup-page/styles/custom.css') }}">
                <!--Google Fonts-->
                <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400italic,600,600italic,700,700italic" rel='stylesheet' type='text/css'>
                <link href="https://fonts.googleapis.com/css?family=Yesteryear" rel='stylesheet' type='text/css'>
                <!-- jQuery & Foundation Framework -->
                <script type="text/javascript" src="{{ asset('dashlead/startup-page/scripts/modernizr.foundation.js') }}"></script>
            <!-- CSS File -->
            <style>
                .alert-success {
                    background: #229522;
                    color: #fff;
                    padding: 10px;
                    text-align: center;
                    font-size: 16px;
                }
                .alert-error {
                    background: #ff4141;
                    color: #fff;
                    padding: 10px;
                    text-align: center;
                    font-size: 16px;
                }
            </style>
        </head>
        <body>
            <!-- Page-->
                <div class="page wide-style">
                    <!--END HEADER SECTION-->
                        <header>
                            @if(Session::has('message'))
                            <div class="alert alert-{{ Session::get('alert-type') }} alert-dismissible fade show">
                                <strong>{{ ucfirst(Session::get('status')) }}</strong>{{ Session::get('message') }}
                            </div>
                            @endif
                            <div class="header-bg">
                                <div id="header">
                                                                   
                                
                                    <div class="row">

                                        <div class="five columns push-five" style="padding-top: 20px;">
                                        </div>
                                        <div class="three columns pull-five" style="padding-top: 20px;">
                                                <a href="{{ route('public.home') }}">
                                                    <img src="{{ asset('dashlead/img/logo/logo-light.png')}}" alt="Datingportalen">
                                                </a>
                                        </div>
                                        <div class="four columns login-buttons" style="padding-top: 20px;">
                                            <ul class="button-group radius right">
                                                <li><a href="#" data-reveal-id="login_panel" class="small secondary button radius"><i class="icon-user hide-for-medium-down"></i> LOG PÅ</a></li>
                                            </ul>
                                        </div>

                                        <div class="twelve columns">
                                            <div class="row">
                                                <div class="five columns form-wrapper">
                                                    <div class="form-header">
                                                    </div>
                                                    <form action="{{route('signup.second')}}" method="POST"  class="custom form-search">
                                                        @csrf
                                                        <div class="row">
                                                            <div class="five mobile-four columns">
                                                                <label class="right inline">FORNAVN :</label>
                                                            </div>

                                                            <div class="seven mobile-four columns">
                                                                <input type="text" value="{{old('firstName')}}" id="firstname" name="firstName" class="inputbox" placeholder="Indtast dit fornavn her">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="five mobile-four columns">
                                                                <label class="right inline">EFTERNAVN :</label>
                                                            </div>

                                                            <div class="seven mobile-four columns">
                                                                <input value="{{old('lastName')}}" type="text" id="lastname" name="lastName" class="inputbox" placeholder="Indtast dit efternavn her">
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="row">
                                                            <div class="five mobile-four columns">
                                                                <label class="right inline">EMAIL :</label>
                                                            </div>

                                                            <div class="seven mobile-four columns">
                                                                <input value="{{old('email')}}" type="email" id="email" name="email" class="inputbox" placeholder="Indtast dit e-mail her">
                                                                @if ($errors->has('email'))
                                                                <span class=" text-danger" role="alert">
                                                                <strong>{{ $errors->first('email') }}</strong>
                                                                </span>
                                                                @endif
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="five mobile-four columns">
                                                                <label class="right inline">ADGANGSKODE :</label>
                                                            </div>

                                                            <div class="seven mobile-four columns">
                                                                <input type="password" id="password" name="password" class="inputbox" placeholder="Vælg din adgangskode her">
                                                                @if ($errors->has('password'))
                                                                <span class=" text-danger" role="alert">
                                                                <strong>{{ $errors->first('password') }}</strong>
                                                                </span>
                                                                @endif
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="five mobile-four columns">
                                                                <label class="right inline">Fødselsdag :</label>
                                                            </div>

                                                            <div class="seven mobile-four columns">
                                                            <input class="inputbox" type="date" placeholder="Fødselsdag" name="dob" value="">
                                                                @if ($errors->has('dob'))
                                                                <span class=" text-danger" role="alert">
                                                                <strong>{{ $errors->first('dob') }}</strong>
                                                                </span>
                                                                @endif
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="five mobile-four columns">
                                                                <label class="right inline">KØN :</label>
                                                            </div>

                                                            <div class="seven mobile-four columns">
                                                                <select class="expand" name="sex">
                                                                <option value="" selected disabled>--VÆLG--</option>
                                                                    <option>MAND</option>
                                                                    <option>KVINDE</option>
                                                                    <option>PAR</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="row">
                                                            <div class="five mobile-four columns">
                                                                <label class="right inline">Jeg søger :</label>
                                                            </div>

                                                            <div class="seven mobile-four columns">
                                                                <select class="expand" name="seek">
                                                                <option value="" selected disabled>--VÆLG--</option>
                                                                    <option value="Sexpartner">Sexpartner</option>
                                                                    <option value="Kæreste">Kæreste</option>
                                                                    <option value="Venner">Venner</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="five mobile-four columns">
                                                                <label class="right inline">Jeg søger (køn) :</label>
                                                            </div>

                                                            <div class="seven mobile-four columns">
                                                                <select class="expand" name="seekg">
                                                                <option value="" selected disabled>--VÆLG--</option>
                                                                    <option value="Kvinder">Kvinder</option>
                                                                    <option value="Mand">Mænd</option>
                                                                    <option value="Par">Par</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="seven offset-by-five columns"><button class="button radius" style="width: 100%;">Næste </button></div>
                                                        </div>
                                                    </form>
                                                    <div class="form-footer red-bg">
                                                    </div>
                                                </div>
                                                <!--end form-wrapper-->
                                            </div>
                                            <!--end row-->
                                        </div>
                                        <!--end twelve-->
                                    </div>
                                </div>
                            </div>
                        </header>
                    <!--END HEADER SECTION-->

                    <!--END CALL TO ACTION SECTION-->
                        <section>
                            <div id="call-to-actions" class="silver-bg">
                                <div class="row map-bg">
                                    <div class="twelve columns">
                                        <h1 class="section-title">Hvorfor vælge <span class="pink-text">at blive medlem?</span></h1>
                                        <p class="lead">Da det ikke er unormalt at være på flere dating-platforme, har vi samlet de mest populære dating-former på een side, så du kun behøver at have een profil for at date på nettet hvad end du søger, og så endda billigere end andre datingsider.</p>
                                    </div>
                                    <ul class="no-bullet">
                                        <li class="four columns">
                                            <div class="circle">
                                                <span class="overlay"></span>
                                                <span class="read"><i class="icon-heart"></i></span>
                                                </a>
                                            </div>
                                            <h4>100 % danskejet virksomhed</h4>
                                            <p align=”justify”>Trods vores internationalt klingende .com adresse, er både idéen og folkene bag Datingportalen.com, helt dansk.</p>
                                        </li>
                                        <li class="four columns">
                                            <div class="circle">
                                                <span class="overlay"></span>
                                                <span class="read"><i class="icon-heart"></i></span>
                                                </a>
                                            </div>
                                            <h4>Merkøb er lig med rabat</h4>
                                            <p align=”justify”>Ja du læste rigtigt, vi har gjort så det er billigere for dig for hver portal du tilmelder dig, så vi lever både op til vores slogan “One site - fits all” og til at vi er billigere end vores konkurrenter. Se vores priser her.</p>
                                        </li>
                                        <li class="four columns">
                                            <div class="circle">
                                                <span class="overlay"></span>
                                                <span class="read"><i class="icon-heart"></i></span>
                                                </a>
                                            </div>
                                            <h4>Dynamisk side</h4>
                                            <p align=”justify”>Med det mener vi, at vi har nye funktioner undervejs allerede nu, og idéerne er mange til hvordan vi kan og vil forbedre siden i fremtiden, så vi håber du vil være med på vores rejse til at blive Danmarks bedste datingsite.</p>
                                        </li>
                                    </ul>

                                </div>
                            </div>
                        </section>
                    <!--END CALL TO ACTION SECTION-->

                    <!--END FOOTER SECTION-->
                        <footer>
                            <div id="footer">
                                <div class="row">
                                    <div class="six mobile-six columns text-left">
                                        <p style="font-weight: bold; color:white;">Copyright &copy; {{ now()->year }} Datingportalen. Alle Rettigheder Forbeholdes.</p>
                                    </div>
                                    <div class="six mobile-six columns text-right">
                                        <p style="font-weight: bold;">
                                            <a style="color:white;"href="{{ route('public.tos')}}">SERVICEVILKÅR</a> |
                                            <a style="color:white;"href="{{ route('public.pp')}}">PRIVATLIVSPOLITIK</a> |
                                            <a style="color:white;"href="{{ route('public.faq')}}">FAQ</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </footer>
                    <!--END FOOTER SECTION-->

                    <!-- POP-UP MODAL FORMS -->
                        <div id="login_panel" class="reveal-modal">
                            <div class="row">
                                <div class="twelve columns">
                                    <h5 class="pink-text"><i class="icon-user icon-large"></i> INDTIL DIN KONTO</h5>
                                </div>

                                <form class="clearfix" id="login-form" method="POST" action="{{ route('login') }}">
                                @csrf
                                    <div class="six columns">
                                        <input type="email" class=" mr-sm-2 form-control login-email-field {{ $errors->has('email') ? ' is-invalid' : '' }}" id="email" name="email" class="inputbox" placeholder="Indtast dit e-mail her"  value="{{ old('email') }}" required autofocus>
                                    </div>
                                    <div class="six columns">
                                        <input type="password" name="password" class="inputbox" placeholder="Vælg din adgangskode her" required>
                                    </div>
                                    <p class="twelve columns" align="justify">
                                        <small><i class="icon-lock"></i> Når du trykker på opret profil accepterer du vores <a href="http://datingportalen.com/terms_of_services">bruger- og handelsbetingelser.</a> Læs mere om hvordan vi behandler din data i vores <a href="http://datingportalen.com/privacy_policy">privatlivspolitik.</a> Når du har oprettet dig, så vi du modtage e-mail notifikationer fra os - disse kan du til enhver tid framelde.</small>
                                    </p>
                                    <div class="twelve columns">
                                        <button type="submit" id="login" name="submit" class="radius secondary button"><i class="icon-unlock"></i> &nbsp;LOG PÅ</button>
                                    </div>
                                    @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                    @if ($errors->has('email'))
                                    <span class="invalid-feedback text-white" role="alert" style="margin-left: 317px;">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </form>

                                <div class="twelve columns">
                                    <hr>
                                    <ul class="inline-list">
                                        <li><small><a href="{{ route('password.request') }}">GLEMT DIN ADGANGSKODE ?</a></small></li>
                                    </ul>
                                </div>

                            </div>
                            <!--end row-->
                            <a href="#" class="close-reveal-modal">×</a>
                        </div>
                        <div id="forgot_panel" class="reveal-modal">
                            <div class="row">
                                <div class="twelve columns">
                                    <h5 class="pink-text"><i class="icon-lightbulb icon-large"></i> GLEMT DIN ADGANGSKODE ?</h5>
                                </div>
                                <form id="forgot_form" name="forgot_form" method="post" class="clearfix">
                                    <div class="twelve columns">
                                        <input type="text" id="forgot-email" name="email" class="inputbox" placeholder="Indtast dit e-mail-adresse her">
                                        <button type="submit" id="recover" name="submit" class="radius secondary button">Send link til nulstilning af kodeord</button>
                                    </div>
                                </form>
                                <div class="twelve columns">
                                    <hr>
                                    <small><a href="{{ route('password.request') }}" data-reveal-id="login_panel" class="radius secondary label">AAH, VENT, JEG HUSKER NU !</a></small>
                                </div>
                            </div>
                            <!--end row-->
                            <a href="#" class="close-reveal-modal">×</a>
                        </div>
                    <!-- POP-UP MODAL FORMS -->
                </div>
            <!--end page-->

            <!-- JS File -->
                <!-- jQuery & Foundation Framework -->
                <script type="text/javascript" src="{{ asset('dashlead/startup-page/scripts/jquery.js') }}"></script>
                <script type="text/javascript" src="{{ asset('dashlead/startup-page/scripts/foundation.min.js') }}"></script>
                <!-- 3rd Plugins -->
                <!-- include carouFredSel plugin -->
                <script type="text/javascript" src="{{ asset('dashlead/startup-page/scripts/plugins/carouFredSel/jquery.carouFredSel-6.2.0-packed.js') }}"></script>
                <!-- optionally include helper for carouFredSel plugins -->
                <script type="text/javascript" src="{{ asset('dashlead/startup-page/scripts/plugins/carouFredSel/helper-plugins/jquery.mousewheel.min.js') }}"></script>
                <script type="text/javascript" src="{{ asset('dashlead/startup-page/scripts/plugins/carouFredSel/helper-plugins/jquery.touchSwipe.min.js') }}"></script>
                <script type="text/javascript" src="{{ asset('dashlead/startup-page/scripts/plugins/carouFredSel/helper-plugins/jquery.transit.min.js') }}"></script>
                <script type="text/javascript" src="{{ asset('dashlead/startup-page/scripts/plugins/carouFredSel/helper-plugins/jquery.ba-throttle-debounce.min.js') }}"></script>
                <script type="text/javascript" src="{{ asset('dashlead/startup-page/scripts/plugins/retina/retina.js') }}"></script>
                <script type="text/javascript" src="{{ asset('dashlead/startup-page/scripts/plugins/knob/jquery.knob.js') }}"></script>
                <script type="text/javascript" src="{{ asset('dashlead/startup-page/scripts/plugins/fittext/jquery.fittext.js') }}"></script>
                <script type="text/javascript" src="{{ asset('dashlead/startup-page/scripts/plugins/quovolver/jquery.quovolver.js') }}"></script>
                <script type="text/javascript" src="{{ asset('dashlead/startup-page/scripts/plugins/backgroundSize/jquery.backgroundSize.js') }}"></script>
                <script type="text/javascript" src="{{ asset('dashlead/startup-page/scripts/plugins/prettyPhoto/jquery.prettyPhoto.js') }}"></script>
                <script type="text/javascript" src="{{ asset('dashlead/startup-page/scripts/app.js') }}"></script>
            <!-- JS File -->
        </body>
    </html>
<!-- Developed By CBS -->
