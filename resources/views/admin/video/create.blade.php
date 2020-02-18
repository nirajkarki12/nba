@extends('layouts.admin')

@section('title', 'Add a Video')

@section('content-header', 'Add a Video')

@section('breadcrumb')
    <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i>Dasboard</a></li>
    <li><a href="{{route('admin.video')}}"><i class="fa fa-suitcase"></i> Videos</a></li>
    <li class="active">Add a Video</li>
@endsection

@section('content')

@include('notification.notify')
  <div class="row">
    <div class="col-md-10">
      <div class="box box-primary">

        <div class="box-header with-border">
           <h3 class="box-title">Add a Video</h3>
           <div class="box-tools pull-right">
              <a href="{{route('admin.video')}}" class="btn btn-default pull-right">Videos</a>
           </div>
        </div>

        <form class="form-horizontal" action="{{route('admin.video.store')}}" method="POST" enctype="multipart/form-data" role="form">
          {{ csrf_field() }}
          <div class="box-body">
            <div class="form-group">
              <label for="title" class="col-sm-1 control-label">Title</label>
              <div class="col-sm-10">
                  <input type="text" required class="form-control" id="title" name="title" value="{{ old('title') }}" placeholder="Video Title">
              </div>
            </div>

            <div class="form-group">
              <label for="url" class="col-sm-1 control-label">Youtube URL</label>
              <div class="col-sm-10">
                  <input type="url" required class="form-control" id="url" name="url" value="{{ old('url') }}" placeholder="Youtube URL">
              </div>
            </div>

            <div class="form-group">
              <label for="videoId" class="col-sm-1 control-label">Youtube Id</label>
              <div class="col-sm-10">
                  <input type="text" required class="form-control" id="videoId" name="videoId" value="{{ old('videoId') }}" placeholder="Youtube Id">
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