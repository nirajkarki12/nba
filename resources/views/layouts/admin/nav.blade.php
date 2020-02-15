<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="@if(Auth::guard('admin')->user()->picture){{Auth::guard('admin')->user()->picture}} @else {{asset('images/placeholder.jpg')}} @endif" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{Auth::guard('admin')->user()->name}}</p>
                <a href="{{route('admin.profile')}}">{{Auth::guard('admin')->user()->email}}</a>
            </div>
        </div>

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">

            <li id="dashboard">
              <a href="{{route('admin.dashboard')}}">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
              </a>
            </li>

            <li class="treeview" id="categories">
                <a href="{{route('admin.video')}}">
                    <i class="fa fa-suitcase"></i> <span>Videos</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li id="add-video"><a href="{{route('admin.video.create')}}"><i class="fa fa-circle-o"></i>Add Video</a></li>
                    <li id="view-videos"><a href="{{route('admin.video')}}"><i class="fa fa-circle-o"></i>List Videos</a></li>
                </ul>
            </li>

            <li class="treeview" id="categories">
                <a href="{{route('admin.notice')}}">
                    <i class="fa fa-suitcase"></i> <span>Notices</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li id="add-notice"><a href="{{route('admin.notice.create')}}"><i class="fa fa-circle-o"></i>Add Notice</a></li>
                    <li id="view-notices"><a href="{{route('admin.notice')}}"><i class="fa fa-circle-o"></i>List Notices</a></li>
                </ul>
            </li>

            <li class="treeview" id="categories">
                <a href="{{route('admin.service')}}">
                    <i class="fa fa-suitcase"></i> <span>Services</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li id="add-service"><a href="{{route('admin.service.create')}}"><i class="fa fa-circle-o"></i>Add Service</a></li>
                    <li id="view-services"><a href="{{route('admin.service')}}"><i class="fa fa-circle-o"></i>List Services</a></li>
                </ul>
            </li>

        </ul>

    </section>

    <!-- /.sidebar -->

</aside>