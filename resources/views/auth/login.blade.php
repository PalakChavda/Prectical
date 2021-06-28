<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>{{env('APP_NAME')}}</title>
    <link rel="icon" type="image/x-icon" href="{{asset('storage/img/favicon.ico')}}" />
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="{{asset('bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/plugins.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/authentication/form-2.css')}}" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/forms/theme-checkbox-radio.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/forms/switches.css')}}">
    <link href="{{asset('plugins/notification/snackbar/snackbar.min.css')}}" rel="stylesheet" type="text/css" />
</head>

<body class="form">
    <div class="form-container outer login_frm">
        <div class="form-form">
            <div class="form-form-wrap">
                <div class="form-container">
                    <div class="form-content">
                        
                        <h1 class="mt-2">@lang('global.sign_in')</h1>

                        <form method="POST" action="{{ route('login') }}" class="text-left">
                            @csrf
                            <div class="form-group">
                                <div id="username-field" class="field-wrapper input">
                                    <label for="username">@lang("global.email")</label>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user">
                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="12" cy="7" r="4"></circle>
                                    </svg>
                                    <input id="email" type="email" placeholder="@lang('global.email')" class="form-control @error('email') is-invalid @enderror" name="email" required autocomplete="email" autofocus>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div id="password-field" class="field-wrapper input mb-2">
                                    <div class="d-flex justify-content-between">
                                        <label for="password">@lang('global.password')</label>
                                        <a href="/forget-password" class="forgot-pass-link">@lang('global.forgot_password')</a>
                                    </div>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock">
                                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                        <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                                    </svg>
                                    <input id="password" name="password" type="password" class="form-control" placeholder="@lang('global.password')">
                                  
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" id="toggle-password" class="feather feather-eye">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                        <circle cx="12" cy="12" r="3"></circle>
                                    </svg>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                       
                                <div class="form-group input-container">
                                    <div id="myGcaptcha" class="g-recaptcha d-inline-block" data-sitekey="{{env('CAPTCHA_SITE_KEY')}}" data-callback="afterCaptchaRendered" data-expired-callback="expiredCapcta" data-error-callback="errorCallbackexpiredCapcta"></div>
                                </div>
                                <div class="d-sm-flex justify-content-between">
                                    <div class="field-wrapper">
                                        <button type="submit" class="btn btn-primary" value="">@lang('global.login')</button>
                                    </div>
                                </div>

                                <!-- <p class="signup-link"> @lang('global.not_register') <a href="#">@lang('global.create_register') </a></p> -->

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="assets/js/libs/jquery-3.1.1.min.js"></script>
    <script src="bootstrap/js/popper.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>

    <!-- END GLOBAL MANDATORY SCRIPTS -->
    <script src="assets/js/authentication/form-1.js"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script src="{{asset('plugins/notification/snackbar/snackbar.min.js')}}"></script>
</body>

</html>
<script>
    function afterCaptchaRendered(token) {
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        var path = "{{URL('login/recaptcha')}}";
        $.ajax({
            method: 'POST',
            header: {
                'X-CSRF-TOKEN': CSRF_TOKEN
            },
            /* the route pointing to the post function */
            url: path,
            type: 'POST',
            /* send the csrf-token and the input to the controller */
            data: {
                _token: CSRF_TOKEN,
                'recaptcha_response': token
            },
            dataType: 'JSON',
            /* remind that 'data' is the response of the AjaxController */
            success: function(response) {
                if (response.success) {
                    $('.gcp-error').remove();
                } else {
                    expiredCapcta();
                }
            },
            error: function() {
                expiredCapcta();
            }
        });

    }

    function expiredCapcta() {
        $('.gcp-error').remove();
        grecaptcha.reset();
    }

    function errorCallbackexpiredCapcta() {
        $('.gcp-error').remove();
        expiredCapcta();
    }

    $(window).on('load', function() {

        $('.g-recaptcha-response').parents('form').on('submit', function() {
            if ($('.g-recaptcha-response').val() == "") {
                $('.g-recaptcha-response').after('<p class="gcp-error text-danger">Please select this checkbox</p>');
                return false;
            } else {
                $('.gcp-error').remove();
            }
        });
    });
</script>
@if(session()->has('message.level'))
<script>
  var level = "{{ Session::get('message.level')}}";
  var background = "{{ Session::get('message.background')}}";
  var message = "{{ Session::get('message.content')}}";

  Snackbar.show({
    text: message,
    showAction: false,
    pos: 'bottom-right',
    backgroundColor: background,
    duration: 5000
  });
</script>
@endif