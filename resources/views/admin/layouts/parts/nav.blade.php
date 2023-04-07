<div class="side-nav">
    <div class="side-nav-inner">
        <ul class="side-nav-menu scrollable">
            <li class="nav-item dropdown">
                <a href="{{route('home')}}">
                    <span class="icon-holder">
                        <i class="anticon anticon-dashboard"></i>
                    </span>
                    <span class="title">Dashboard</span>
                </a>
            </li>
            <li class="nav-item dropdown">
                <a href="{{route('admin.orders.index')}}">
                    <span class="icon-holder">
                        <i class="anticon anticon-schedule"></i>
                    </span>
                    <span class="title">Orders</span>
                </a>
            </li>

            <li class="nav-item dropdown">
                <a class="dropdown-toggle" href="javascript:void(0);">
                    <span class="icon-holder">
                        <i class="anticon anticon-shop"></i>
                    </span>
                    <span class="title">Agencies</span>
                    <span class="arrow">
                        <i class="arrow-icon"></i>
                    </span>
                </a>
                <ul class="dropdown-menu">
                    <li class="{{ Route::is('admin.agencies.index') ? 'active' : '' }}">
                        <a href="{{route('admin.agencies.index')}}">All Agency</a>
                    </li>                
                    <li class="{{ Route::is('admin.agencies.create') ? 'active' : '' }}">
                        <a href="{{route('admin.agencies.create')}}">Add New</a>
                    </li>
                    
                </ul>
            </li>

            <li class="nav-item dropdown">
                <a class="dropdown-toggle" href="javascript:void(0);">
                    <span class="icon-holder">
                        <i class="anticon anticon-dollar"></i>
                    </span>
                    <span class="title">Pricing Plan</span>
                    <span class="arrow">
                        <i class="arrow-icon"></i>
                    </span>
                </a>
                <ul class="dropdown-menu">
                    <li class="{{ Route::is('admin.plans.index') ? 'active' : '' }}">
                        <a href="{{route('admin.plans.index')}}">All Pricing Plan</a>
                    </li>                
                    <li class="{{ Route::is('admin.plans.create') ? 'active' : '' }}">
                        <a href="{{route('admin.plans.create')}}">Add New</a>
                    </li>
                    
                </ul>
            </li>

            <li class="nav-item dropdown">
                <a class="dropdown-toggle" href="javascript:void(0);">
                    <span class="icon-holder">
                        <i class="anticon anticon-team"></i>
                    </span>
                    <span class="title">Accounts</span>
                    <span class="arrow">
                        <i class="arrow-icon"></i>
                    </span>
                </a>
                <ul class="dropdown-menu">
                    <li class="{{ Route::is('users') ? 'active' : '' }}">
                        <a href="{{route('users')}}">All Account</a>
                    </li>                
                    <li class=" {{ Route::is('admin.create.user') ? 'active' : '' }}">
                        <a href="{{route('admin.create.user')}}">Add New</a>
                    </li>
                    
                </ul>
            </li>

        </ul>
    </div>
</div>