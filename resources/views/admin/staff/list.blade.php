@extends('layouts.admin')

@section('title', 'Staffs')

@section('content-header', 'Staffs')

@section('breadcrumb')
	<li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
	<li class="active"><i class="fa fa-suitcase"></i> Staffs</li>
@endsection

@section('content')

@include('notification.notify')

	<div class="row">
    <div class="col-xs-12">
      <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">List of Staffs</h3>
            <div class="box-tools pull-right">
            		<a href="{{route('admin.staff.create')}}" class="btn btn-default pull-right">Add a Staff</a>
            </div>
        </div>
        <div class="box-body">

        	@if(count($staffs) > 0)

          	<table id="example1" class="table table-bordered table-striped">
							<thead>
						    <tr>
						      <th>SN.</th>
						      <th>Name</th>
						      <th>Designation</th>
						      <th>Section</th>
						      <th>Phone</th>
						      <th>Email</th>
						      <th>Room No.</th>
						      <th>Photo</th>
						      <th>Created At</th>
						      <th>action</th>
						    </tr>
							</thead>

							<tbody>
								@foreach($staffs as $key => $staff)
							    <tr>
						      	<td>{{ $staffs->firstItem() + $key }}</td>
						      	<td>{{ $staff->name }}</td>
						      	<td>{{ $staff->designation }}</td>
						      	<td>{{ $staff->section }}</td>
						      	<td>{{ $staff->phone }}</td>
						      	<td>{{ $staff->email }}</td>
						      	<td>{{ $staff->room_no }}</td>
						      	<td><img src="{{ $staff->photo_full_path }}" width="80" class="img-fluid"></td>
						      	<td>{{ $staff->created_at->format('Y-m-d') }}</td>
							      <td>
        							<ul class="admin-action btn btn-default">
        								<li class="dropup">
						                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
						                  action <span class="caret"></span>
						                </a>
						                <ul class="dropdown-menu">
						                  	<li role="presentation">
                                  <a role="menuitem" tabindex="-1" href="{{route('admin.staff.edit' , array('id' => $staff->id))}}">Edit</a>
                                </li>
						                  	<li role="presentation">
					                  			<a role="menuitem" tabindex="-1" onclick="return confirm('Are you sure?')" href="{{route('admin.staff.delete' , array('id' => $staff->id))}}">Delete</a>
						                  	</li>
						                </ul>
          								</li>
        							</ul>
							      </td>
							    </tr>
								@endforeach
							</tbody>
						</table>
						{{ $staffs->links() }}
					@else
						<h3 class="no-result">No results found</h3>
					@endif
        </div>
      </div>
    </div>
  </div>

@endsection
