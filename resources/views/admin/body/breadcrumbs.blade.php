 <div class="secondary-nav">
     <div class="breadcrumbs-container" data-page-heading="Analytics">
         <header class="header navbar navbar-expand-sm">
             <a href="javascript:void(0);" class="btn-toggle sidebarCollapse" data-placement="bottom">
                 <i data-feather="menu"></i>
             </a>
             <div class="d-flex breadcrumb-content">
                 <div class="page-header">

                     <div class="page-title">
                     </div>

                     <nav class="breadcrumb-style-one" aria-label="breadcrumb">
                         <ol class="breadcrumb">
                             <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                             <li class="breadcrumb-item active" aria-current="page">{{ breadcrumb() }}</li>

                         </ol>
                     </nav>

                 </div>
             </div>
             <ul class="navbar-nav flex-row ms-auto breadcrumb-action-dropdown">
                 <li class="nav-item more-dropdown">
                     <div class="dropdown  custom-dropdown-icon">
                         <a class="dropdown-toggle btn" href="#" role="button" id="customDropdown"
                             data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                             <span>Settings</span>
                             <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                 fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                 stroke-linejoin="round" class="feather feather-chevron-down custom-dropdown-arrow">
                                 <polyline points="6 9 12 15 18 9"></polyline>
                             </svg>
                         </a>

                         <div class="dropdown-menu dropdown-menu-right" aria-labelledby="customDropdown">

                             <a class="dropdown-item" data-value="Settings" data-icon=""
                                 href="{{ route('site.setting') }}">
                                 <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                     viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                     stroke-linecap="round" stroke-linejoin="round" class="feather feather-settings">
                                     <circle cx="12" cy="12" r="3"></circle>
                                     <path
                                         d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z">
                                     </path>
                                 </svg> Settings
                             </a>


                            
                             <a class="dropdown-item" data-value="User" data-icon="" href="{{ route('all.admin') }}">
                                 <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                     viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                     stroke-linecap="round" stroke-linejoin="round" class="feather feather-user">
                                     <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                     <circle cx="12" cy="7" r="4"></circle>
                                 </svg> Users
                             </a>

                         </div>

                     </div>
                 </li>
             </ul>
         </header>
     </div>
 </div>
