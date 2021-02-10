@extends('layouts/contentLayoutMaster')

@section('title', 'indicateur List Page')

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
  <link rel="stylesheet" href="{{ asset('css/pages/app-indicateur.css') }}">
  <link rel="stylesheet" href="{{ asset(mix('css/pages/aggrid.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/plugins/extensions/toastr.css')) }}">

  {{--For editor--}}
@endsection

@section('content')
  <!-- indicateurs list start {{--getindicateurs()--}}-->
  {{getIndicateurs()}}
  <section class="indicateurs-list-wrapper">
    <!-- indicateurs filter start -->

    <!-- Ag Grid indicateurs list section start -->
    <div id="basic-examples">
      <div class="card">
        <div class="card-content">
          <div class="card-body">
            <div class="row">
              <div class="col-12">
                <div class="ag-grid-btns d-flex justify-content-between flex-wrap mb-1">
                  <div class="dropdown sort-dropdown mb-1 mb-sm-0">
                    &nbsp;&nbsp;&nbsp;<span><a class="btn btn-primary text-white" href="{{asset("app-indicateur-list")}}">Retour à la liste des indicateurs</a></span>
                  </div>
                </div>
                <!--div id="myGrid" class="aggrid ag-theme-material"></div-->

              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Ag Grid indicateurs list section end -->

      <!-- indicateurs list ends -->
    @section('title', 'Modal')
    <!--End add indicateur -->
      <section id="form-and-scrolling-components0">
        <div class="row match-height">
          <div class="col-md-10 col-sm-12 offset-1">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Nouvaux indicateur</h4>
              </div>
              <div class="card-content">
                <div class="card-body">
                  <div class="row match-height">
                    <div class="col-md-7 col-sm-12 offset-2">
                  <div class="form-group">
                    {{-- Button trigger modal --}}

                    <form action="app-indicateur-create" method="post">
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
                        <input class="form-control" type="hidden" name="iddirection" id="iddirection" placeholder="" required>
                        <input class="form-control" type="hidden" name="idorigine" id="idorigine" placeholder="" required>
                        <input class="form-control" type="hidden" name="idsqdip" id="idsqdip" placeholder="" required>

                      </div>
                      <label>Indicateur : </label>
                      <div class="form-group">
                        <input class="form-control" type="text" name="indicateur" id="indicateur" placeholder="Indicateur" required>
                      </div>
                      <label>Responsable : </label>
                      <div class="form-group">
                        <input class="form-control" type="text" name="responsable" id="responsable" placeholder="responsable" required>
                      </div>
                      <label>Description : </label>
                      <div class="form-group">
                        <textarea class="form-control ckeditor" name="description" id="descriptionindicateur"></textarea>
                      </div>

                      <div class="form-group">
                        <label>Direction </label>
                        <select name="direction" id="indicateur_direction" class="form-control" required>
                          <option selected value="{{request('direction')}}">Choose Direction</option>
                          @foreach($directions as $direction)
                            <option value="{{$direction->direction}}">{{$direction->direction}}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="form-group">
                        <label>Origine </label>
                        <select name="origine" id="indicateur_origine" class="form-control" required>
                          <option selected value="{{request('origine')}}">Choose Origine</option>
                          @foreach($origines as $origine)
                            <option>{{$origine->origine}}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="form-group">
                        <label>SQDIP </label>
                        <select name="sqdip" id="indicateur_sqdip" class="form-control" required>
                          <option selected value="{{request('sqdip')}}">Choose SQDIP</option>
                          @foreach($sqdips as $sqdip)
                            <option value="{{$sqdip->sqdip}}">{{$sqdip->sqdip}}</option>
                          @endforeach
                        </select>
                      </div>

                      <label>Valeur minimal : </label>
                      <div class="form-group">
                        <input type="number" class="form-control " name="mini" id="mini">
                      </div>

                      <label>Valeur Optenu : </label>
                      <div class="form-group">
                        <input type="number" class="form-control " name="valeur" id="valeur">
                      </div>

                      <label>Valeur Maximal : </label>
                      <div class="form-group">
                        <input type="number" class="form-control" name="maxi" id="maxi">
                      </div>

                      <label>Seuil : </label>
                      <div class="form-group">
                        <input type="number" class="form-control " name="a1" id="seuil">
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
      <!--End add indicateur -->







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

        <script src="{{ asset('js/scripts/pages/app-indicateur.js') }}"></script>
        <script src="{{ asset(mix('js/scripts/modal/components-modal.js')) }}"></script>

        <script src="{{ asset(mix('js/scripts/extensions/toastr.js')) }}"></script>

        {{--For editor--}}
        <script src="{{ asset(mix('js/scripts/editors/editor-quill.js')) }}"></script>
        <script src="//cdn.ckeditor.com/4.16.0/full/ckeditor.js"></script>
        <script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>


@endsection
