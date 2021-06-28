$(document).ready(function () {

    /*
        Column Filter
    */

    cf = $('#column-filter').DataTable({
        headerCallback: function (e, a, t, n, s) {
            e.getElementsByTagName("th")[0].innerHTML = '<label class="new-control new-checkbox checkbox-primary m-auto">\n<input type="checkbox" class="new-control-input chk-parent select-customers-info" id="customer-all-info">\n<span class="new-control-indicator"></span><span style="visibility:hidden">c</span>\n</label>'
        },
        columnDefs: [{
            targets: 0, width: "30px", className: "", orderable: !1, render: function (e, a, t, n) {
                return '<label class="new-control new-checkbox checkbox-primary" style="height: 21px; margin-bottom: 0; margin-right: 0">\n<input type="checkbox" class="new-control-input child-chk select-customers-info" id="customer-all-info">\n <span class="new-control-indicator"></span>\n</label>'
            }
        }],
        "oLanguage": {
            "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
            "sInfo": "Showing page _PAGE_ of _PAGES_",
            "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
            "sSearchPlaceholder": "Search...",
            "sLengthMenu": "Results :  _MENU_",
        },
        "stripeClasses": [],
        "lengthMenu": [7, 10, 20, 50],
        "pageLength": 7
    });

    multiCheck(cf);


    /*
        Individual Column Search
    */

    // Setup - add a text input to each footer cell
    $('#individual-col-search tfoot th').each(function () {
        var title = $(this).text();
        $(this).html('<input type="text" class="form-control" placeholder="Search ' + title + '" />');
    });

    // DataTable
    var table = $('#individual-col-search').DataTable({
        "oLanguage": {
            "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
            "sInfo": "Showing page _PAGE_ of _PAGES_",
            "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
            "sSearchPlaceholder": "Search...",
            "sLengthMenu": "Results :  _MENU_",
        },
        "stripeClasses": [],
        "lengthMenu": [7, 10, 20, 50],
        "pageLength": 7
    });

    // Apply the search
    table.columns().every(function () {
        var that = this;

        $('input', this.footer()).on('keyup change', function () {
            if (that.search() !== this.value) {
                that
                    .search(this.value)
                    .draw();
            }
        });
    });



    /*
        Show Hide column
    */

    var table = $('#show-hide-col').DataTable({
        // "scrollY": "283px",
        "paging": true,
        dom: '<"row"<"col-md-12"<"row"<"col-md-6 csv_btn"l B><"col-md-6"f> > ><"col-md-12"rt> <"col-md-12"<"row"<"col-md-5"i><"col-md-7"p>>> >',
        buttons: {
            buttons: [
            {
                extend: 'csv',
                className: 'btn',
                icon: 'feather feather-download'
            },
            ]
        },
       
        "oLanguage": {
            "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
            // "sInfo": "Showing page _PAGE_ of _PAGES_",
            "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
            "sSearchPlaceholder": "Search...",
            "sLengthMenu": "Results :  _MENU_",
        },
        "columnDefs": [
            {
                "targets": [0],
                "visible": true
            },
            {
                "targets": [1],
                "visible": true
            },
            {
                "targets": [2],
                "visible": true
            },
            {
                "targets": [3],
                "visible": true
            },
            {
                "targets": [4],
                "visible": true
            },
            {
                "targets": [5],
                "visible": false
            },
            {
                "targets": [6],
                "visible": false
            },
            {
                "targets": [7],
                "visible": false
            },
            {
                "targets": [7],
                "visible": false
            },
            {
                "targets": [8],
                "visible": false
            },
            {
                "targets": [9],
                "visible": false
            },
            {
                "targets": [10],
                "visible": false
            },
            {
                "targets": [11],
                "visible": false
            },
            {
                "targets": [12],
                "visible": false
            },
        ],
        "stripeClasses": [],
        "lengthMenu": [10, 25, 50, 100],
        "pageLength": 25
    });
    $('.columnselector.selectpicker').on('change', function (e) {
        e.preventDefault();

        $(".columnselector.selectpicker option").each(function(){
            var column = table.column( $(this).val() );
            if($(this).is(':selected')){
                column.visible( false );    
            }else{
                column.visible( true );    
            }
        });
    });

});