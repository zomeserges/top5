
@extends('layouts/contentLayoutMaster')

@section('title', 'DataTables')

@section('vendor-style')
  {{-- vendor css files --}}
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/datatables.min.css')) }}">
@endsection

@section('content')

  <!-- Zero configuration table -->

  <section id="column-selectors">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Liste des Indicateur <span><a href="/app-indicateur-index" class="btn btn-primary">Nouveau Indicateur</a></span></h4>
          </div>
          <div class="card-content">
            <div class="card-body card-dashboard">
              <div class="table-responsive">
                <table class="table table-striped dataex-html5-selectors">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Indicateur</th>
                    <th>Responsable</th>
                    <th>Description</th>
                    <th>Direction</th>
                    <th>Origine</th>
                    <th>SQDIP</th>
                    <th>Valeur min</th>
                    <th>Valeur obtenue</th>
                    <th>Valeur Max</th>
                    <th>Seuil</th>
                    <th></th>
                    <th>Action</th>
                    <th></th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($indicateurs as $indicateur)
                    <tr>
                      <td>{{$indicateur->idindicateur}}</td>
                      <td>{{$indicateur->indicateur}}</td>
                      <td>{{$indicateur->responsable}}</td>
                      <td><?php echo $indicateur->description?></td>
                      <td>{{$indicateur->direction}}</td>
                      <td>{{$indicateur->origine}}</td>
                      <td>{{$indicateur->sqdip}}</td>
                      <td>{{$indicateur->mini}}</td>
                      <td>{{$indicateur->valeur}}</td>
                      <td>{{$indicateur->maxi}}</td>
                      <td>{{$indicateur->a1}}</td>
                      <td><a href="{{asset("app-indicateur-detail")}}/{{$indicateur->idindicateur}}"><i class='infos-edit-icon feather icon-edit-1 mr-50'></i></a></td>
                         <td><a href=""><i class=' feather icon-trash-2'></i></a></td>
                          <td><a href="{{asset("app-indicateur-detail")}}//{{$indicateur->idindicateur}}"><i class='feather icon-eye mr-50'></i></a></td>


                    </tr>
                  @endforeach


                  </tbody>
                  <tfoot>
                  <tr>
                    <th>ID</th>
                    <th>Indicateur</th>
                    <th>Responsable</th>
                    <th>Description</th>
                    <th>Direction</th>
                    <th>Origine</th>
                    <th>SQDIP</th>
                    <th>Valeur min</th>
                    <th>Valeur obtenue</th>
                    <th>Valeur Max</th>
                    <th>Seuil</th>
                    <th>Action</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Column selectors with Export Options and print table -->

  <!-- Column selectors with Export Options and print table -->


@endsection
@section('vendor-script')
  {{-- vendor files --}}
  <script src="{{ asset(mix('vendors/js/tables/datatable/pdfmake.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/vfs_fonts.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/datatables.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/datatables.buttons.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/buttons.html5.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/buttons.print.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/buttons.bootstrap.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/datatables.bootstrap4.min.js')) }}"></script>
@endsection
@section('page-script')
  {{-- Page js files --}}
  <script src="{{ asset(mix('js/scripts/datatables/datatable.js')) }}"></script>
@endsection
