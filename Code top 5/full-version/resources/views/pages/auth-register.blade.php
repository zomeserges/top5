@extends('layouts/fullLayoutMaster')

@section('title', 'Register Page')

@section('page-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset(mix('css/pages/authentication.css')) }}">
@endsection
@section('content')
  <section class="row flexbox-container">
    <div class="col-xl-8 col-10 d-flex justify-content-center">
      <div class="card bg-authentication rounded-0 mb-0">
        <div class="row m-0">
          <div class="col-lg-6 d-lg-block d-none text-center align-self-center pl-0 pr-3 py-0">
            <img src="{{ asset('images/pages/register.jpg') }}" alt="branding logo">
          </div>
          <div class="col-lg-6 col-12 p-0">
            <div class="card rounded-0 mb-0 p-2">
              <div class="card-header pt-50 pb-1">
                <div class="card-title">
                  <h4 class="mb-0">Create Account</h4>
                </div>
              </div>
              <p class="px-2">Fill the below form to create a new account.</p>
              <div class="card-content">
                <div class="card-body pt-0">


                  <form  id="register-form" method="post">
                    @foreach($errors as $error)
                      <div class="alert alert-warning" role="alert" style="width: 100%">
                        {{$error}}
                      </div>
                    @endforeach
                    <div class="form-label-group">
                      <input class=" form-control" id="inputFistName" type="text"  name="first_name" placeholder="First Name" required
                             value="{{request('first_name')}}">
                      <label for="inputFirstName">First Name</label>
                    </div>
                      <div class="form-label-group">
                        <input class=" form-control" id="inputLastName" type="text"  name="last_name" placeholder="Last Name" required
                               value="{{request('last_name')}}">
                        <label for="inputLastName">Last Name</label>
                      </div>
                    <div class="form-label-group">
                      <input type="email" id="inputEmail" name="email" class=" form-control" placeholder="Email" required
                             value="{{request('email')}}">
                      <label for="inputEmail">Email</label>
                    </div>
                      <div class="form-label-group">
                        <input type="tel" id="inputTelephone" name="telephone" class="form-control" placeholder="Phone" required
                               value="{{request('telephone')}}">
                        <label for="inputTelephone">Phone</label>
                      </div>
                      <div class="form-label-group">
                        <select name="type" id="inputRole" class="form-control" required>
                          <option selected value="{{request('type')}}">Choose Role</option>
                          <option>Utilisateur</option>
                          <option>Admin Action</option>
                          <option>Admin Pareto</option>
                          <option>Admin Indicateur</option>
                          <option>Admin Utilisateur</option>
                          <option>Admin GID</option>
                          <option>Super Admin</option>

                        </select>
                      </div>
                    <div class="form-label-group">
                      <input type="password" id="inputPassword" class="form-control" name="password" placeholder="Password" required>
                      <label for="inputPassword">Password</label>
                    </div>
                    <div class="form-label-group">
                      <input type="password" id="inputConfPassword" class="form-control" name="password_ver" placeholder="Confirm Password"
                             required>
                      <label for="inputConfPassword">Confirm Password</label>
                    </div>
                    <div class="form-group row">
                      <div class="col-12">
                        <fieldset class="checkbox">
                          <div class="vs-checkbox-con vs-checkbox-primary">
                            <input type="checkbox" checked>
                            <span class="vs-checkbox">
                                                <span class="vs-checkbox--check">
                                                  <i class="vs-icon feather icon-check"></i>
                                                </span>
                                              </span>
                            <span class=""> I accept the terms & conditions.</span>
                          </div>
                        </fieldset>
                      </div>
                    </div>
                      {!! csrf_field() !!}
                    <a href="auth-login" class="btn btn-outline-primary float-left btn-inline mb-50">Login</a>
                    <button type="submit" class="btn btn-primary float-right btn-inline mb-50">Register</a>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
