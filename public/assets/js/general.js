// DataTable
$(document).ready(function () {

    $.extend(true, $.fn.dataTable.defaults, {
        processing: true,
        serverSide: true,
        autoWidth: false,
        searching: true,
        pagingType: 'full_numbers',
        dom: "<'row'<'col-xs-12 pull-right'f><'col-xs-12 table-menu'tr>>" +
                "<'row m-t-20 '<'col-md-5'l> <'col-md-7 pull-right'p>>" +
                "<'row'<'col-xs-12'i>>",
        pageLength: 5,
        lengthMenu: [
            [5, 10, 25, 50, 100, 200, -1],
            [5, 10, 25, 50, 100, 200, 'All']
          ],
        language: {
            thousands: '.',
            processing: 'Proccessing. Please wait...',
            emptyTable: 'No data available.',
            sZeroRecords: 'Data not found.',
            lengthMenu: '_MENU_',
            infoEmpty: 'Showing 0 until 0 from 0 rows',
            info: 'Showing _START_ - _END_ until _TOTAL_ rows',
            loadingRecords: 'Please wait',
            paginate: {
                first: '<<',
                last: '>>',
                next: '>',
                previous: '<'
            },
            infoFiltered: '',
            pagination: {
                classes: {
                    ul: 'pagination pagination-sm'
                }
            }

        },
        drawCallback: function () {
            $('.dataTables_paginate > .pagination').addClass('pagination-sm');
        }
    });

    $('li.active').children().addClass('active');

});

// Jquery Validation
$.extend(jQuery.validator.messages, {
    required: 'This field is required.',
    email: 'Please input correct email address.',
    url: 'Worng URL format.',
    date: 'Wrong date format.',
    number: 'Input number only.',
    maxlength: jQuery.validator.format('Can not more than {0} character.'),
    minlength: jQuery.validator.format('Can not less than {0} character.'),
    max: jQuery.validator.format('Value cannot more than {0}.'),
    min: jQuery.validator.format('Value cannot less than {0}.'),
    minNumeric: jQuery.validator.format('Value cannot less than {0}.'),
});

$.validator.setDefaults({
    errorElement: 'em',
    errorPlacement: function (error, element) {
        element.closest('.form-group').find('.help-block').html(error.text());        
    },
    highlight: function (element) {
        $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
    },
    unhighlight: function(element, errorClass, validClass) {
        $(element).parent('.form-group').removeClass('has-error');
        $(element).closest('.form-group').removeClass('has-error');
        $(element).closest('.form-group').find('.help-block').html('');
    },
    success: function (element) {
        $(element).closest('.form-group').removeClass('has-error');
        $(element).closest('.form-group').find('.help-block').html('');
    },
    // onkeyup: function(element){$(element).valid()},
    onChange: function(element){$(element).valid()},
});


// toast
function show_notification(title, type, message){
    $.toast({
         heading: title,
         text: message,
         position: 'top-right',
         loaderBg: '#fff',
         icon: type,
         hideAfter: 3500,
         stack: 6
    });
}

// dataToggle
$('[data-toggle="tooltip"]').tooltip({html: true, "show": 500, "hide": 100});

// select2
$('.select2').select2();

// datepicker
$('.datepicker').datepicker({
    format: "yyyy-mm-dd",
    autoclose: true,
    todayHighlight: true
});

$('.datetimepicker').datetimepicker({
    format: 'YYYY-MM-DD HH:mm:ss', 
    locale: 'id'
});

$('.number').keypress(function (e) {
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        $("#errmsg").html("Digits Only").show().fadeOut("slow");
               return false;
    }
});

$('.autonumeric').autoNumeric('init', {
    aSep: ',' ,
    mDec : 2,
    vMin: 0
});