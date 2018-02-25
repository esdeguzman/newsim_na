<!DOCTYPE html>
<html lang="en" class="body-full-height">
    <head>
        <!-- META SECTION -->
        <title>Atlant - Responsive Bootstrap Admin Template</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <link rel="icon" href="{{ url('favicon.ico') }}" type="image/x-icon" />
        <!-- END META SECTION -->

        <!-- CSS INCLUDE -->
        <link rel="stylesheet" type="text/css" id="theme" href="{{ url('css/theme-default.css') }}"/>
        <!-- EOF CSS INCLUDE -->
    </head>
    <body>

        @if (session('status'))
            <div class="error-container">
                <div class="error-text">Password Reset Link Sent!</div>
                <div class="error-subtext">{{ session('status') }}</div>
            </div>
        @else
            <div class="registration-container">
                <div class="registration-box animated fadeInDown">
                    <div class="registration-logo"></div>
                    <div class="registration-body">
                        <div class="registration-title"><strong>Forgot</strong> Password?</div>
                        <div class="registration-subtitle">Enter your email. We'll email instructions on how to reset your password.</div>
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('password.email') }}">
                        {{ csrf_field() }}
                        <h4>Your E-mail</h4>
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <div class="col-md-12">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="example@example.com" required>
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group push-up-20">
                            <div class="col-md-6">

                            </div>
                            <div class="col-md-6">
                                <button class="btn btn-danger btn-block">Send Reset Link</button>
                            </div>
                        </div>
                        </form>
                    </div>
                    <div class="registration-footer">
                        <div class="pull-left">
                            &copy; 2017 NEWSIM ACCOUNTS
                        </div>
                        <div class="pull-right">
                            <a href="#">About</a> |
                            <a href="#">Privacy</a> |
                            <a href="#">Contact Us</a>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </body>
</html>
