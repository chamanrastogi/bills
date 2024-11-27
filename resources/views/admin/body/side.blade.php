 <div class="sidebar-wrapper sidebar-theme">

     <nav id="sidebar">

         <div class="navbar-nav theme-brand flex-row  text-center">
             <div class="nav-logo">

                 <div class="nav-item theme-text">
                     <a href="{{ route('admin.dashboard') }}" class="nav-link"> Admin Panel</a>
                 </div>
             </div>
             <div class="nav-item sidebar-toggle">
                 <div class="btn-toggle sidebarCollapse">
                     <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                         fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                         stroke-linejoin="round" class="feather feather-chevrons-left">
                         <polyline points="11 17 6 12 11 7"></polyline>
                         <polyline points="18 17 13 12 18 7"></polyline>
                     </svg>
                 </div>
             </div>
         </div>
         <div class="shadow-bottom"></div>
         <ul class="list-unstyled menu-categories" id="accordionExample">
             <li class="menu active">
                 <a href="{{ route('admin.dashboard') }}" aria-expanded="{{ is_active_route('admin/dashboard') }}"
                     class="dropdown-toggle">
                     <div class="">
                         <i data-feather="home"></i>
                         <span>Dashboard</span>
                     </div>
                     {{-- <div>
                         <i data-feather="chevron-right"></i>
                     </div> --}}
                 </a>

             </li>


             <li class="menu menu-heading">
                 <div class="heading">

                     <i data-feather="minus"></i>
                     <span>APPLICATIONS</span>
                 </div>
             </li>

             @if (Auth::id() === 1)
                 <x-backend.backend_component.side-menu-item permission="category.menu" routeId="category"
                     icon="menu" label="Category" :submenu="[
                         ['route' => 'category.create', 'label' => 'Add Category', 'permission' => 'category.create'],
                         ['route' => 'category.index', 'label' => 'Show Category', 'permission' => 'category.index'],
                     ]" :activeRoutes="['admin/category']" />

                 <x-backend.backend_component.side-menu-item permission="products.menu" routeId="product" icon="menu"
                     label="Product" :submenu="[
                         ['route' => 'products.create', 'label' => 'Add Product', 'permission' => 'products.create'],
                         ['route' => 'products.index', 'label' => 'Show Product', 'permission' => 'products.index'],
                     ]" :activeRoutes="['admin/products']" />
                 <x-backend.backend_component.side-menu-item permission="units.menu" routeId="color" icon="menu"
                     label="Unit" :submenu="[
                         ['route' => 'units.create', 'label' => 'Add Unit', 'permission' => 'units.create'],
                         ['route' => 'units.index', 'label' => 'Show Unit', 'permission' => 'units.index'],
                     ]" :activeRoutes="['admin/units']" />
             @endif
             <x-backend.backend_component.side-menu-item permission="customers.menu" routeId="customer" icon="menu"
                 label="Customer" :submenu="[
                     ['route' => 'customers.create', 'label' => 'Add Customer', 'permission' => 'customers.create'],
                     ['route' => 'customers.index', 'label' => 'Show Customer', 'permission' => 'customers.index'],
                 ]" :activeRoutes="['admin/customers']" />
             @if (Auth::id() === 1)
                 <x-backend.backend_component.side-menu-item permission="admin.menu" routeId="admin" icon="menu"
                     label="Manage Users" :submenu="[
                         ['route' => 'add.admin', 'label' => 'Add User', 'permission' => 'add.admin'],
                         ['route' => 'all.admin', 'label' => 'Show Admin Users', 'permission' => 'all.admin'],
                         //  ['route' => 'all.users', 'label' => 'Show Users', 'permission' => 'all.users'],
                     ]" :activeRoutes="['admin/add/admin', 'admin/all/admin', 'admin/users']" :expandedRoutes="['admin/add/admin']" />
             @endif

             <x-backend.backend_component.side-menu-item permission="site.menu" routeId="site.setting" icon="settings"
                 label="Settings" :submenu="[]" :activeRoutes="[]" :expandedRoutes="[]" />
             @if (Auth::id() === 1)
                 <x-backend.backend_component.side-menu-item permission="bill.menu" routeId="billing.index"
                     icon="book" label="Genrate Bill" :submenu="[]" :activeRoutes="[]" :expandedRoutes="[]" />

                 <x-backend.backend_component.side-menu-item permission="bill.menu" routeId="billing.show"
                     icon="book" label="All Billing" :submenu="[]" :activeRoutes="[]" :expandedRoutes="[]" />
             @endif
         </ul>

     </nav>

 </div>
