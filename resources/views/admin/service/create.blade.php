@extends('layouts.admin')

@section('title', 'Add a Service')

@section('content-header', 'Add a Service')

@section('breadcrumb')
    <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i>Dasboard</a></li>
    <li><a href="{{route('admin.service')}}"><i class="fa fa-suitcase"></i> Services</a></li>
    <li class="active">Add a Service</li>
@endsection

@section('content')

@include('notification.notify')
  <div class="row">
    <div class="col-md-10">
      <div class="box box-primary">

        <div class="box-header with-border">
           <h3 class="box-title">Add a Service</h3>
           <div class="box-tools pull-right">
              <a href="{{route('admin.service')}}" class="btn btn-default pull-right">Services</a>
           </div>
        </div>

        <form class="form-horizontal" action="{{route('admin.service.store')}}" method="POST" enctype="multipart/form-data" role="form">
          {{ csrf_field() }}
          <div class="box-body">
            <div class="form-group">
              <label for="title" class="col-sm-1 control-label">Title</label>
              <div class="col-sm-10">
                  <input type="text" required class="form-control" id="title" name="title" placeholder="Title">
              </div>
            </div>

            <div class="form-group">
              <label for="detail" class="col-sm-1 control-label">Detail</label>
              <div class="col-sm-10">
                <textarea id="detail" name="detail" rows="10" cols="80"></textarea>
              </div>
            </div>


          </div>

          <div class="box-footer">
              <button type="reset" class="btn btn-danger">Cancel</button>
              <button type="submit" class="btn btn-success pull-right">Save</button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection

@section('scripts')
<script src="{{ asset('vendor/bower_components/ckeditor/ckeditor.js') }}"></script>
<script type="text/javascript">
  $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('detail')
    //bootstrap WYSIHTML5 - text editor
    $('.textarea').wysihtml5()
  });
</script>
@endsection

