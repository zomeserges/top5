@extends('layouts/contentLayoutMaster')

@section('title', 'escalade List Page')

@section('vendor-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/ag-grid/ag-grid.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/ag-grid/ag-theme-material.css')) }}">

  <link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/toastr.css')) }}">
@endsection

@section('page-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset('css/pages/app-escalade.css') }}">
  <link rel="stylesheet" href="{{ asset(mix('css/pages/aggrid.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/plugins/extensions/toastr.css')) }}">
@endsection

@section('content')
  <!-- escalades list start {{--getescalades()--}}-->
  {{getEscalades()}}
  <section class="escalades-list-wrapper">
    <!-- escalades filter start -->
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">Filters
          <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
          <div class="heading-elements">
            <ul class="list-inline mb-0">
              <li><a data-action="collapse"><i class="feather icon-chevron-down"></i></a></li>
              <li><a data-action=""><i class="feather icon-rotate-cw escalades-data-filter"></i></a></li>
              <li><a data-action="close"><i class="feather icon-x"></i></a></li>
            </ul>
          </div>
      </div>
      <div class="card-content collapse show">
        <div class="card-body">
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
          <div class="escalades-list-filter">
            <form>
              <div class="row">
                <div class="col-12 col-sm-6 col-lg-3">
                  <label for="escalades-list-role">Escalade</label>
                  <fieldset class="form-group">
                    <select class="form-control" id="escalades-list-role">
                      <option value="">All</option>
                    </select>
                  </fieldset>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- escalades filter end -->
    <!-- Ag Grid escalades list section start -->
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
                    </button> &nbsp;&nbsp;&nbsp;<span><a class="btn btn-primary text-white" data-toggle="modal" data-target="#inlineForm1">Add new escalade</a></span></h4>
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
      <!-- Ag Grid escalades list section end -->

      <!-- escalades list ends -->
    @section('title', 'Modal')
    <!--End add escalade -->
      <section id="form-and-scrolling-components0">
        <div class="row match-height">
          <div class="col-md-4 col-sm-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Form Components</h4>
              </div>
              <div class="card-content">
                <div class="card-body">
                  <div class="form-group">
                    <h5>Nouvelle escalade</h5>
                    {{-- Button trigger modal --}}

                    <div class='modal fade text-left' id="inlineForm1" tabindex="-1" role="dialog"
                         aria-labelledby="myModalLabel33" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel33">Ajouter une escalade </h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <form action="app-escalade-create" method="post">
                            <div class="modal-body">
                              <label>escalade : </label>
                              <div class="form-group">
                                <input class="form-control" type="text" name="escalade" id="escalade" placeholder="Nom de la escalade" required>
                              </div>
                            </div>
                            {!! csrf_field() !!}
                            <div class="modal-footer">
                              <button class="btn btn-primary pull-right"  style="margin-top:20px;">Ajouter</button>
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
      <!--End add escalade -->




      <!--Start Modified escalade -->
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
                            <h4 class="modal-title" id="myModalLabel33">Modifier la escalade </h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <form  method="post">
                            <div class="modal-body">
                              <input class="form-control" type="hidden" name="edit_escalade_id" id="edit_escalade_id"  placeholder="" required>
                              <label>escalade : </label>
                              <div class="form-group">
                                <input class="form-control" type="text" name="edit_escalade_name" id="edit_escalade_name" placeholder="Nouveau Nom de la escalade" required>
                              </div>
                              <input  type="hidden" name="ismodif" value="123143-00292-20291">
                              <br>
                            </div>
                            {!! csrf_field() !!}
                            <div class="modal-footer">
                              <button class="btn btn-primary pull-right"  style="margin-top:20px;">Modifier la escalade</button>
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

        <script src="{{ asset(mix('vendors/js/extensions/toastr.min.js')) }}"></script>
      @endsection

      @section('page-script')
        {{-- Page js files --}}

        <script src="{{ asset('js/scripts/pages/app-escalade.js') }}"></script>
        <script src="{{ asset(mix('js/scripts/modal/components-modal.js')) }}"></script>

        <script src="{{ asset(mix('js/scripts/extensions/toastr.js')) }}"></script>
@endsection
