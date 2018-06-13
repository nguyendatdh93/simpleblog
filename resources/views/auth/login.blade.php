@extends('layouts.app')

@section('Content')
    <body class="login" style="background-color: #fff">
    <div>
        <a class="hiddenanchor" id="signup"></a>
        <a class="hiddenanchor" id="signin"></a>

        <div class="login_wrapper">
            <div class="animate form login_form">
                <section class="login_content">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <h1>{{ __('menu.logo') }}</h1>
                        <div>
                            <input type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="email" name="email" value="{{ old('email') }}" required="" />
                            @if ($errors->has('email'))
                                <p class="invalid-feedback">{{ $errors->first('email') }}</p>
                            @endif
                        </div>
                        <div>
                            <input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"  placeholder="password" name="password" required="" />
                            @if ($errors->has('password'))
                                <p class="invalid-feedback">{{ $errors->first('password') }}</p>
                            @endif
                        </div>
                        <div>
                            <button class="btn btn-default submit" type="submit">Log in</button>
                        </div>

                        <div class="clearfix"></div>
                    </form>
                </section>
            </div>

            <div id="register" class="animate form registration_form">
                <section class="login_content">
                    <form>
                        <h1>Create Account</h1>
                        <div>
                            <input type="text" class="form-control" placeholder="Username" required="" />
                        </div>
                        <div>
                            <input type="email" class="form-control" placeholder="Email" required="" />
                        </div>
                        <div>
                            <input type="password" class="form-control" placeholder="Password" required="" />
                        </div>
                        <div>
                            <a class="btn btn-default submit" href="index.html">Submit</a>
                        </div>

                        <div class="clearfix"></div>

                        <div class="separator">
                            <p class="change_link">Already a member ?
                                <a href="#signin" class="to_register"> Log in </a>
                            </p>

                            <div class="clearfix"></div>
                            <br />

                            <div>
                                <h1><i class="fa fa-paw"></i> Gentelella Alela!</h1>
                                <p>©2016 All Rights Reserved. Gentelella Alela! is a Bootstrap 3 template. Privacy and Terms</p>
                            </div>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </div>
    </body>
@endsection
