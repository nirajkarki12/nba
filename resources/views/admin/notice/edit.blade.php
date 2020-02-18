@extends('layouts.admin')

@section('title', 'Edit Notice')

@section('content-header', 'Edit Notice')

@section('breadcrumb')
    <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i>Dasboard</a></li>
    <li><a href="{{route('admin.notice')}}"><i class="fa fa-suitcase"></i> Notices</a></li>
    <li class="active">Edit a Notice</li>
@endsection

@section('content')

@include('notification.notify')
  <div class="row">
    <div class="col-md-10">
      <div class="box box-primary">

        <div class="box-header with-border">
           <h3 class="box-title">Edit a Notice ({{ $notice->title }})</h3>
           <div class="box-tools pull-right">
              <a href="{{route('admin.notice')}}" class="btn btn-default pull-right">Notices</a>
           </div>
        </div>

        <form class="form-horizontal" action="{{route('admin.notice.update', $notice->id)}}" method="POST" enctype="multipart/form-data" role="form">
          {{ csrf_field() }}
          <div class="box-body">
            <div class="form-group">
              <label for="title" class="col-sm-1 control-label">Title</label>
              <div class="col-sm-10">
                  <input type="text" required class="form-control" id="title" name="title" value="{{ old('title') ?: $notice->title }}" placeholder="Notice Title">
              </div>
            </div>

            <div class="form-group">
              <label for="description" class="col-sm-1 control-label">Description</label>
              <div class="col-sm-10">
                  <input type="text" required class="form-control" id="description" name="description" value="{{ old('description') ?: $notice->description }}" placeholder="Description">
              </div>
            </div>

            <div class="form-group">
              <label for="file" class="col-sm-1 control-label">Image</label>
              <div class="col-sm-10">
                  <img style="height: 90px;margin-bottom: 15px; border-radius:2em;" src="{{ $notice->image_full_path }}">
                  <input type="file" accept="image/png, image/jpeg, image/jpg" id="file" name="file" placeholder="Image">
                  <p class="help-block">Please enter .png .jpeg .jpg images only.</p>
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