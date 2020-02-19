@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content-header', 'Dashboard')

@section('breadcrumb')
    <li class="active"><i class="fa fa-dashboard"></i> Dashboard</a></li>
@endsection

@section('content')

@include('notification.notify')
  <div class="row">
    <div class="col-md-10">
      <div class="box box-primary">

        <div class="box-header with-border">
           <h3 class="box-title">Scrolling Notices</h3>
        </div>

        <form class="form-horizontal" action="{{route('admin.news.save')}}" method="POST" role="form">
          {{ csrf_field() }}
          <div class="box-body">
            <div class="form-group">
              <div class="col-sm-12">
                <textarea id="news" name="news" rows="10" cols="80">{{ old('news') ?: $news->value }}</textarea>
              </div>
            </div>


          </div>

          <div class="box-footer">
              <button type="submit" class="btn btn-success">Save</button>
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
    CKEDITOR.replace('news')
    //bootstrap WYSIHTML5 - text editor
    $('.textarea').wysihtml5()
  });
</script>
@endsection
