@extends('admin.layouts.default')

{{-- Web site Title --}}
@section('title')
{{{ $title }}} :: @parent
@stop

@section('keywords')Stores administration @stop
@section('author')Grocery Shopper @stop
@section('description')Stores administration index @stop

{{-- Content --}}
@section('content')
  <div class="page-header">
    <h3>
      {{{ $title }}}

      <div class="pull-right">
        <a href="{{{ URL::to('admin/stores/create') }}}" class="btn btn-small btn-info iframe"><span class="glyphicon glyphicon-plus-sign"></span> Create</a>
      </div>
    </h3>
  </div>

  <table id="stores" class="table table-striped table-hover">
    <thead>
      <tr>
        <th class="col-md-4">{{{ Lang::get('admin/stores/table.title') }}}</th>
        <th class="col-md-2">{{{ Lang::get('admin/stores/table.name') }}}</th>
        <th class="col-md-2">{{{ Lang::get('admin/stores/table.phone_1') }}}</th>
        <th class="col-md-2">{{{ Lang::get('admin/stores/table.address') }}}</th>
        <th class="col-md-2">{{{ Lang::get('admin/stores/table.city') }}}</th>
        <th class="col-md-2">{{{ Lang::get('admin/stores/table.province') }}}</th>
        <th class="col-md-2">{{{ Lang::get('admin/stores/table.updated_at') }}}</th>
        <th class="col-md-2">{{{ Lang::get('table.actions') }}}</th>
      </tr>
    </thead>
    <tbody>
    </tbody>
  </table>
@stop

{{-- Scripts --}}
@section('scripts')
  <script type="text/javascript">
    var oTable;
    $(document).ready(function() {
      oTable = $('#stores').dataTable( {
        "sDom": "<'row'<'col-md-6'l><'col-md-6'f>r>t<'row'<'col-md-6'i><'col-md-6'p>>",
        "sPaginationType": "bootstrap",
        "oLanguage": {
          "sLengthMenu": "_MENU_ records per page"
        },
        "bProcessing": true,
        "bServerSide": true,
        "sAjaxSource": "{{ URL::to('admin/stores/data') }}",
        "fnDrawCallback": function ( oSettings ) {
          $(".iframe").colorbox({iframe:true, width:"80%", height:"80%"});
          }
      });
    });
  </script>
@stop
