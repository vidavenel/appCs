<ul class="sidebar-menu">
    <li class="header">HEADER</li>
    {{-- menu SMS --}}
    <li class="treeview active">
        <a href="javascript:void(0)">
            <i class="fa fa-envelope-o"></i> <span>SMS</span>
            <span class="pull-right-container">
                              <i class="fa fa-angle-left pull-right"></i>
                            </span>
        </a>
        <ul class="treeview-menu">
            <li class="active"><a href="{{route('sms.index')}}"><i class="fa fa-list-ul"></i> Liste</a></li>
            <li><a href="{{route('sms.create')}}"><i class="fa fa-plus"></i> Creer</a></li>
        </ul>
    </li>
    @can('admin')
    {{-- menu agent --}}
    <li class="treeview">
        <a href="javascript:void(0)">
            <i class="fa fa-user"></i> <span>Agent</span>
            <span class="pull-right-container">
                              <i class="fa fa-angle-left pull-right"></i>
                            </span>
        </a>
        <ul class="treeview-menu">
            <li><a href="{{route('agent.index')}}"><i class="fa fa-list-ul"></i> Liste</a></li>
            <li><a href="{{route('agent.create')}}"><i class="fa fa-plus"></i> Creer</a></li>
        </ul>
    </li>

    {{-- menu groupe --}}
    <li class="treeview">
        <a href="javascript:void(0)">
            <i class="fa fa-users"></i> <span>Groupe</span>
            <span class="pull-right-container">
                              <i class="fa fa-angle-left pull-right"></i>
                            </span>
        </a>
        <ul class="treeview-menu">
            <li><a href="{{route('groupe.index')}}"><i class="fa fa-list-ul"></i> Liste</a></li>
            <li><a href="{{route('groupe.create')}}"><i class="fa fa-plus"></i> Creer</a></li>
        </ul>
    </li>

    {{-- menu utilisateur --}}
    <li class="treeview">
        <a href="javascript:void(0)">
            <i class="fa fa-users"></i> <span>Utilisateur</span>
            <span class="pull-right-container">
                              <i class="fa fa-angle-left pull-right"></i>
                            </span>
        </a>
        <ul class="treeview-menu">
            <li><a href="{{route('user.index')}}"><i class="fa fa-list-ul"></i> Liste</a></li>
            <li><a href="{{route('user.create')}}"><i class="fa fa-plus"></i> Creer</a></li>
        </ul>
    </li>
        @endcan
</ul>