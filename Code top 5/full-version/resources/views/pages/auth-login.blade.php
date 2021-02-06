@extends('layouts/fullLayoutMaster')

@section('title', 'Login Page')

@section('page-style')
        {{-- Page Css files --}}
        <link rel="stylesheet" href="{{ asset(mix('css/pages/authentication.css')) }}">
@endsection
@section('content')
<section class="row flexbox-container">
  <div class="col-xl-8 col-11 d-flex justify-content-center">
      <div class="card bg-authentication rounded-0 mb-0">
          <div class="row m-0">
              <div class="col-lg-6 d-lg-block d-none text-center align-self-center px-1 py-0">
                  <img src="{{ asset('images/pages/login.png') }}" alt="branding logo">
              </div>
              <div class="col-lg-6 col-12 p-0">
                  <div class="card rounded-0 mb-0 px-2">
                      <div class="card-header pb-1">
                          <div class="card-title">
                              <h4 class="mb-0">Login</h4>
                          </div>
                      </div>
                      <p class="px-2">Welcome back, please login to your account.</p>
                      <div class="card-content">
                          <div class="card-body pt-1">
                            @if(count($errors)==0)
                              <div id="typed-strings">
                                <h1 class>Hé, bon retour</h1>
                                <h1 class>Remplissez le formulaire ci-dessous</h1>
                              </div>
                            @else
                              <div id="typed-strings">
                                <h1 class>Oops! :(</h1>
                              </div>
                            @endif
                            <div style="text-align:center;">
                              <span id="typed" style="white-space:pre;"></span>
                            </div>
                            <form id="register-form" method="post">

                              @foreach($errors as $error)
                                <div class="alert alert-warning" role="alert" style="width:100%;">
                                  {{$error}}
                                </div>
                              @endforeach

                              <form action="" method="post">

                                  <fieldset class="form-label-group form-group position-relative has-icon-left">
                                      <input  class="form-control"  type="email" name="email" placeholder="Adresse mail" value="{{request('email')}}" required>
                                      <div class="form-control-position">
                                          <i class="feather icon-user"></i>
                                      </div>
                                      <label for="email">Email</label>
                                  </fieldset>

                                  <fieldset class="form-label-group position-relative has-icon-left">
                                      <input type="password" class="form-control"  name="password" placeholder="Mot de passe" value="{{request('password')}}" required>
                                      <div class="form-control-position">
                                          <i class="feather icon-lock"></i>
                                      </div>
                                      <label for="password">Password</label>
                                  </fieldset>
                                  <div class="form-group d-flex justify-content-between align-items-center">
                                      <div class="text-left">
                                          <fieldset class="checkbox">
                                            <div class="vs-checkbox-con vs-checkbox-primary">
                                              <input type="checkbox">
                                              <span class="vs-checkbox">
                                                <span class="vs-checkbox--check">
                                                  <i class="vs-icon feather icon-check"></i>
                                                </span>
                                              </span>
                                              <span class="">Remember me</span>
                                            </div>
                                          </fieldset>
                                      </div>
                                      <div class="text-right"><a href="auth-forgot-password" class="card-link">Forgot Password?</a></div>
                                  </div>
                                {!! csrf_field() !!}
                                  <button type="submit" class="btn btn-primary float-right btn-inline">Se connecter</button>
                              </form>
                          </div>
                      </div>
                      <div class="login-footer">
                        <div class="divider">
                          <div class="divider-text">OR</div>
                        </div>
                        <div class="footer-btn d-inline">
                            <a href="#" class="btn btn-facebook"><span class="fa fa-facebook"></span></a>
                            <a href="#" class="btn btn-twitter white"><span class="fa fa-twitter"></span></a>
                            <a href="#" class="btn btn-google"><span class="fa fa-google"></span></a>
                            <a href="#" class="btn btn-github"><span class="fa fa-github-alt"></span></a>
                        </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
</section>
@endsection
