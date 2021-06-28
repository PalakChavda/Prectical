{{-- Functions --}}
@php


if (!function_exists('setTitle')) :
    function setTitle($page_name) {

        // echo $page_name;

        $admin_name = 'CRM';

        if ($page_name === 'dashboard') :
            echo 'CRM';

        // Forms
        elseif ($page_name === 'basic') :
            echo 'Bootstrap Forms ' . $admin_name;
        elseif ($page_name === 'bootstrap_select') :
            echo 'Bootstrap Select ' . $admin_name;
        elseif ($page_name === 'touchspin') :
            echo 'Bootstrap Touchspin ' . $admin_name;

        // User
        elseif ($page_name === 'account_settings') :
            echo 'Account Settings ' . $admin_name;
        elseif ($page_name === 'profile') :
            echo 'User Profile ' . $admin_name;

        // Lead
        elseif ($page_name === 'leads') :
            echo 'Leads ' . $admin_name;

     
        endif;
    }
endif;

if (!function_exists('set_breadcrumb')) {
    function set_breadcrumb($page_name, $category_name) {

        $category = ucfirst($category_name);

        $removeUnderscore = str_replace('_', ' ', $page_name);

        $removeDash = str_replace('-', ' ', $removeUnderscore);

        $page = ucwords($removeDash);

        if ($page_name ===  __('global.dashboard')) :

        echo '<li class="breadcrumb-item"><a href="javascript:void(0);">'.  __('global.dashboard') .'</a></li>';

        // Forms
        elseif ($page_name ===  __('global.user_management') ) :
            // echo 'Bootstrap Forms ' . $admin_name;
            echo '<li class="breadcrumb-item"><a href="javascript:void(0);">'. __('global.user_management') .'</a></li>';
        elseif ($page_name === 'user_add') :
            // echo 'Bootstrap Select ' . $admin_name;
            echo '<li class="breadcrumb-item"><a href="javascript:void(0);">'. $category .'</a></li>';

        elseif ($page_name === 'user_edit') :
            // echo 'User Profile ' . $admin_name;
            echo '<li class="breadcrumb-item"><a href="javascript:void(0);">'. $category .'</a></li>';

        elseif ($page_name === 'clients') :
            // echo 'Bootstrap Forms ' . $admin_name;
            echo '<li class="breadcrumb-item"><a href="javascript:void(0);">'. $category .'</a></li>
                <li class="breadcrumb-item active" aria-current="page"><span>' . $page .'</span></li>';

        elseif ($page_name === 'client_add') :
            // echo 'Bootstrap Select ' . $admin_name;
            echo '<li class="breadcrumb-item"><a href="javascript:void(0);">'. $category .'</a></li>
                <li class="breadcrumb-item active" aria-current="page"><span>' . $page .'</span></li>';

        elseif ($page_name === 'client_edit') :
            // echo 'User Profile ' . $admin_name;
            echo '<li class="breadcrumb-item"><a href="javascript:void(0);">'. $category .'</a></li>
                <li class="breadcrumb-item active" aria-current="page"><span>' . $page .'</span></li>';

        elseif ($page_name === 'setting') :
            // echo 'User Profile ' . $admin_name;
            echo '<li class="breadcrumb-item"><a href="javascript:void(0);">'. $category .'</a></li>
                <li class="breadcrumb-item active" aria-current="page"><span>' . $page .'</span></li>';
     
        endif;
        
    }
}


// Function to get the client IP address
function get_client_ip() {
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if(isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}

function scrollspy($offset) {
    echo 'data-target="#navSection" data-spy="scroll" data-offset="'. $offset . '"';
}

@endphp
