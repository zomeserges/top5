@extends('layouts/contentLayoutMaster')

@section('title', 'gid List Page')

@section('vendor-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/ag-grid/ag-grid.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/ag-grid/ag-theme-material.css')) }}">
@endsection

@section('page-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset('css/pages/app-gid.css') }}">
  <link rel="stylesheet" href="{{ asset(mix('css/pages/aggrid.css')) }}">
@endsection

@section('content')
  <!-- gids list start -->
  {{getgids()}}
  <section class="gids-list-wrapper">
    <!-- gids filter start -->
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">Filters</h4>
        <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
        <div class="heading-elements">
          <ul class="list-inline mb-0">
            <li><a data-action="collapse"><i class="feather icon-chevron-down"></i></a></li>
            <li><a data-action=""><i class="feather icon-rotate-cw gids-data-filter"></i></a></li>
            <li><a data-action="close"><i class="feather icon-x"></i></a></li>
          </ul>
        </div>
      </div>
      <div class="card-content collapse show">
        <div class="card-body">
          <div class="gids-list-filter">
            <form>
              <div class="row">
                <div class="col-12 col-sm-6 col-lg-3">
                  <label for="gids-list-origine">Origine</label>
                  <fieldset class="form-group">
                    <select class="form-control" id="gids-list-origine">
                      <option value="">All</option>@foreach($origines as $origine)
                        <option value="{{$origine->origine}}">{{$origine->origine}}</option>
                      @endforeach
                    </select>
                  </fieldset>
                </div>

                <div class="col-12 col-sm-6 col-lg-3">
                  <label for="gids-list-direction">Direction</label>
                  <fieldset class="form-group">
                    <select class="form-control" id="gids-list-direction">
                      <option value="">All</option>
                      @foreach($directions as $direction)
                        <option value="{{$direction->direction}}">{{$direction->direction}}</option>
                      @endforeach
                    </select>
                  </fieldset>
                </div>
                <div class="col-12 col-sm-6 col-lg-3">
                  <label for="gids-list-status">Status</label>
                  <fieldset class="form-group">
                    <select class="form-control" id="gids-list-status">
                      <option value="">All</option>
                      <option value="Active">Active</option>
                      <option value="Blocked">Blocked</option>
                      <option value="deactivated">Deactivated</option>
                    </select>
                  </fieldset>
                </div>
                <div class="col-12 col-sm-6 col-lg-3">
                  <label for="gids-list-verified">Verified</label>
                  <fieldset class="form-group">
                    <select class="form-control" id="gids-list-verified">
                      <option value="">All</option>
                      <option value="true">Yes</option>
                      <option value="false">No</option>
                    </select>
                  </fieldset>
                </div>
                <div class="col-12 col-sm-6 col-lg-3">
                  <label for="gids-list-department">Department</label>
                  <fieldset class="form-group">
                    <select class="form-control" id="gids-list-department">
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
    <!-- gids filter end -->
    <!-- Ag Grid gids list section start -->
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

                    </button> &nbsp;&nbsp;&nbsp;<span><a class="btn btn-primary text-white" data-toggle="modal" data-target="#inlineForm1">Add new GID</a></span></h4>

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
      <!-- Ag Grid gids list section end -->

      <!-- gids list ends -->
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

                    <div class='modal fade text-left' id="inlineForm1" tabindex="-1" role="dialog"
                         aria-labelledby="myModalLabel33" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel33">Ajouter un GID </h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <form action="app-gid-create" method="post">
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
                              <label>GID : </label>
                              <div class="form-group">

                                <input class="form-control" type="hidden" name="idorigine" id="idorigine" placeholder="" required>
                                <input class="form-control" type="text" name="gid" id="gid" placeholder="Nom du gid" required>

                              </div>
                              <label>Password : </label>
                              <div class="form-group">
                                <input class="form-control" type="password" name="pass" id="pass" placeholder="mot de passe du gid" required>
                              </div>

                              <label>Password verified : </label>
                              <div class="form-group">
                                <input class="form-control" type="password" name="password_ver" id="password_ver" placeholder="Confirmer le pass" required>
                              </div>

                              <label>Nom: </label>
                              <div class="form-group">
                                <input class="form-control" type="text" name="nom" id="nom" placeholder="Nom" required>
                              </div>
                              <label>Prenom: </label>
                              <div class="form-group">
                                <input class="form-control" type="text" name="prenom" id="prenom" placeholder="Prenom" required>
                              </div>
                              <label>Email: </label>
                              <div class="form-group">
                                <input class="form-control" type="email" id="email" name="email" placeholder="Adresse mail">

                              </div>
                              <div class="form-group">
                                <label>Origine </label>
                                <select name="origine" id="origine" class="form-control" required>
                                  <option selected value="{{request('origine')}}">Choose Origine</option>
                                  @foreach($origines as $origine)
                                    <option>{{$origine->origine}}</option>
                                  @endforeach
                                </select>
                              </div>

                                <div class="form-group">
                                  <label>Direction </label>
                                  <select name="direction" id="direction" class="form-control" required>
                                    <option selected value="{{request('direction')}}">Choose Direction</option>
                                    @foreach($directions as $direction)
                                      <option value="{{$direction->direction}}">{{$direction->direction}}</option>
                                    @endforeach
                                  </select>
                                </div>
                            </div>
                              {!! csrf_field() !!}
                              <div class="modal-footer">
                                <button class="btn btn-primary pull-right" style="margin-top:20px;" onclick="">Ajouter</button>
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


      {{--Modied gid start--}}

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
                            <h4 class="modal-title" id="myModalLabel33">Ajouter un GID </h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <form method="post">
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
                              <label>GID : </label>
                              <div class="form-group">

                                <input class="form-control" type="hidden" name="edit_gid_id" id="edit_gid_id" placeholder="" required>
                                <input class="form-control" type="hidden" name="edit_gid_idorigine" id="edit_gid_idorigine" placeholder="" required>
                                <input class="form-control" type="text" name="edit_gid" id="edit_gid" placeholder="Nom du gid" required>

                              </div>
                              <label>Password : </label>
                              <div class="form-group">
                                <input class="form-control" type="password" name="edit_gid_pass" id="edit_gid_pass" placeholder="mot de passe du gid" required>
                              </div>

                              <label>Password verified : </label>
                              <div class="form-group">
                                <input class="form-control" type="password" name="edit_gid_password_ver" id="edit_gid_password_ver" placeholder="Confirmer le pass" required>
                              </div>

                              <label>Nom: </label>
                              <div class="form-group">
                                <input class="form-control" type="text" name="edit_gid_nom" id="edit_gid_nom" placeholder="Nom" required>
                              </div>
                              <label>Prenom: </label>
                              <div class="form-group">
                                <input class="form-control" type="text" name="edit_gid_prenom" id="edit_gid_prenom" placeholder="Prenom" required>
                              </div>
                              <label>Email: </label>
                              <div class="form-group">
                                <input class="form-control" type="email" id="edit_gid_email" name="edit_gid_email" placeholder="Adresse mail">

                              </div>
                              <div class="form-group">
                                <label>Origine </label>
                                <select name="edit_gid_origine" id="edit_gid_origine" class="form-control" required>
                                  <option selected value="{{request('edit_gid_origine')}}">Choose Origine</option>
                                  @foreach($origines as $origine)
                                    <option>{{$origine->origine}}</option>
                                  @endforeach
                                </select>
                              </div>
                                <div class="form-group">
                                  <label>Direction </label>
                                  <select name="edit_gid_direction" id="edit_gid_direction" class="form-control" required>
                                    <option selected value="{{request('edit_gid_direction')}}">Choose Direction</option>
                                    @foreach($directions as $direction)
                                      <option value="{{$direction->direction}}">{{$direction->direction}}</option>
                                    @endforeach
                                  </select>
                                </div>
                                <input  type="hidden" name="ismodif" value="123143-00292-20291">
                                <br>
                            </div>
                            {!! csrf_field() !!}
                            <div class="modal-footer">
                              <button class="btn btn-primary pull-right" style="margin-top:20px;" onclick="">Modifier</button>
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

      {{--Modified gid end--}}


      {{-- add new sidebar ends --}}
      @endsection

      @section('vendor-script')
        {{-- Vendor js files --}}
        <script src="{{ asset(mix('vendors/js/tables/ag-grid/ag-grid-community.min.noStyle.js')) }}"></script>
      @endsection

      @section('page-script')
        {{-- Page js files --}}

        <script src="{{ asset('js/scripts/pages/app-gid.js') }}"></script>
        <script src="{{ asset(mix('js/scripts/modal/components-modal.js')) }}"></script>

@endsection
