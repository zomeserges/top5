@extends('layouts/contentLayoutMaster')

@section('title', 'origine List Page')

@section('vendor-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/ag-grid/ag-grid.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/ag-grid/ag-theme-material.css')) }}">
@endsection

@section('page-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset('css/pages/app-origine.css') }}">
  <link rel="stylesheet" href="{{ asset(mix('css/pages/aggrid.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/plugins/extensions/toastr.css')) }}">
@endsection

@section('content')
  <!-- origines list start {{--getorigines()--}}-->

  <section class="origines-list-wrapper">
    <!-- origines filter start -->
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">Filters</h4>
        <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
        <div class="heading-elements">
          <ul class="list-inline mb-0">
            <li><a data-action="collapse"><i class="feather icon-chevron-down"></i></a></li>
            <li><a data-action=""><i class="feather icon-rotate-cw origines-data-filter"></i></a></li>
            <li><a data-action="close"><i class="feather icon-x"></i></a></li>
          </ul>
        </div>
      </div>

      <!-- Ag Grid origines list section end -->

      <!-- origines list ends -->
    @section('title', 'Modal')
    <!--End add origine -->
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
                    <h5>Nouveau origine</h5>
                    <span><a class="btn btn-primary text-white" data-toggle="modal" data-target="#inlineForm1">Add new origine</a></span><br>
                    <span><a class="btn btn-success text-white" data-toggle="modal" data-target="#inlineForm1">Retour à la liste des origines</a></span>

                    {{-- Button trigger modal --}}

                    <div class='modal fade text-left' id="inlineForm1" tabindex="-1" role="dialog"
                         aria-labelledby="myModalLabel33" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel33">Ajouter une origine </h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <form action="app-origine-create" method="post">
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
                              <label>origine : </label>
                              <div class="form-group">
                                <input class="form-control" type="text" name="origine" id="origine" placeholder="Nom du origine" required>
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
      <!--End add origine -->




      {{-- add new sidebar ends --}}
      @endsection

      @section('vendor-script')
        {{-- Vendor js files --}}
        <script src="{{ asset(mix('vendors/js/tables/ag-grid/ag-grid-community.min.noStyle.js')) }}"></script>
      @endsection

      @section('page-script')
        {{-- Page js files --}}

        <script src="{{ asset('js/scripts/pages/app-origine.js') }}"></script>
        <script src="{{ asset(mix('js/scripts/modal/components-modal.js')) }}"></script>

        <script src="{{ asset(mix('js/scripts/extensions/toastr.js')) }}"></script>
@endsection
