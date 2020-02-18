@extends('layouts.admin')

@section('title', 'Edit a Staff')

@section('content-header', 'Edit a Staff')

@section('breadcrumb')
    <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i>Dasboard</a></li>
    <li><a href="{{route('admin.staff')}}"><i class="fa fa-suitcase"></i> Staffs</a></li>
    <li class="active">Edit a Staff</li>
@endsection

@section('content')

@include('notification.notify')
  <div class="row">
    <div class="col-md-10">
      <div class="box box-primary">

        <div class="box-header with-border">
           <h3 class="box-title">Edit a Staff ({{ $staff->name }})</h3>
           <div class="box-tools pull-right">
              <a href="{{route('admin.staff')}}" class="btn btn-default pull-right">Staffs</a>
           </div>
        </div>

        <form class="form-horizontal" action="{{route('admin.staff.update', $staff->id)}}" method="POST" enctype="multipart/form-data" role="form">
          {{ csrf_field() }}
          <div class="box-body">
            <div class="form-group">
              <label for="name" class="col-sm-2 control-label">Name</label>
              <div class="col-sm-10">
                  <input type="text" required class="form-control" id="name" name="name" value="{{ old('name') ?: $staff->name }}" placeholder="Full Name">
              </div>
            </div>

            <div class="form-group">
              <label for="designation" class="col-sm-2 control-label">Designation</label>
              <div class="col-sm-10">
                  <input type="text" required class="form-control" id="designation" name="designation" value="{{ old('designation') ?: $staff->designation }}" placeholder="Designation">
              </div>
            </div>

            <div class="form-group">
              <label for="section" class="col-sm-2 control-label">Section</label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="section" name="section" value="{{ old('section') ?: $staff->section }}" placeholder="Section">
              </div>
            </div>

            <div class="form-group">
              <label for="phone" class="col-sm-2 control-label">Phone</label>
              <div class="col-sm-10">
                  <input type="text" required class="form-control" id="phone" name="phone" value="{{ old('phone') ?: $staff->phone }}" placeholder="Phone">
              </div>
            </div>

            <div class="form-group">
              <label for="email" class="col-sm-2 control-label">email</label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="email" name="email" value="{{ old('email') ?: $staff->email }}" placeholder="email">
              </div>
            </div>

            <div class="form-group">
              <label for="room_no" class="col-sm-2 control-label">Room No.</label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="room_no" name="room_no" value="{{ old('room_no') ?: $staff->room_no }}" placeholder="Room Number">
              </div>
            </div>

            <div class="form-group">
              <label for="file" class="col-sm-2 control-label">Photo</label>
              <div class="col-sm-10">
                  <img style="height: 90px;margin-bottom: 15px; border-radius:2em;" src="{{ $staff->photo_full_path }}">
                  <input type="file" accept="image/png, image/jpeg, image/jpg" id="file" name="file" placeholder="Photo">
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