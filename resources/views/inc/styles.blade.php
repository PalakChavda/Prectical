<link href="{{asset('assets/css/loader.css')}}" rel="stylesheet" type="text/css" />
<script src="{{asset('assets/js/loader.js')}}"></script>
<style>
  ul.table-controls {
    list-style: none;
    margin: 0;
    padding: 0;
  }
  .multi_selct {
    width: 100% !important;
  }
  .multi_selct .dropdown-menu a.dropdown-item.selected {
    background-color: rgba(27, 85, 226, 0.2392156863);
    color: #1b55e2;
  }
  .multi_selct .dropdown-toggle span.filter-option.float-left {
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    width: 95%;
  }
  .form-control[type="file" i]  {
    text-overflow: ellipsis;
    overflow: hidden;
  }
/*---------------Scroll-design--------------*/
::-webkit-scrollbar {
  width: 10px;
  background: rgb(220,220,220);
}

::-webkit-scrollbar-track {
  -webkit-box-shadow: inset 0 0 6px #5e72e41a;
  -webkit-border-radius: 10px;
  border-radius: 10px;
}

::-webkit-scrollbar-thumb {
  -webkit-border-radius: 10px;
  border-radius: 10px;
  background:hsl(0,0%,75%);
}

::-webkit-scrollbar-thumb:window-inactive {
  background: hsl(0,0%,75%);
}

/*---------------End-scroll-design--------------*/
</style>
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
<link href="{{asset('bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />

@if ($page_name != 'coming_soon' && $page_name != 'contact_us' && $page_name != 'error404' && $page_name != 'error500' && $page_name != 'error503' && $page_name != 'faq' && $page_name != 'helpdesk' && $page_name != 'maintenence' && $page_name != 'privacy' && $page_name != 'auth_boxed' && $page_name != 'auth_default')
<link href="{{asset('assets/css/plugins.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/css/scrollspyNav.css')}}" rel="stylesheet" type="text/css" />
@endif
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
@switch($page_name)


@case('dashboard')
{{-- Dashboard --}}
<link href="{{asset('plugins/apex/apexcharts.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('assets/css/dashboard/dash_1.css')}}" rel="stylesheet" type="text/css" />

<!-- date -->
<link href="{{asset('plugins/flatpickr/flatpickr.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('plugins/noUiSlider/nouislider.min.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('assets/css/scrollspyNav.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('plugins/flatpickr/custom-flatpickr.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('plugins/noUiSlider/custom-nouiSlider.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('plugins/bootstrap-range-Slider/bootstrap-slider.css')}}" rel="stylesheet" type="text/css">
<!-- end date -->
<!-- chart -->
<link href="{{asset('assets/css/scrollspyNav.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('plugins/apex/apexcharts.css')}}" rel="stylesheet" type="text/css">
<style>
  .apexcharts-canvas {
    margin: 0 auto;
  }
</style>

@break


@case('users')
<!-- @case("__('global.user_management')") -->
{{-- User Account Settings --}}

{{-- Table Datatable Custom --}}
<link href="{{asset('assets/css/scrollspyNav.css')}}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="{{asset('plugins/table/datatable/datatables.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/forms/theme-checkbox-radio.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('plugins/table/datatable/dt-global_style.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('plugins/table/datatable/custom_dt_custom.css')}}">
<link href="{{asset('plugins/sweetalerts/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('plugins/sweetalerts/sweetalert.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('plugins/notification/snackbar/snackbar.min.css')}}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/forms/switches.css')}}">
<style>
  .table-responsive>.table {
    background: transparent;
  }
</style>
@break

@case('user_add')
<link href="{{asset('assets/css/scrollspyNav.css')}}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="{{asset('plugins/select2/select2.min.css')}}">

<!-- date -->
<link href="{{asset('plugins/flatpickr/flatpickr.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('plugins/noUiSlider/nouislider.min.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('plugins/flatpickr/custom-flatpickr.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('plugins/noUiSlider/custom-nouiSlider.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('plugins/bootstrap-range-Slider/bootstrap-slider.css')}}" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="{{asset('plugins/bootstrap-select/bootstrap-select.min.css')}}">
<!-- end date -->
<link href="{{asset('plugins/notification/snackbar/snackbar.min.css')}}" rel="stylesheet" type="text/css" />
@break

@case('user_edit')
<link href="{{asset('assets/css/scrollspyNav.css')}}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="{{asset('plugins/select2/select2.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('plugins/bootstrap-select/bootstrap-select.min.css')}}">
<link href="{{asset('plugins/notification/snackbar/snackbar.min.css')}}" rel="stylesheet" type="text/css" />
@break

@case('blog')
<!-- @case("__('global.user_management')") -->
{{-- User Account Settings --}}

{{-- Table Datatable Custom --}}
<link href="{{asset('assets/css/scrollspyNav.css')}}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="{{asset('plugins/table/datatable/datatables.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/forms/theme-checkbox-radio.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('plugins/table/datatable/dt-global_style.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('plugins/table/datatable/custom_dt_custom.css')}}">
<link href="{{asset('plugins/sweetalerts/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('plugins/sweetalerts/sweetalert.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('plugins/notification/snackbar/snackbar.min.css')}}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/forms/switches.css')}}">
<style>
  .table-responsive>.table {
    background: transparent;
  }
</style>
@break


@default
<script>
  console.log('No custom Styles available.')
</script>
@endswitch
<!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->
<style>
  table {
    margin-top: 10px;
    margin-bottom: 10px;
  }

  table form {
    display: inline-block;
    width: auto;
    height: auto;
  }
</style>
