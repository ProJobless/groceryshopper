@extends('admin.layouts.default')

{{-- Web site Title --}}
@section('title')
  {{{ $title }}} :: @parent
@stop

@section('keywords')Stores administration @stop
@section('author')Grocery Shopper @stop
@section('description')Stores administration index @stop

{{-- Page Title --}}
@section('pagetitle')
  {{{ $title }}}
@stop

{{-- Breadcrumbs --}}
@section('breadcrumb')
   @parent
   <a href="{{{ URL::to('admin/chains') }}}" title="Manage chains" class="tip-bottom">
      <i class="fa fa-user"></i> chains
   </a>
@stop

{{-- Content --}}
@section('content')
  <div class="row">
    <div class="col-xs-12">
      <div class="pull-right">
        <a href="{{{ URL::to('admin/chains/create') }}}" class="btn btn-small btn-info iframe">
          <span class="glyphicon glyphicon-plus-sign"></span> Create
        </a>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-xs-12">
      <!-- Notifications -->
      @include('notifications')
      <!-- ./ notifications -->
      <div class="widget-box">
        <div class="widget-title">
          <span class="icon"><i class="fa fa-signal"></i></span>
          <h5>List of chains</h5>
        </div>
        <div class="widget-content nopadding">
          <table class="table table-bordered table-striped table-hover data-table">
            <thead>
              <tr>
                <th >{{{ Lang::get('admin/chains/table.chain_name') }}}</th>
                <th >{{{ Lang::get('admin/chains/table.url') }}}</th>
                <th >{{{ Lang::get('admin/chains/table.alternate_name') }}}</th>
                <th >{{{ Lang::get('admin/chains/table.updated_at') }}}</th>
                <th >{{{ Lang::get('table.actions') }}}</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

@stop

{{-- Scripts --}}
@section('scripts')
  <script type="text/javascript">
    var oTable;
    $(document).ready(function(){
      $('.data-table').dataTable({
        "bJQueryUI": true,
        "sPaginationType": "full_numbers",
        "sDom": '<""l>t<"F"fp>',
        "oLanguage": {
          "sLengthMenu": "_MENU_ chains per page"
        },
        "bServerSide": true,
        "sAjaxSource": "{{ URL::to('admin/chains/data') }}",
      });
      $('select').select2();
    });
  </script>
@stop
