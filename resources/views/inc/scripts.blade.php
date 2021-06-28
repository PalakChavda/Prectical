<!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
<script src="{{asset('assets/js/jquery.js')}}"></script>

<script src="{{asset('assets/js/libs/jquery-3.1.1.min.js')}}"></script>
<script src="{{asset('bootstrap/js/popper.min.js')}}"></script>
<script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>

<script src="{{asset('assets/js/jquery.validate.min.js')}}"></script>
<script src="{{asset('assets/js/additional-methods.min.js')}}"></script>
<!-- icon -->
<script src="{{asset('plugins/font-icons/feather/feather.min.js')}}"></script>
<script type="text/javascript">
  feather.replace();
</script>
<!-- sneckbar -->
<script src="{{asset('plugins/notification/snackbar/snackbar.min.js')}}"></script>
<script src="{{asset('assets/js/components/notification/custom-snackbar.js')}}"></script>

@if ($page_name != 'coming_soon' && $page_name != 'contact_us' && $page_name != 'error404' && $page_name != 'error500' && $page_name != 'error503' && $page_name != 'faq' && $page_name != 'helpdesk' && $page_name != 'maintenence' && $page_name != 'privacy' && $page_name != 'auth_boxed' && $page_name != 'auth_default')
<script src="{{asset('plugins/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
<script src="{{asset('assets/js/app.js')}}"></script>
<script>
  $(document).ready(function() {
    App.init();
  });
</script>
<script src="{{asset('assets/js/scrollspyNav.js')}}"></script>
<script src="{{asset('plugins/highlight/highlight.pack.js')}}"></script>
<script src="{{asset('assets/js/custom.js')}}"></script>

@endif
<!-- END GLOBAL MANDATORY SCRIPTS -->
<script>
  $(document).ready(function() {
jQuery.validator.addMethod("noSpace", function(value, element) {
      return value.indexOf(" ") < 0 && value != "";
    }, "No space allow! Please don't leave it empty");
  });
</script>
<!-- Sneackbar alert message start-->

@if(session()->has('message.level'))
@if(session()->has('message.validation_errors'))
<script>
  var message = "{{Session::get('message.content')}}";
  console.log(message);
</script>
@else
<script>
  var level = "{{ Session::get('message.level')}}";
  var background = "{{ Session::get('message.background')}}";
  var message = "{{ Session::get('message.content')}}";
  // var validation_errors = "{{Session::get('message.validation_errors')}}";

  // if(!validation_errors){
  // alert('single msg');
  Snackbar.show({
    text: message,
    showAction: false,
    pos: 'bottom-right',
    backgroundColor: background,
    duration: 3000,
  });

  // }else{
  // message = JSON.parse(message);
  // alert(message.length);
  // console.log(message);
  // }
</script>
@endif
@endif





<!-- Sneackbar alert message end-->
<!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
@switch($page_name)

@case('dashboard')
{{-- Dashboard --}}
<script>
  var path = "{{route('dashboard.index')}}";
</script>

@if(session()->has('message.level'))
<script>
  var level = "{{ Session::get('message.level')}}";
  var background = "{{ Session::get('message.background')}}";
  var message = "{{ Session::get('message.content')}}";

  Snackbar.show({
    text: message,
    showAction: false,
    pos: 'bottom-right',
    backgroundColor: background,
    duration: 5000
  });
</script>
@endif
@break


@case('users')
<!-- @case('__("global.user_management")') -->
<script src="{{asset('plugins/table/datatable/datatables.js')}}"></script>
<script src="{{asset('assets/js/scrollspyNav.js')}}"></script>

<script src="{{asset('plugins/sweetalerts/sweetalert2.min.js')}}"></script>
<script>
  // start datatable
  var data_table = '#style-3';

  // DataTable
  function get_datatables_data() {
    // alert(route('users.getUsers'));
    $(data_table).DataTable({
      processing: true,
      responsive: true,
      serverSide: true,
      order: [0, 'ASC'],

      ajax: "{{route('users.getUsers')}}",
      columns: [{
          data: 'first_name'
        },
        {
          data: 'last_name'
        },
        {
          data: 'email'
        },
        {
          data: 'phone'
        },
        {
          data: 'status'
        },
        {
          data: 'action'
        },
      ],
      language: {
        emptyTable: "No data available",
        zeroRecords: "No matching records found...",
        infoEmpty: "No records available",
        search: '<i class="fa fa-search"></i>',
      },
      columnDefs: [{
          targets: [0],
          searchable: false,
          sortable: true,
        },
        {
          targets: [1],
          searchable: false,
          sortable: true,
        },
        {
          targets: [2],
          searchable: false,
          sortable: true,
        },
        {
          targets: [3],
          searchable: false,
          sortable: true,
        },
        {
          targets: [4],
          searchable: false,
          sortable: false,
        },
        {
          targets: [5],
          searchable: false,
          sortable: false,
        },

      ],
      "oLanguage": {
        "oPaginate": {
          "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>',
          "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>'
        },
        // "sInfo": "Showing page _PAGE_ of _PAGES_",
        "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',

        "sSearchPlaceholder": "@lang('user.search')",
        "sLengthMenu": "@lang('user.results') :  _MENU_",
      },
      "stripeClasses": [],
      "lengthMenu": [10, 20, 50],
      "pageLength": 10
    });
  }

  function refresh_tab() {
    jQuery(data_table).dataTable().fnDestroy();
    get_datatables_data();
  }

  function reload_draw() {
    jQuery(data_table).DataTable().draw();
  }

  $(document).ready(function() {
    get_datatables_data();
  });

  // check status
  jQuery(document).on('change', '.checkbox', function() {
    var id = jQuery(this).data('id');
    var status = 1;

    if (this.checked) {
      var status = 1;
    } else {
      var status = 2;
    }
    console.log(id + "" + status);
    changeStatusById(id, status);
  });

  function changeStatusById(id, status) {
    var path = "{{URL('users/change_status_by_id')}}";
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
      method: 'POST',
      header: {
        'X-CSRF-TOKEN': CSRF_TOKEN
      },
      /* the route pointing to the post function */
      url: path,
      type: 'POST',
      /* send the csrf-token and the input to the controller */
      data: {
        _token: CSRF_TOKEN,
        "id": id,
        "status": status
      },
      dataType: 'JSON',
      /* remind that 'data' is the response of the AjaxController */
      success: function(response) {
        if (response.status == 'success') {
          console.log(response.message);
          var level = "{{ Session::get('response.status')}}";
          var background = "{{ Session::get('response.background')}}";
          var message = "{{ Session::get('response.message')}}";

          Snackbar.show({
            text: message,
            showAction: false,
            pos: 'bottom-right',
            backgroundColor: background,
            duration: 5000
          });
          // alert("status changed successfully");
        }
      }
    });
  }

  function changeStatusById(id, status) {
    var path = "{{URL('users/change_status_by_id')}}";
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
      method: 'POST',
      header: {
        'X-CSRF-TOKEN': CSRF_TOKEN
      },
      /* the route pointing to the post function */
      url: path,
      type: 'POST',
      /* send the csrf-token and the input to the controller */
      data: {
        _token: CSRF_TOKEN,
        "id": id,
        "status": status
      },
      dataType: 'JSON',
      /* remind that 'data' is the response of the AjaxController */
      success: function(response) {
        if (response.status == 'success') {

          var level = response.status;
          var background = response.background;
          var message = response.message;

          Snackbar.show({
            text: message,
            showAction: false,
            pos: 'bottom-right',
            backgroundColor: background,
            duration: 5000
          });
        }
      }
    });
  }

  // multiCheck(c3);
  $("body").on("click", ".remove-user", function() {
    var current_object = $(this);
    swal({
      title: "@lang('global.are_you_sure')",
      text: "@lang('global.wont_be_able_to_revert')",
      type: 'warning',
      showCancelButton: true,
      confirmButtonText: "@lang('global.delete')",
      padding: '2em'
    }).then(function(result) {
      console.log('result', result);
      if (result.value) {
        var action = current_object.attr('data-action');
        var token = jQuery('meta[name="csrf-token"]').attr('content');
        var id = current_object.attr('data-id');

        $('body').html("<form class='form-inline remove-form' method='post' action='" + action + "'></form>");
        $('body').find('.remove-form').append('<input name="_method" type="hidden" value="delete">');
        $('body').find('.remove-form').append('<input name="_token" type="hidden" value="' + token + '">');
        $('body').find('.remove-form').append('<input name="id" type="hidden" value="' + id + '">');
        $('body').find('.remove-form').submit();

      }
    })
  });
</script>
@break






@case('user_add')

<script src="{{asset('assets/js/scrollspyNav.js')}}"></script>
<!-- <script src="{{asset('assets/js/forms/bootstrap_validation/bs_validation_script.js')}}"></script> -->
<!-- date -->
<script src="{{asset('plugins/notification/snackbar/snackbar.min.js')}}"></script>
<script src="{{asset('plugins/bootstrap-range-Slider/bootstrap-rangeSlider.js')}}"></script>
<script src="{{asset('plugins/bootstrap-select/bootstrap-select.min.js')}}"></script>
<!-- end date -->
<!-- date -->
<script src="{{asset('plugins/flatpickr/flatpickr.js')}}"></script>
<script src="{{asset('plugins/noUiSlider/nouislider.min.js')}}"></script>
<script src="{{asset('plugins/flatpickr/custom-flatpickr.js')}}"></script>
<script src="{{asset('plugins/noUiSlider/custom-nouiSlider.js')}}"></script>
<!-- end date -->
<script>
  $(document).ready(function() {


    $('#btn-submit').on('click', function() {
      $('#user_form').validate({
        rules: {
          first_name: {
            noSpace: true,
            required: true,
            minlength: 3,
            maxlength: 50
          },
          last_name: {
            noSpace: true,
            required: true,
            minlength: 3,
            maxlength: 50
          },
          email: {
            noSpace: true,
            required: true,
            email: true,
          },
          phone: {
            noSpace: true,
            required: true,
          }
        },
        errorElement: 'span',
        errorPlacement: function(error, element) {
          error.addClass('invalid-feedback');
          element.closest('.form-group > div').append(error);
        },
        // highlight: function(element, errorClass, validClass) {
        //   $(element).addClass('is-invalid');
        // },
        // unhighlight: function(element, errorClass, validClass) {
        //   $(element).removeClass('is-invalid');
        // }
      });
    })


    if ($('#user_form').length > 0) {

    }

  });
  var f1 = flatpickr(document.getElementById('dob'), {
    enableTime: false,
    dateFormat: "Y-m-d",
    utc: false,
    defaultDate: new Date()
  });

</script>
@if(session()->has('message.level'))
<script>
  var level = "{{ Session::get('message.level')}}";
  var background = "{{ Session::get('message.background')}}";
  var message = "{{ Session::get('message.content')}}";

  Snackbar.show({
    text: message,
    showAction: false,
    pos: 'bottom-right',
    backgroundColor: background,
    duration: 5000
  });
</script>
@endif
@break

@case('user_edit')
<script src="{{asset('plugins/bootstrap-select/bootstrap-select.min.js')}}"></script>
<script src="{{asset('plugins/notification/snackbar/snackbar.min.js')}}"></script>
<script src="{{asset('assets/js/scrollspyNav.js')}}"></script>
<script src="{{asset('plugins/bootstrap-range-Slider/bootstrap-rangeSlider.js')}}"></script>
<!-- <script src="{{asset('assets/js/forms/bootstrap_validation/bs_validation_script.js')}}"></script> -->

<script>
  $(document).ready(function() {

    $('#btn-submit').on('click', function() {
      $('#user_form').validate({
        rules: {
          first_name: {
            required: true,
            minlength: 3,
            maxlength: 50
          },
          last_name: {
            required: true,
            minlength: 3,
            maxlength: 50
          },
          email: {
            required: true,
            email: true,
          },
          phone: {
            required: true,
            minlength: 1,
            maxlength: 10,
            // phoneUS: true,  // <-- no such method called "matches"!
          }
         
        },
        errorElement: 'span',
        errorPlacement: function(error, element) {
          error.addClass('invalid-feedback');
          element.closest('.form-group > div').append(error);
        },
        // highlight: function(element, errorClass, validClass) {
        //   $(element).addClass('is-invalid');
        // },
        // unhighlight: function(element, errorClass, validClass) {
        //   $(element).removeClass('is-invalid');
        // }
      });
    })


    if ($('#user_form').length > 0) {

    }

  });
</script>
@if(session()->has('message.level'))
<script>
  var level = "{{ Session::get('message.level')}}";
  var background = "{{ Session::get('message.background')}}";
  var message = "{{ Session::get('message.content')}}";

  Snackbar.show({
    text: message,
    showAction: false,
    pos: 'bottom-right',
    backgroundColor: background,
    duration: 5000
  });
</script>
@endif
@break


@case('blog')
<!-- @case('__("global.user_management")') -->
<script src="{{asset('plugins/table/datatable/datatables.js')}}"></script>
<script src="{{asset('assets/js/scrollspyNav.js')}}"></script>

<script src="{{asset('plugins/sweetalerts/sweetalert2.min.js')}}"></script>
<script>
  // start datatable
  var data_table = '#style-3';

  // DataTable
  function get_datatables_data() {
    // alert(route('users.getUsers'));
    $(data_table).DataTable({
      processing: true,
      responsive: true,
      serverSide: true,
      order: [0, 'ASC'],

      ajax: "{{route('blog.getBlog')}}",
      columns: [{
          data: 'name'
        },
        {
          data: 'detail'
        },
        {
          data: 'user_id'
        },
      
   
      ],
      language: {
        emptyTable: "No data available",
        zeroRecords: "No matching records found...",
        infoEmpty: "No records available",
        search: '<i class="fa fa-search"></i>',
      },
      columnDefs: [{
          targets: [0],
          searchable: false,
          sortable: true,
        },
        {
          targets: [1],
          searchable: false,
          sortable: true,
        },
        {
          targets: [2],
          searchable: false,
          sortable: true,
        },
     
      ],
      "oLanguage": {
        "oPaginate": {
          "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>',
          "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>'
        },
        // "sInfo": "Showing page _PAGE_ of _PAGES_",
        "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',

        "sSearchPlaceholder": "@lang('user.search')",
        "sLengthMenu": "@lang('user.results') :  _MENU_",
      },
      "stripeClasses": [],
      "lengthMenu": [10, 20, 50],
      "pageLength": 10
    });
  }

  function refresh_tab() {
    jQuery(data_table).dataTable().fnDestroy();
    get_datatables_data();
  }

  function reload_draw() {
    jQuery(data_table).DataTable().draw();
  }

  $(document).ready(function() {
    get_datatables_data();
  });

</script>
@break



@default
<script>
  console.log('No custom script available.')
</script>
@endswitch
<!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
<!-- session -->