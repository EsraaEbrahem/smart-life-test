$(document).ready(function () {
    $('#moveDate').calendarsPicker({
        dateFormat: 'yyyy-mm-dd'
    });

    var base_url = $("#base_url").val();
    // change on the class
    $("#className").unbind('change').bind('change', function () {
        var class_id = $(this).val();
        console.log()
        $("#sectionName").load(base_url + 'fetchClassSection/' + class_id);
    });

    /*
  * submit the create student form
  */
    $("#moveStudentsForm").unbind('submit').bind('submit', function () {
        $("#messages").html('');

        var form = $(this);
        var url = form.attr('action');
        var type = form.attr('method');
        var formData = new FormData($(this)[0]);

        $.ajax({
            url: url,
            type: type,
            data: formData,
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            async: false,
            success: function (response) {
                if (response.success == true) {
                    $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">' +
                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
                        response.messages +
                        '</div>');

                    $('.form-group').removeClass('has-error').removeClass('has-success');
                    $('.text-danger').remove();
                    clearForm();
                } else {
                    if (response.messages instanceof Object) {
                        $.each(response.messages, function (index, value) {
                            var key = $("#" + index);

                            key.closest('.form-group')
                                .removeClass('has-error')
                                .removeClass('has-success')
                                .addClass(value.length > 0 ? 'has-error' : 'has-success')
                                .find('.text-danger').remove();

                            key.after(value);
                        });
                    } else {
                        $("#messages").html('<div class="alert alert-warning alert-dismissible" role="alert">' +
                            '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
                            response.messages +
                            '</div>');
                    }
                } // /else
            } // /success
        }); // /ajax

        return false;
    });
});

function clearForm() {
    $('input[type="text"]').val('');
    $('select').val('');
    $("#sectionName").html('<option value="">Select Class</option>');

    $(".fileinput-remove-button").click();
}

/*
*-------------------------------
* gets the class's section info function
*-------------------------------
*/
function getSelectClassSection(rowId = null) {
    if (rowId) {
        var class_id = $("#bulkstclassName" + rowId).val();
        $("#bulkstsectionName" + rowId).load(base_url + 'student/fetchClassSection/' + class_id);
    }
}