@extends('layouts.admin')

@section('title', 'Notices')

@section('content-header', 'Notices')

@section('breadcrumb')
	<li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
	<li class="active"><i class="fa fa-suitcase"></i> Notices</li>
@endsection

@section('content')

@include('notification.notify')

	<div class="row">
    <div class="col-xs-12">
      <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">List of Notices</h3>
            <div class="box-tools pull-right">
            		<a href="{{route('admin.notice.create')}}" class="btn btn-default pull-right">Add a Notice</a>
            </div>
        </div>
        <div class="box-body">

        	@if(count($notices) > 0)

          	<table id="example1" class="table table-bordered table-striped">
							<thead>
						    <tr>
						      <th>SN.</th>
						      <th>Title</th>
						      <th>Description</th>
						      <th>Image</th>
						      <th>Created At</th>
						      <th>action</th>
						    </tr>
							</thead>

							<tbody>
								@foreach($notices as $key => $notice)
							    <tr>
						      	<td>{{ $notices->firstItem() + $key }}</td>
						      	<td>{{ $notice->title }}</td>
						      	<td>{{ $notice->description }}</td>
						      	<td><img src="{{ $notice->image_full_path }}" width="80" class="img-fluid"></td>
						      	<td>{{ $notice->created_at->format('Y-m-d') }}</td>
							      <td>
        							<ul class="admin-action btn btn-default">
        								<li class="dropup">
						                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
						                  action <span class="caret"></span>
						                </a>
						                <ul class="dropdown-menu">
						                  	<li role="presentation">
                                  <a role="menuitem" tabindex="-1" href="{{route('admin.notice.edit' , array('id' => $notice->id))}}">Edit</a>
                                </li>
						                  	<li role="presentation">
					                  			<a role="menuitem" tabindex="-1" onclick="return confirm('Are you sure?')" href="{{route('admin.notice.delete' , array('id' => $notice->id))}}">Delete</a>
						                  	</li>
						                </ul>
          								</li>
        							</ul>
							      </td>
							    </tr>
								@endforeach
							</tbody>
						</table>
						{{ $notices->links() }}
					@else
						<h3 class="no-result">No results found</h3>
					@endif
        </div>
      </div>
    </div>
  </div>

@endsection
