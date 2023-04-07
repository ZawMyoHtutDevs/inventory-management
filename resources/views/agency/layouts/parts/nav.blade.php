<div class="side-nav">
    <div class="side-nav-inner">
        <ul class="side-nav-menu scrollable">
            <li class="nav-item dropdown">
                <a href="{{route('dashboard')}}" >
                    <span class="icon-holder">
                        <i class="anticon anticon-dashboard"></i>
                    </span>
                    <span class="title">Dashboard</span>
                </a>
            </li>

            <li class="nav-item dropdown">
                <a class="dropdown-toggle" href="javascript:void(0);">
                    <span class="icon-holder">
                        <i class="anticon anticon-shopping-cart"></i>
                    </span>
                    <span class="title">Sale</span>
                    <span class="arrow">
                        <i class="arrow-icon"></i>
                    </span>
                </a>
                <ul class="dropdown-menu">
                    <li class="{{ Route::is('agency.sales.index') ? 'active' : '' }}">
                        <a href="{{route('agency.sales.index')}}">Sale Dashboard</a>
                    </li>  
                    <li class="{{ Route::is('agency.sales.list') ? 'active' : '' }}">
                        <a href="{{route('agency.sales.list')}}">Sale List</a>
                    </li>                
                    
                    
                </ul>
            </li>
            

            <li class="nav-item dropdown">
                <a class="dropdown-toggle" href="javascript:void(0);">
                    <span class="icon-holder">
                        <i class="anticon anticon-appstore"></i>
                    </span>
                    <span class="title">Products</span>
                    <span class="arrow">
                        <i class="arrow-icon"></i>
                    </span>
                </a>
                <ul class="dropdown-menu">
                    <li class="{{ Route::is('agency.products.index') ? 'active' : '' }}">
                        <a href="{{route('agency.products.index')}}">All Product</a>
                    </li>                
                    <li class=" {{ Route::is('agency.products.create') ? 'active' : '' }}">
                        <a href="{{route('agency.products.create', Auth::user()->id)}}">Add New</a>
                    </li>
                                       
                </ul>
            </li>

            <li class="nav-item dropdown ">
                <a href="{{route('agency.categories.index')}}" class="{{ Route::is('agency.categories.index') ? 'active' : '' }}">
                    <span class="icon-holder">
                        <i class="anticon anticon-tag"></i>
                    </span>
                    <span class="title">Categories</span>
                </a>
            </li>

            <li class="nav-item dropdown">
                <a href="{{route('agency.brands.index')}}" class="{{ Route::is('agency.brands.index') ? 'active' : '' }}">
                    <span class="icon-holder">
                        <i class="anticon anticon-tags"></i>
                    </span>
                    <span class="title">Brands</span>
                </a>
            </li>

            <li class="nav-item dropdown">
                <a href="{{route('agency.customers.index')}}" class="{{ Route::is('agency.customers.index') ? 'active' : '' }}">
                    <span class="icon-holder">
                        <i class="anticon anticon-idcard"></i>
                    </span>
                    <span class="title">Customers</span>
                </a>
            </li>

            <li class="nav-item dropdown">
                <a href="{{route('agency.suppliers.index')}}" class="{{ Route::is('agency.suppliers.index') ? 'active' : '' }}">
                    <span class="icon-holder">
                        <i class="anticon anticon-solution"></i>
                    </span>
                    <span class="title">Suppliers</span>
                </a>
            </li>

            <hr>

            <li class="nav-item dropdown">
                <a class="dropdown-toggle" href="javascript:void(0);">
                    <span class="icon-holder">
                        <i class="anticon anticon-setting"></i>
                    </span>
                    <span class="title">Shop Setting</span>
                    <span class="arrow">
                        <i class="arrow-icon"></i>
                    </span>
                </a>
                <ul class="dropdown-menu">
                    <li class="{{ Route::is('agency.agencies.index') ? 'active' : '' }}">
                        <a href="{{route('agency.agencies.index')}}">Shop</a>
                    </li>
                    <li class="{{ Route::is('agency.agencies.show') ? 'active' : '' }}">
                        <a href="{{route('agency.agencies.show')}}">Edit Shop</a>
                    </li>                
                    <li class=" {{ Route::is('agency.plans.order.index') ? 'active' : '' }}">
                        <a href="{{route('agency.plans.order.index')}}">Plan History</a>
                    </li>
                    <li class=" {{ Route::is('agency.plans.index') ? 'active' : '' }}">
                        <a href="{{route('agency.plans.index')}}">Renew Plan</a>
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
                    <li class="{{ Route::is('agency.accounts.index') ? 'active' : '' }}">
                        <a href="{{route('agency.accounts.index')}}">All Account</a>
                    </li>                
                    <li class=" {{ Route::is('agency.accounts.edit') ? 'active' : '' }}">
                        <a href="{{route('agency.accounts.edit', Auth::user()->id)}}">Edit Your Account</a>
                    </li>
                    <li class=" {{ Route::is('agency.accounts.change') ? 'active' : '' }}">
                        <a href="{{route('agency.accounts.change', Auth::user()->id)}}">Change Password</a>
                    </li>
                    
                </ul>
            </li>
            

        </ul>
    </div>
</div>