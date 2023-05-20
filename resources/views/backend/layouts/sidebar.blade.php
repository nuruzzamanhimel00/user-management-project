<div class="sidebar-menu">
    <div class="sidebar-header">
        <div class="logo">
            <a href="index.html"><img src="{{asset('backend/assets/images/icon/logo.png')}}" alt="logo"></a>
        </div>
    </div>
    <div class="main-menu">
        <div class="menu-inner">
            <nav>
                <ul class="metismenu" id="menu">
                    @can('Dashboard View')
                    <li><a href="{{route('home')}}"><i class="ti-dashboard"></i> <span>Dashboard</span></a></li>
                    @endcan
                    @canany(['Roles List',
                    'Roles Edit',
                    'Roles Add',
                    'Roles Store',
                    'Roles Delete',
                    'User List',
                    'User Edit',
                    'User Add',
                    'User Store',
                    'User Delete',
                    ])
                    <li class="active">

                        <a href="javascript:void(0)" aria-expanded="true"><i class="ti-dashboard"></i><span>Administration </span></a>

                        <ul class="collapse">
                            @can('Roles List')
                            <li class="active"><a href="{{route('roles.index')}}">Role</a></li>
                            @endcan
                            @can('User List')

                            <li><a href="{{route('users.index')}}">User</a></li>
                            @endcan
                        </ul>
                    </li>
                    @endcanany

                    <li class="active">
                        <a href="javascript:void(0)" aria-expanded="true"><i class="ti-dashboard"></i><span>dashboard</span></a>
                        <ul class="collapse">
                            <li class="active"><a href="index.html">ICO dashboard</a></li>
                            <li><a href="index2.html">Ecommerce dashboard</a></li>
                            <li><a href="index3.html">SEO dashboard</a></li>
                        </ul>
                    </li>

                </ul>
            </nav>
        </div>
    </div>
</div>
