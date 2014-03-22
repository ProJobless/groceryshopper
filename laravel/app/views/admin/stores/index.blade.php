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
	 <a href="{{{ URL::to('admin/stores') }}}" title="{{{ $title }}}" class="tip-bottom"><i class="fa fa-th"></i>{{{ $title }}}</a>

@stop

{{-- Content --}}
@section('content')
  <div class="row">
    <div class="col-xs-12">
      <div class="pull-right">
        <a href="{{{ URL::to('admin/stores/create') }}}" class="btn btn-small btn-info iframe"><span class="glyphicon glyphicon-plus-sign"></span> Create</a>
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
          <h5>List of Stores</h5>
        </div>
        <div class="widget-content nopadding">
          <table class="table table-bordered table-striped table-hover data-table">
            <thead>
              <tr>
                <th >{{{ Lang::get('admin/stores/table.title') }}}</th>
                <th >{{{ Lang::get('admin/stores/table.chain_id') }}}</th>
                <th >{{{ Lang::get('admin/stores/table.city') }}}</th>
                <th >{{{ Lang::get('admin/stores/table.province_state') }}}</th>
                <th >{{{ Lang::get('admin/stores/table.phone_1') }}}</th>
                <th >{{{ Lang::get('admin/stores/table.address') }}}</th>
                <th >{{{ Lang::get('admin/stores/table.updated_at') }}}</th>
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
          "sLengthMenu": "_MENU_ stores per page"
        },
        "bServerSide": true,
        "sAjaxSource": "{{ URL::to('admin/stores/data') }}",
      });
      $('select').select2();
    });
  </script>
@stop
