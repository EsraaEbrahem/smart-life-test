var manageUserTable;
var base_url = $("#base_url").val();

$(document).ready(function() {
    manageUserTable = $("#manageUserTable").DataTable({
        'ajax' : base_url + 'users/fetchUsersData',
        'order' : []
    });

    $("#createUserForm").unbind('submit').bind('submit', function() {
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
                    $("#add-user-messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                        response.messages +
                        '</div>');

                    manageUserTable.ajax.reload(null, false);
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
                        $("#add-user-messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
                            '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                            response.messages +
                            '</div>');
                    }
                } // /else
            } // /success
        }); // /ajax

        return false;
    });

    $("#updateUserForm").unbind('submit').bind('submit', function() {
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
                    $("#edit-user-message").html('<div class="alert alert-success alert-dismissible" role="alert">'+
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
                        $("#edit-user-message").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
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


function removeUser(userId = null)
{
    if(userId) {
        $("#removeUserBtn").unbind('click').bind('click', function() {
            $.ajax({
                url : base_url + 'users/remove/'+userId,
                type: 'post',
                dataType: 'json',
                success:function(response) {
                    if(response.success == true) {
                        $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
                            '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                            response.messages +
                            '</div>');

                        manageUserTable.ajax.reload(null, false);
                        $("#removeUserModal").modal('hide');
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
}