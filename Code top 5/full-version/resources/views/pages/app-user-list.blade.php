@extends('layouts/contentLayoutMaster')

@section('title', 'User List Page')

@section('vendor-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/ag-grid/ag-grid.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/ag-grid/ag-theme-material.css')) }}">
@endsection

@section('page-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset(mix('css/pages/app-user.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/pages/aggrid.css')) }}">
@endsection

@section('content')
  <!-- users list start -->
  {{getUsers()}}
  <section class="users-list-wrapper">
    <!-- users filter start -->
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">Filters</h4>
        <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
        <div class="heading-elements">
          <ul class="list-inline mb-0">
            <li><a data-action="collapse"><i class="feather icon-chevron-down"></i></a></li>
            <li><a data-action=""><i class="feather icon-rotate-cw users-data-filter"></i></a></li>
            <li><a data-action="close"><i class="feather icon-x"></i></a></li>
          </ul>
        </div>
      </div>
      <div class="card-content collapse show">
        <div class="card-body">
          <div class="users-list-filter">
            <form>
              <div class="row">
                <div class="col-12 col-sm-6 col-lg-3">
                  <label for="users-list-role">Role</label>
                  <fieldset class="form-group">
                    <select class="form-control" id="users-list-role">
                      <option value="">All</option>
                      <option value="Utilisateur">Utilisateur</option>
                      <option value="Super Admin">Super Admin</option>
                      <option value="Admin Action">Admin Action</option>
                      <option value="Admin Pareto">Admin Pareto</option>
                      <option value="Admin Indicateur">Admin Indicateur</option>
                      <option value="Admin Utilisateur">Admin Utilisateur</option>
                    </select>
                  </fieldset>
                </div>
                <div class="col-12 col-sm-6 col-lg-3">
                  <label for="users-list-status">Status</label>
                  <fieldset class="form-group">
                    <select class="form-control" id="users-list-status">
                      <option value="">All</option>
                      <option value="Active">Active</option>
                      <option value="Blocked">Blocked</option>
                      <option value="deactivated">Deactivated</option>
                    </select>
                  </fieldset>
                </div>
                <div class="col-12 col-sm-6 col-lg-3">
                  <label for="users-list-verified">Verified</label>
                  <fieldset class="form-group">
                    <select class="form-control" id="users-list-verified">
                      <option value="">All</option>
                      <option value="true">Yes</option>
                      <option value="false">No</option>
                    </select>
                  </fieldset>
                </div>
                <div class="col-12 col-sm-6 col-lg-3">
                  <label for="users-list-department">Department</label>
                  <fieldset class="form-group">
                    <select class="form-control" id="users-list-department">
                      <option value="">All</option>
                      <option value="Securite">Securite</option>
                      <option value="Qualite">Qualite</option>
                      <option value="Management">Management</option>
                    </select>
                  </fieldset>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- users filter end -->
    <!-- Ag Grid users list section start -->
    <div id="basic-examples">
      <div class="card">
        <div class="card-content">
          <div class="card-body">
            <div class="row">
              <div class="col-12">
                <div class="ag-grid-btns d-flex justify-content-between flex-wrap mb-1">
                  <div class="dropdown sort-dropdown mb-1 mb-sm-0">
                    <button class="btn btn-white filter-btn dropdown-toggle border text-dark" type="button"
                            id="dropdownMenuButton6" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      1 - 20 of 50
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton6">
                      <a class="dropdown-item" href="#">20</a>
                      <a class="dropdown-item" href="#">50</a>
                    </div>
                  </div>
                  <div class="ag-btns d-flex flex-wrap">
                    <input type="text" class="ag-grid-filter form-control w-50 mr-1 mb-1 mb-sm-0" id="filter-text-box"
                           placeholder="Search...."/>
                    <div class="btn-export">

                      <div class="action-btns">
                        <div class="btn-dropdown ">
                          <div class="btn-group dropdown actions-dropodown">
                            <button type="button"
                                    class="btn btn-white px-2 py-75 dropdown-toggle waves-effect waves-light"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              Actions
                            </button>
                            <div class="dropdown-menu">
                              <a class="dropdown-item" href="#"><i class="feather icon-trash-2"></i> Delete</a>
                              <a class="dropdown-item" href="#"><i class="feather icon-clipboard"></i> Archive</a>
                              <a class="dropdown-item" href="#"><i class="feather icon-printer"></i> Print</a>

                              <a class="dropdown-item ag-grid-export-btn" id="xlsd" type="button"><i
                                  class="feather icon-download "></i>
                                <button class="btn btn-default ag-grid-export-btn"> CSV
                                </button>
                              </a>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div id="myGrid" class="aggrid ag-theme-material"></div>

              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Ag Grid users list section end -->

      <!-- gid list ends -->
      @section('title', 'Modal')
      <section id="form-and-scrolling-components">
        <div class="row match-height">
          <div class="col-md-4 col-sm-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Form Components</h4>
              </div>
              <div class="card-content">
                <div class="card-body">
                  <div class="form-group">
                    <h5>Modifier les paramettres</h5>
                    {{-- Button trigger modal --}}

                    <div class='modal fade text-left' id="inlineForm" tabindex="-1" role="dialog"
                         aria-labelledby="myModalLabel33" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel33">Modifier l'utilisateur </h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <form action="#" method="post">
                            <div class="modal-body">
                            @foreach($errors as $error)
                              <div class="alert alert-warning" role="alert" style="width:100%;">
                                {{$error}}
                              </div>
                            @endforeach

                            @if(isset($success) && !empty($success))
                              <div class="alert alert-success" role="alert" style="width:100%;">
                                {{$success}}
                              </div>
                            @endif
                            <input class="form-control" type="hidden" name="user_id" id="edit_user_id" placeholder="user_id" required>
                            <label>Fist name: </label>
                            <div class="form-group">
                            <input class="form-control" type="text" name="first_name" id="edit_first_name" placeholder="Nom" required>
                            </div>
                            <label>Last name: </label>
                            <div class="form-group">
                            <input class="form-control" type="text" name="last_name" id="edit_last_name" placeholder="Prenom" required>
                            </div>
                            <label>Telephone: </label>
                            <div class="form-group">
                            <input class="form-control" type="tel" name="telephone" id="edit_telephone" placeholder="Téléphone" required>
                            </div>
                            <label>Email: </label>
                            <div class="form-group">
                            <input class="form-control" type="email" id="edit_email" name="email" placeholder="Adresse mail">
                            </div>
                              <label>Role </label>
                                <select name="type" id="edit_role" class="form-control" required>
                                  <option selected value="{{request('type')}}">Choose Role</option>
                                  <option>Utilisateur</option>
                                  <option>Admin Action</option>
                                  <option>Admin Pareto</option>
                                  <option>Admin Indicateur</option>
                                  <option>Admin Utilisateur</option>
                                  <option>Admin GID</option>
                                  <option>Super Admin</option>

                                </select>
                            <label>Password: </label>
                            <div class="form-group">
                            <input class="form-control " type="password" name="password" id="edit_password" placeholder="Nouveau mot de passe (laissez vide pour ne pas changer)">
                            </div>
                            <label>Confirm Password: </label>
                            <div class="form-group">
                              <input class="form-control" type="password" name="password2" placeholder="Confirmation du mot de passe (laissez vide pour ne pas changer)">
                            </div>
                              <input  type="hidden" name="ismodif" value="123143-00292-20291">
                            <br>
                            </div>
                            {!! csrf_field() !!}
                            <div class="modal-footer">
                              <button class="btn btn-primary pull-right" style="margin-top:20px;">Mettre a jours</button>
                              <button type="button"  data-dismiss="modal" aria-label="Close" class="btn btn-danger pull-right " style="margin-top:20px;">Annuler</button>
                            </div>

                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>




      {{-- add new sidebar ends --}}
      @endsection

      @section('vendor-script')
        {{-- Vendor js files --}}
        <script src="{{ asset(mix('vendors/js/tables/ag-grid/ag-grid-community.min.noStyle.js')) }}"></script>
      @endsection

      @section('page-script')
        {{-- Page js files --}}

        <script src="{{ asset(mix('js/scripts/pages/app-user.js')) }}"></script>
        <script src="{{ asset(mix('js/scripts/modal/components-modal.js')) }}"></script>

@endsection
