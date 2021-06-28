@if ($page_name != 'coming_soon' && $page_name != 'contact_us' && $page_name != 'error404' && $page_name != 'error500' && $page_name != 'error503' && $page_name != 'faq' && $page_name != 'helpdesk' && $page_name != 'maintenence' && $page_name != 'privacy' && $page_name != 'auth_boxed' && $page_name != 'auth_default')

<!--  BEGIN SIDEBAR  -->
<div class="sidebar-wrapper sidebar-theme">

    <nav id="sidebar">
        <ul class="navbar-nav theme-brand flex-row  text-center">
            <li class="nav-item theme-logo">
                <a href="/dashboard">
                    <img src="{{asset('storage/img/logo.png')}}" class="navbar-logo" alt="logo">
                </a>
            </li>
            
        </ul>
        <ul class="list-unstyled menu-categories pt-4" id="accordionExample">
            @if ($page_name != 'alt_menu' && $page_name != 'blank_page' && $page_name != 'boxed' && $page_name != 'breadcrumb' )
              
            <li class="menu {{ ($category_name === 'dashboard') ? 'active' : '' }}">
                <a href="/dashboard" data-active="{{ ($category_name === 'dashboard') ? 'true' : 'false' }}" aria-expanded="{{ ($category_name === 'dashboard') ? 'true' : 'false' }}" class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home">
                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                            <polyline points="9 22 9 12 15 12 15 22"></polyline>
                        </svg>
                        <span> @lang('global.dashboard')</span>
                    </div>
                </a>
            </li>

            <li class="menu {{ ($category_name === 'users') ? 'active' : '' }}" >
                <a href="/users" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                        <span> @lang('global.user_management')</span>
                    </div>
                </a>
            </li> 
            <li class="menu {{ ($category_name === 'blog') ? 'active' : '' }}">
                <a href="/blog" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"></path><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"></path></svg>
                        <span> @lang('global.blog')</span>
                    </div>
                </a>
            </li>
       
            @endif
        </ul>
    </nav>
</div>
<!--  END SIDEBAR  -->
@endif
