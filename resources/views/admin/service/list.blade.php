@extends('layouts.admin')

@section('title', 'Services')

@section('content-header', 'Services')

@section('breadcrumb')
	<li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
	<li class="active"><i class="fa fa-suitcase"></i> Services</li>
@endsection

@section('content')

@include('notification.notify')

	<div class="row">
    <div class="col-xs-12">
      <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">List of Services</h3>
            <div class="box-tools pull-right">
            		<a href="{{route('admin.service.create')}}" class="btn btn-default pull-right">Add a Service</a>
            </div>
        </div>
        <div class="box-body">

        	@if(count($services) > 0)

          	<table id="example1" class="table table-bordered table-striped">
							<thead>
						    <tr>
						      <th>SN.</th>
						      <th>Title</th>
						      <th>Detail</th>
						      <th>Created At</th>
						      <th>action</th>
						    </tr>
							</thead>

							<tbody>
								@foreach($services as $key => $service)
							    <tr>
						      	<td>{{ $services->firstItem() + $key }}</td>
						      	<td>{{ $service->title }}</td>
						      	<td>{!! substr($service->detail, 0, 300) !!}</td>
						      	<td>{{ $service->created_at->format('Y-m-d') }}</td>
							      <td>
        							<ul class="admin-action btn btn-default">
        								<li class="dropup">
						                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
						                  action <span class="caret"></span>
						                </a>
						                <ul class="dropdown-menu">
						                  	<li role="presentation">
                                  <a role="menuitem" tabindex="-1" href="{{route('admin.service.edit' , array('id' => $service->id))}}">Edit</a>
                                </li>
						                  	<li role="presentation">
					                  			<a role="menuitem" tabindex="-1" onclick="return confirm('Are you sure?')" href="{{route('admin.service.delete' , array('id' => $service->id))}}">Delete</a>
						                  	</li>
						                </ul>
          								</li>
        							</ul>
							      </td>
							    </tr>
								@endforeach
							</tbody>
						</table>
						{{ $services->links() }}
					@else
						<h3 class="no-result">No results found</h3>
					@endif
        </div>
      </div>
    </div>
  </div>

@endsection
