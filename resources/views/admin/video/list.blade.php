@extends('layouts.admin')

@section('title', 'Videos')

@section('content-header', 'Videos')

@section('breadcrumb')
	<li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
	<li class="active"><i class="fa fa-suitcase"></i> Videos</li>
@endsection

@section('content')

@include('notification.notify')

	<div class="row">
    <div class="col-xs-12">
      <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">List of Videos</h3>
            <div class="box-tools pull-right">
            		<a href="{{route('admin.video.create')}}" class="btn btn-default pull-right">Add a Video</a>
            </div>
        </div>
        <div class="box-body">

        	@if(count($videos) > 0)

          	<table id="example1" class="table table-bordered table-striped">
							<thead>
						    <tr>
						      <th>SN.</th>
						      <th>Title</th>
						      <th>URL</th>
						      <th>Video Id</th>
						      <th>Created At</th>
						      <th>action</th>
						    </tr>
							</thead>

							<tbody>
								@foreach($videos as $key => $video)
							    <tr>
						      	<td>{{ $videos->firstItem() + $key }}</td>
						      	<td>{{ $video->title }}</td>
						      	<td>{{ $video->url }}</td>
						      	<td>{{ $video->videoId }}</td>
						      	<td>{{ $video->created_at->format('Y-m-d') }}</td>
							      <td>
        							<ul class="admin-action btn btn-default">
        								<li class="dropup">
						                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
						                  action <span class="caret"></span>
						                </a>
						                <ul class="dropdown-menu">
						                  	<li role="presentation">
                                  <a role="menuitem" tabindex="-1" href="{{route('admin.video.edit' , array('id' => $video->id))}}">Edit</a>
                                </li>
						                  	<li role="presentation">
					                  			<a role="menuitem" tabindex="-1" onclick="return confirm('Are you sure?')" href="{{route('admin.video.delete' , array('id' => $video->id))}}">Delete</a>
						                  	</li>
						                </ul>
          								</li>
        							</ul>
							      </td>
							    </tr>
								@endforeach
							</tbody>
						</table>
						{{ $videos->links() }}
					@else
						<h3 class="no-result">No results found</h3>
					@endif
        </div>
      </div>
    </div>
  </div>

@endsection
