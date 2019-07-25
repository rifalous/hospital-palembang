var arr_menu;

$(document).ready(function(){

    get_data();

    $('#btn-add').click(function(){

        var data = $('#form-add').serializeArray();
        var form = $('#form-add').validate();

        if (form.form()) {

            if ($('[name="id"]').val() == '') {
                on_store(data);
            } else {
                on_update(data)
            }
        }
        
    });

    $('#btn-cancel').click(function(){
        refresh();
    });

    $('#btn-confirm').click(function(){

        var id = $(this).data('value');

        $.ajax({
            url: SITE_URL + '/menu/'+id,
            type: 'delete',
            dataType: 'json',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: function(data){
                show_notification(data.title, data.type, data.message);
            },
            error: function(error, sts, xhr){
                show_notification('Error', 'error', xhr);
            },
            complete: function(){
                get_data();
            }
        });
    });


});

function get_data() {
    $.ajax({

        url: SITE_URL + '/menu',
        type: 'get',
        dataType: 'html',
        success: function(html){

            $('#menu').html(html);

            $('.sortable').nestedSortable({
                forcePlaceholderSize: true,
                handle: 'div',
                helper: 'clone',
                items: 'li',
                toleranceElement: '> div',
                maxLevels: 3,
                placeholder: 'placeholder',
                tolerance: 'pointer',
                isTree: true,
                relocate: function(){
                    on_bulk_edit();
                }
            });

            $('[data-toggle="tooltip"]').tooltip();

        }
    });
}

function on_bulk_edit() {

    var data = $('ol.sortable').nestedSortable('toArray', {startDepthCount: 0});
    $.ajax({

        url: SITE_URL + '/menu/bulk_edit',
        type: 'post',
        dataType: 'json',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data: {
            data: data
        },
        success: function(data){
            show_notification(data.title, data.type, data.message);
            get_data();
        },
        error: function(error, sts, xhr){
            show_notification('Error', 'error', xhr);
        }

    });
}

function refresh() {

    $('#form-add').trigger('reset').validate().resetForm();
    $('#form-add select').val(null).trigger('change');
    $('.form-group').removeClass('has-error');
    $('.help-block').html('');

    $('#btn-add').html('Add to menu');
    $('#btn-add').removeAttr('disabled');

    $('#btn-cancel').hide();

}


function on_get_menu(id)
{
    var res = $.ajax({
        url: SITE_URL + '/menu/'+id+'/edit',
        dataType: 'json',
        type: 'get',
        async: false
    });

    return res.responseJSON;
}

function on_edit(id)
{

    var data = on_get_menu(id);

    $('[name="id"]').val(data.id);
    $('[name="name"]').val(data.name);
    $('[name="url"]').val(data.url);
    $('[name="method"]').val(data.method).trigger('change');
    $('[name="icon"]').val(data.icon);
    $('[name="is_showed"]').val(data.is_showed).trigger('change');
    $('[name="order_number"]').val(data.order_number);

    $('html, body').animate({
        scrollTop: $('#menu-menu').offset().top
    }, 'fast');

    $('#btn-add').html('Update menu');
    $('#btn-cancel').show();

}

function on_store(data) {

    $.ajax({
        url: SITE_URL + '/menu',
        type: 'post',
        dataType: 'json',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data: data,
        beforeSend: function(){
            $('#btn-add').html('Loading...');
            $('#btn-add').attr('disabled', 'disabled');
        },
        success: function(data){
            show_notification(data.title, data.type, data.message);
            get_data();
        },
        error: function(error, sts, xhr){
                show_notification('Error', 'error', xhr);
            },
        complete: function(){

            refresh();
        }
    });
}

function on_update(data) {

    $.ajax({
        url: SITE_URL + '/menu/' + $('[name="id"]').val(),
        type: 'put',
        dataType: 'json',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data: data,
        beforeSend: function(){
            $('#btn-add').html('Loading...');
            $('#btn-add').attr('disabled', 'disabled');
        },
        success: function(data){
            show_notification(data.title, data.type, data.message);
            get_data();
        },
        error: function(error, sts, xhr){
            show_notification('Error', 'error', xhr);
        },
        complete: function(){

            refresh();
        }
    });
}

function on_delete(id)
{
    $('#modal-delete-confirm').modal('show');
    $('#btn-confirm').data('value', id);
}