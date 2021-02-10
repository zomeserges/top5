
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
            <h4 class="card-title">Liste des action <span><a href="/app-action-index" class="btn btn-primary">Nouveau action</a></span></h4>
          </div>
          <div class="card-content">
            <div class="card-body card-dashboard">
              <div class="table-responsive">
                <table class="table table-striped dataex-html5-selectors">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>action</th>
                    <th>Responsable</th>
                    <th>Direction</th>
                    <th>SQDIP</th>
                    <th>PDCA</th>
                    <th>Escalade</th>
                    <th>GID</th>
                    <th>Origine</th>
                    <th></th>
                    <th>Action</th>
                    <th></th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($actions as $action)
                    <tr>
                      <td>{{$action->idaction}}</td>
                      <td><?php echo $action->action?></td>
                      <td>{{$action->responsable}}</td>
                      <td>{{\App\Models\Direction::query()->where("iddirection","=",$action->iddirection)->first()->direction}}</td>
                      <td>{{\App\Models\Sqdip::query()->where("idsqdip","=",$action->idsqdip)->first()->sqdip}}</td>
                      <td>{{\App\Models\Pdca::query()->where("idpdca","=",$action->idpdca)->first()->etat}}</td>
                      <td>{{\App\Models\Escalade::query()->where("idescalade","=",$action->idescalade)->first()->escalade}}</td>
                      <td>{{\App\Models\Gid::query()->where("idgid","=",$action->idgid)->first()->gid}}</td>
                      <td>{{\App\Models\Origine::query()->where("idorigine","=",$action->idorigine)->first()->origine}}</td>
                      <td><a href="{{asset("app-action-detail")}}/{{$action->idaction}}"><i class='infos-edit-icon feather icon-edit-1 mr-50'></i></a></td>
                      <td><a href=""><i class=' feather icon-trash-2'></i></a></td>
                      <td><a href="{{asset("app-action-detail")}}//{{$action->idaction}}"><i class='feather icon-eye mr-50'></i></a></td>


                    </tr>
                  @endforeach


                  </tbody>
                  <tfoot>
                  <tr>
                    <th>ID</th>
                    <th>action</th>
                    <th>Responsable</th>
                    <th>Direction</th>
                    <th>SQDIP</th>
                    <th>PDCA</th>
                    <th>Escalade</th>
                    <th>GID</th>
                    <th>Origine</th>
                    <th></th>
                    <th>Action</th>
                    <th></th>
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
