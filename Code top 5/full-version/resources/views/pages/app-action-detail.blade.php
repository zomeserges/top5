@extends('layouts/contentLayoutMaster')

@section('title', 'Account Settings')

@section('vendor-style')
  <!-- vendor css files -->
  <link rel='stylesheet' href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
  <link rel='stylesheet' href="{{ asset(mix('vendors/css/pickers/pickadate/pickadate.css')) }}">
@endsection
@section('page-style')
  <!-- Page css files -->
  <link rel="stylesheet" href="{{ asset(mix('css/plugins/extensions/noui-slider.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/core/colors/palette-noui.css')) }}">
@endsection

@section('content')
  <!-- account setting page start -->
  <section id="page-account-settings">
    <div class="row">
      <!-- left menu section -->
      <div class="col-md-3 mb-2 mb-md-0">
        <ul class="nav nav-pills flex-column mt-md-0 mt-1">
          <li class="nav-item">
            <a class="nav-link d-flex py-75 active" id="account-pill-general" data-toggle="pill"
               href="#account-vertical-general" aria-expanded="true">
              <i class="feather icon-globe mr-50 font-medium-3"></i>
              General
            </a>
          </li>
        </ul></div>
      <!-- right content section -->
      <div class="col-md-9">
        <div class="card">
          <div class="card-content">
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
              <div class="tab-content">

                <hr>
                <form  method="post">

                  <div class="form-group">
                    <input class="form-control" type="hidden" name="iddirection" id="iddirection" value="{{$action->iddirection}}" placeholder="" required>
                    <input class="form-control" type="hidden" name="idorigine" id="idorigine" value="{{$action->idorigine}}" placeholder="" required>
                    <input class="form-control" type="hidden" name="idsqdip" id="idsqdip" value="{{$action->idsqdip}}" placeholder="" required>
                  </div>
                  <label>action : </label>
                  <div class="form-group">
                    <input class="form-control" type="text" name="action" id="action" value=" {{$action->action}}" placeholder="action" required>
                  </div>
                  <label>Responsable : </label>
                  <div class="form-group">
                    <input class="form-control" type="text" name="responsable" id="responsable" value="{{$action->responsable}}" placeholder="responsable" required>
                  </div>
                  <label>Description : </label>
                  <div class="form-group">
                    <textarea class="form-control ckeditor" name="description"   id="descriptionaction"></textarea>

                  </div>

                  <div class="form-group">
                    <label>Direction </label>
                    <select name="direction" id="action_direction"  class="form-control" required>
                      <option selected value="{{request('direction')}}">{{$action->direction}}</option>
                      @foreach($directions as $direction)
                        <option value="{{$direction->direction}}">{{$direction->direction}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Origine </label>
                    <select name="origine" id="action_origine" class="form-control" required>
                      <option selected value="{{request('origine')}}">{{$action->origine}}</option>
                      @foreach($origines as $origine)
                        <option value="{{$origine->origine}}">{{$origine->origine}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label>SQDIP </label>
                    <select name="sqdip" id="action_sqdip" class="form-control" required>
                      <option selected value="{{request('sqdip')}}">{{$action->sqdip}}</option>
                      @foreach($sqdips as $sqdip)
                        <option value="{{$sqdip->sqdip}}">{{$sqdip->sqdip}}</option>
                      @endforeach
                    </select>
                  </div>

                  <label>Valeur minimal : </label>
                  <div class="form-group">
                    <input type="number" class="form-control " name="mini" value="{{$action->mini}}" id="mini">
                  </div>

                  <label>Valeur Optenu : </label>
                  <div class="form-group">
                    <input type="number" class="form-control " name="valeur" value="{{$action->valeur}}"id="valeur">
                  </div>

                  <label>Valeur Maximal : </label>
                  <div class="form-group">
                    <input type="number" class="form-control" name="maxi" value="{{$action->maxi}}"id="maxi">
                  </div>

                  <label>Seuil : </label>
                  <div class="form-group">
                    <input type="number" class="form-control " name="a1" value="{{$action->a1}}" id="seuil">
                  </div>
                  <input  type="hidden" name="ismodif" value="123143-00292-20291">
                  <br>
                  {!! csrf_field() !!}
                  <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                    <button type="submit" class="btn btn-primary mr-sm-1 mb-1 mb-sm-0">Save
                      changes</button>
                    <button type="reset" class="btn btn-outline-warning">Cancel</button>
                  </div>
                </form>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- account setting page end -->
@endsection

@section('vendor-script')
  <!-- vendor files -->
  <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/forms/validation/jqBootstrapValidation.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/pickers/pickadate/picker.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/pickers/pickadate/picker.date.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/extensions/dropzone.min.js')) }}"></script>
@endsection
@section('page-script')
  <!-- Page js files -->
  <script src="{{ asset(mix('js/scripts/pages/account-setting.js')) }}"></script>
@endsection
