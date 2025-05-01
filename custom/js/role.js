var manageRoleTable;
var base_url = $("#base_url").val();

$(document).ready(function() {
    manageRoleTable = $("#manageRoleTable").DataTable({
        'ajax' : base_url + 'roles/fetchRolesData',
        'order' : []
    });

    $("#createRoleForm").unbind('submit').bind('submit', function() {
        var form = $(this);
        var formData = new FormData($(this)[0]);
        var url = form.attr('action');
        var type = form.attr('method');

        $.ajax({
            url : url,
            type : type,
            data: formData,
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            async: false,
            success:function(response) {

                if(response.success == true) {
                    $("#add-role-messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                        response.messages +
                        '</div>');

                    manageRoleTable.ajax.reload(null, false);
                    $('.form-group').removeClass('has-error').removeClass('has-success');
                    $('.text-danger').remove();
                    clearForm();
                }
                else {
                    if(response.messages instanceof Object) {
                        $.each(response.messages, function(index, value) {
                            var key = $("#" + index);

                            key.closest('.form-group')
                                .removeClass('has-error')
                                .removeClass('has-success')
                                .addClass(value.length > 0 ? 'has-error' : 'has-success')
                                .find('.text-danger').remove();

                            key.after(value);

                        });
                    }
                    else {
                        $("#add-role-messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
                            '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                            response.messages +
                            '</div>');
                    }
                } // /else
            } // /success
        }); // /ajax

        return false;
    });

    $("#updateRoleForm").unbind('submit').bind('submit', function() {
        var form = $(this);
        var url = form.attr('action');
        var type = form.attr('method');

        $.ajax({
            url: url,
            type: type,
            data: form.serialize(),
            dataType: 'json',
            success:function(response) {
                if(response.success == true) {
                    $("#edit-role-message").html('<div class="alert alert-success alert-dismissible" role="alert">'+
                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                        response.messages +
                        '</div>');

                    $('.form-group').removeClass('has-error').removeClass('has-success');
                    $('.text-danger').remove();
                }
                else {
                    if(response.messages instanceof Object) {
                        $.each(response.messages, function(index, value) {
                            var key = $("#" + index);

                            key.closest('.form-group')
                                .removeClass('has-error')
                                .removeClass('has-success')
                                .addClass(value.length > 0 ? 'has-error' : 'has-success')
                                .find('.text-danger').remove();

                            key.after(value);

                        });
                    }
                    else {
                        $("#edit-role-message").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
                            '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                            response.messages +
                            '</div>');
                    }
                } // /else
            } // /success
        }); // /ajax
        return false;
    });


});


function removeRole(roleId = null)
{
    if(roleId) {
        $("#removeRoleBtn").unbind('click').bind('click', function() {
            $.ajax({
                url : base_url + 'roles/remove/'+roleId,
                type: 'post',
                dataType: 'json',
                success:function(response) {
                    if(response.success == true) {
                        $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
                            '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                            response.messages +
                            '</div>');

                        manageRoleTable.ajax.reload(null, false);
                        $("#removeRoleModal").modal('hide');
                    }
                    else{
                        $("#remove-messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
                            '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                            response.messages +
                            '</div>');
                    }
                } // /response
            }); // /ajax
        }); //
    } // /if
}

/*
*-------------------------------------------------
* clears the form
*-------------------------------------------------
*/
function clearForm()
{
    $('input[type="text"]').val('');
    $('select').val('');
    $(".fileinput-remove-button").click();
}