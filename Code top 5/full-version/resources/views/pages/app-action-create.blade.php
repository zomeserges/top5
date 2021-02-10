@extends('layouts/contentLayoutMaster')

@section('title', 'action List Page')

@section('vendor-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/ag-grid/ag-grid.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/ag-grid/ag-theme-material.css')) }}">

  <link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/toastr.css')) }}">
  {{--For editor--}}

  <link rel="stylesheet" href="{{ asset(mix('vendors/css/editors/quill/katex.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/editors/quill/monokai-sublime.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/editors/quill/quill.snow.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/editors/quill/quill.bubble.css')) }}">
@endsection

@section('page-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset('css/pages/app-action.css') }}">
  <link rel="stylesheet" href="{{ asset(mix('css/pages/aggrid.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/plugins/extensions/toastr.css')) }}">

  {{--For editor--}}
@endsection

@section('content')
  <!-- actions list start {{--getactions()--}}-->
  {{getactions()}}
  <section class="actions-list-wrapper">
    <!-- actions filter start -->

    <!-- Ag Grid actions list section start -->
    <div id="basic-examples">
      <div class="card">
        <div class="card-content">
          <div class="card-body">
            <div class="row">
              <div class="col-12">
                <div class="ag-grid-btns d-flex justify-content-between flex-wrap mb-1">
                  <div class="dropdown sort-dropdown mb-1 mb-sm-0">
                    &nbsp;&nbsp;&nbsp;<span><a class="btn btn-primary text-white" href="{{asset("app-action-list")}}">Retour à la liste des actions</a></span>
                  </div>
                </div>
                <!--div id="myGrid" class="aggrid ag-theme-material"></div-->

              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Ag Grid actions list section end -->

      <!-- actions list ends -->
    @section('title', 'Modal')
    <!--End add action -->
      <section id="form-and-scrolling-components0">
        <div class="row match-height">
          <div class="col-md-10 col-sm-12 offset-1">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Nouvaux action</h4>
              </div>
              <div class="card-content">
                <div class="card-body">
                  <div class="row match-height">
                    <div class="col-md-7 col-sm-12 offset-2">
                      <div class="form-group">
                        {{-- Button trigger modal --}}

                        <form action="app-action-create" method="post">
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

                            <div class="form-group">
                              <label>Direction </label>
                              <select name="iddirection" id="action_direction" class="form-control" required>
                                <option selected value="{{request('iddirection')}}">Choose Direction</option>
                                @foreach($directions as $direction)
                                  <option value="{{$direction->iddirection}}">{{$direction->direction}}</option>
                                @endforeach
                              </select>
                            </div>
                            <div class="form-group">
                              <label>SQDIP </label>
                              <select name="idsqdip" id="action_sqdip" class="form-control" required>
                                <option selected value="{{request('idsqdip')}}">Choose SQDIP</option>
                                @foreach($sqdips as $sqdip)
                                  <option value="{{$sqdip->idsqdip}}">{{$sqdip->sqdip}}</option>
                                @endforeach
                              </select>
                            </div>

                            <div class="form-group">
                              <label>PDCA </label>
                              <select name="idpdca" id="action_sqdip" class="form-control" required>
                                <option selected value="{{request('idpdca')}}">Choose PDCA</option>
                                @foreach($pdcas as $pdca)
                                  <option value="{{$pdca->idpdca}}">{{$pdca->etat}}</option>
                                @endforeach
                              </select>
                            </div>
                            <div class="form-group">
                              <label>Escalade </label>
                              <select name="idescalade" id="action_escalade" class="form-control" required>
                                <option selected value="{{request('idescalade')}}">Choose escalade</option>
                                @foreach($escalades as $escalade)
                                  <option value="{{$escalade->idescalade}}">{{$escalade->escalade}}</option>
                                @endforeach
                              </select>
                            </div>
                            <div class="form-group">
                              <label>GID </label>
                              <select name="idgid" id="action_escalade" class="form-control" required>
                                <option selected value="{{request('idgid')}}">Choose GID</option>
                                @foreach($gids as $gid)
                                  <option value="{{$gid->idgid}}">{{$gid->gid}}</option>
                                @endforeach
                              </select>
                            </div>
                            <div class="form-group">
                              <label>Origine </label>
                              <select name="idorigine" id="action_origine" class="form-control" required>
                                <option selected value="{{request('origine')}}">Choose Origine</option>
                                @foreach($origines as $origine)
                                  <option value="{{$origine->idorigine}}">{{$origine->origine}}</option>
                                @endforeach
                              </select>
                            </div>

                          <label>Action : </label>
                          <div class="form-group">
                            <textarea class="form-control ckeditor" name="action" id="action"></textarea>
                          </div>
                          <label>Responsable : </label>
                          <div class="form-group">
                            <input class="form-control" type="text" name="responsable" id="responsable" placeholder="responsable" required>
                          </div>
                          <label>Date prévue : </label>
                          <div class="form-group">
                            <input class="form-control" type="date" name="date_prevu" id="date_prevu">
                          </div>


                          {!! csrf_field() !!}
                          <div class="modal-footer">
                            <button class="btn btn-primary pull-right" style="margin-top:20px;" onclick="">Ajouter</button>
                            <button type="reset"  data-dismiss="modal" aria-label="Close" class="btn btn-danger pull-right " style="margin-top:20px;">Annuler</button>
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
      </section>
      <!--End add action -->







      {{-- add new sidebar ends --}}
      @endsection

      @section('vendor-script')
        {{-- Vendor js files --}}
        <script src="{{ asset(mix('vendors/js/tables/ag-grid/ag-grid-community.min.noStyle.js')) }}"></script>

        <script src="{{ asset(mix('vendors/js/extensions/toastr.min.js')) }}"></script>

        {{--For editor--}}
        <script src="{{ asset(mix('vendors/js/editors/quill/katex.min.js')) }}"></script>
        <script src="{{ asset(mix('vendors/js/editors/quill/highlight.min.js')) }}"></script>
        <script src="{{ asset(mix('vendors/js/editors/quill/quill.min.js')) }}"></script>
        <script src="{{ asset(mix('vendors/js/extensions/jquery.steps.min.js')) }}"></script>
        <script src="{{ asset(mix('vendors/js/forms/validation/jquery.validate.min.js')) }}"></script>
      @endsection

      @section('page-script')
        {{-- Page js files --}}

        <script src="{{ asset('js/scripts/pages/app-action.js') }}"></script>
        <script src="{{ asset(mix('js/scripts/modal/components-modal.js')) }}"></script>

        <script src="{{ asset(mix('js/scripts/extensions/toastr.js')) }}"></script>

        {{--For editor--}}
        <script src="{{ asset(mix('js/scripts/editors/editor-quill.js')) }}"></script>
        <script src="//cdn.ckeditor.com/4.16.0/full/ckeditor.js"></script>
        <script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>


@endsection
