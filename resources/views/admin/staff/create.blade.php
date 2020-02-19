@extends('layouts.admin')

@section('title', 'Add a Staff')

@section('content-header', 'Add a Staff')

@section('breadcrumb')
    <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i>Dasboard</a></li>
    <li><a href="{{route('admin.staff')}}"><i class="fa fa-suitcase"></i> Staffs</a></li>
    <li class="active">Add a Staff</li>
@endsection

@section('content')

@include('notification.notify')
  <div class="row">
    <div class="col-md-10">
      <div class="box box-primary">

        <div class="box-header with-border">
           <h3 class="box-title">Add a Staff</h3>
           <div class="box-tools pull-right">
              <a href="{{route('admin.staff')}}" class="btn btn-default pull-right">Staffs</a>
           </div>
        </div>

        <form class="form-horizontal" action="{{route('admin.staff.store')}}" method="POST" enctype="multipart/form-data" role="form">
          {{ csrf_field() }}
          <div class="box-body">
            <div class="form-group">
              <label for="name" class="col-sm-2 control-label">Name</label>
              <div class="col-sm-10">
                  <input type="text" required class="form-control" id="name" name="name" value="{{ old('name') }}" placeholder="Full Name">
              </div>
            </div>

            <div class="form-group">
              <label for="designation" class="col-sm-2 control-label">Designation</label>
              <div class="col-sm-10">
                  <input type="text" required class="form-control" id="designation" name="designation" value="{{ old('designation') }}" placeholder="Designation">
              </div>
            </div>

            <div class="form-group">
              <label for="section" class="col-sm-2 control-label">Section</label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="section" name="section" value="{{ old('section') }}" placeholder="Section">
              </div>
            </div>

            <div class="form-group">
              <label for="employee_type" class="col-sm-2 control-label">Employee Type</label>
              <div class="col-sm-10">
                <select class="form-control" id="employee_type" name="employee_type">
                  <option value="1" {{ old('employee_type') == '1' ? 'selected' : false }}>जन प्रतिनिधि</option>
                  <option value="2" {{ old('employee_type') == '2' ? 'selected' : false }}>प्रतिनिधि</option>
                  <option value="3" {{ old('employee_type') == '3' ? 'selected' : false }}>कर्मचारी</option>
                </select>
              </div>
            </div>

            <div class="form-group">
              <label for="phone" class="col-sm-2 control-label">Phone</label>
              <div class="col-sm-10">
                  <input type="text" required class="form-control" id="phone" name="phone" value="{{ old('phone') }}" placeholder="Phone">
              </div>
            </div>

            <div class="form-group">
              <label for="email" class="col-sm-2 control-label">email</label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="email" name="email" value="{{ old('email') }}" placeholder="email">
              </div>
            </div>

            <div class="form-group">
              <label for="room_no" class="col-sm-2 control-label">Room No.</label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="room_no" name="room_no" value="{{ old('room_no') }}" placeholder="Room Number">
              </div>
            </div>

            <div class="form-group">
              <label for="file" class="col-sm-2 control-label">Photo</label>
              <div class="col-sm-10">
                  <input type="file" required accept="image/png, image/jpeg, image/jpg" id="file" name="file" placeholder="Photo">
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