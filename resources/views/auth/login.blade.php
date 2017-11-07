<!DOCTYPE html>
<html lang="en">
<!-- begin::Head -->
<head>
    <meta charset="utf-8"/>
    <title>
        Metronic | Login Page - 5
    </title>
    <meta name="description" content="Latest updates and statistic charts">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!--begin::Web font -->
    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
    <script>
        WebFont.load({
            google: {"families": ["Poppins:300,400,500,600,700", "Roboto:300,400,500,600,700"]},
            active: function () {
                sessionStorage.fonts = true;
            }
        });
    </script>
    <!--end::Web font -->
    <!--begin::Base Styles -->
    <link href="../../assets/vendors/base/vendors.bundle.css" rel="stylesheet" type="text/css"/>
    <link href="../../assets/demo/default/base/style.bundle.css" rel="stylesheet" type="text/css"/>
    <!--end::Base Styles -->
    <link rel="shortcut icon" href="../../assets/demo/default/media/img/logo/favicon.ico"/>
</head>
<!-- end::Head -->
<!-- end::Body -->
<body class="m--skin- m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default">
<!-- begin:: Page -->
<div class="m-grid m-grid--hor m-grid--root m-page">
    <div class="m-login m-login--singin  m-login--5" id="m_login"
         style="background-image: url(../../assets/app/media/img//bg/bg-3.jpg);">
        <div class="m-login__wrapper-1 m-portlet-full-height">
            <div class="m-login__wrapper-1-1">
                <div class="m-login__contanier">
                    <div class="m-login__content">
                        <div class="m-login__logo">
                            <a href="#">
                                <img src="../../assets/app/media/img//logos/logo-2.png">
                            </a>
                        </div>
                        <div class="m-login__title">
                            <h3>
                                JOIN OUR GREAT INDUSTRIAL-CLOUD COMMUNITY GET FREE ACCOUNT
                            </h3>
                        </div>
                        <div class="m-login__desc">
                            Helpful tools available for you and your business
                        </div>
                        <div class="m-login__form-action">
                            <button type="button" id="m_login_signup" class="btn btn-outline-focus m-btn--pill">
                                Get An Account
                            </button>
                        </div>
                    </div>
                </div>
                <div class="m-login__border">
                    <div></div>
                </div>
            </div>
        </div>
        <div class="m-login__wrapper-2 m-portlet-full-height">
            <div class="m-login__contanier">
                <div class="m-login__signin">
                    <div class="m-login__head">
                        <h3 class="m-login__title">
                            Login To Your Account
                        </h3>
                    </div>

                    {{--Sign In--}}
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                        {{ csrf_field() }}

                        <div class="form-group m-form__group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <input id="email" type="email" placeholder="Email" autocomplete="off" required
                                   class="form-control m-input" name="email" value="{{ old('email') }}">
                            @if ($errors->has('email'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
                        </div>

                        <div class="form-group m-form__group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <input class="form-control m-input m-login__form-input--last" type="password" required
                                   placeholder="Password" name="password">
                            @if ($errors->has('password'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            @endif
                        </div>

                        <div class="row m-login__form-sub">
                            <div class="col m--align-left">
                                <label class="m-checkbox m-checkbox--focus">
                                    <input type="checkbox" name="remember"> Remember Me
                                    <span></span>
                                </label>
                            </div>
                            <div class="col m--align-right">
                                <a href="javascript:;" id="m_login_forget_password" class="m-link">
                                    Forget Password ?
                                </a>
                            </div>
                        </div>
                        <div class="m-login__form-action">
                            <button type="submit" class="btn btn-focus  m-btn--pill  m-btn--custom m-btn--air">
                                <i class="fa fa-btn fa-sign-in"></i> Sign In
                            </button>
                        </div>
                    </form>
                </div>
                {{--End Of SignIn--}}

                {{--Sign Up New user--}}
                <div class="m-login__signup">
                    <div class="m-login__head">
                        <h3 class="m-login__title">
                            Sign Up
                        </h3>
                        <div class="m-login__desc">
                            Enter your details to create your account:
                        </div>
                    </div>
                    <form class="m-login__form m-form" role="form" method="POST" action="{{ url('/register') }}">
                        {{ csrf_field() }}

                        <div class="form-group m-form__group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <input class="form-control m-input" type="text" placeholder="Fullname" name="name" required
                                   value="{{ old('name') }}">
                            @if ($errors->has('name'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="form-group m-form__group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <input class="form-control m-input" type="email" placeholder="Email" name="email" required
                                   value="{{ old('email') }}" autocomplete="off">
                            @if ($errors->has('email'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="form-group m-form__group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <input class="form-control m-input" type="password" placeholder="Password" name="password"
                                   required>
                            @if ($errors->has('password'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="form-group m-form__group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <input id="password-confirm" type="password" name="password_confirmation"
                                   class="form-control m-input m-login__form-input--last" required
                                   placeholder="Confirm Password">
                        </div>

                        <div class="form-group m-form__group{{ $errors->has('type') ? ' has-error' : '' }}">
                                <select id="type" class="form-control m-select" name="type" >
                                    <option value="PURCHASER">Purchaser Office</option>
                                    <option value="SALESPERSON">Sales Office</option>
                                </select>

                                @if ($errors->has('type'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('type') }}</strong>
                                    </span>
                                @endif
                        </div>
                        {{--<input id="_company_id" type="hidden" name="_company_id" value="1">--}}


                        <div class="m-login__form-sub">
                            <label class="m-checkbox m-checkbox--focus">
                                <input type="checkbox" name="agree" required>
                                I Agree the
                                <a href="#" class="m-link m-link--focus">
                                    terms and conditions
                                </a>
                                .
                                <span></span>
                            </label>
                            <span class="m-form__help"></span>
                        </div>

                        <div class="m-login__form-action">
                            <button type="submit" class="btn btn-focus  m-btn--pill  m-btn--custom m-btn--air">
                                <i class="fa fa-btn fa-user"></i> Sign Up Me!
                            </button>
                            <button id="m_login_signup_cancel"
                                    class="btn btn-outline-focus m-btn m-btn--pill m-btn--custom">
                                Cancel
                            </button>
                        </div>
                    </form>
                </div>
                {{--End of SigUp user--}}

                {{-- Forgot Password--}}
                <div class="m-login__forget-password">
                    <div class="m-login__head">
                        <h3 class="m-login__title">
                            Forgotten Password ?
                        </h3>
                        <div class="m-login__desc">
                            Enter your email to reset your password:
                        </div>
                    </div>

                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/email') }}">
                        {{ csrf_field() }}
                        <div class="form-group m-form__group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <input class="form-control m-input" type="email" placeholder="Email" name="email" required
                                   id="m_email" autocomplete="off" value="{{ old('email') }}">
                            @if ($errors->has('email'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="m-login__form-action">
                            <button type="submit" class="btn btn-focus  m-btn--pill  m-btn--custom m-btn--air">
                                <i class="fa fa-btn fa-envelope"></i> Send Reset Link
                            </button>
                            <button id="m_login_forget_password_cancel"
                                    class="btn btn-outline-focus m-btn m-btn--pill m-btn--custom ">
                                Cancel
                            </button>
                        </div>
                    </form>


                </div>
                {{--End of Forgot Password--}}

            </div>
        </div>
    </div>
</div>
<!-- end:: Page -->
<!--begin::Base Scripts -->
<script src="../../assets/vendors/base/vendors.bundle.js" type="text/javascript"></script>
<script src="../../assets/demo/default/base/scripts.bundle.js" type="text/javascript"></script>
<!--end::Base Scripts -->
<!--begin::Page Snippets -->
<script src="../../assets/snippets/pages/user/login.js" type="text/javascript"></script>
<!--end::Page Snippets -->
</body>
<!-- end::Body -->
</html>
