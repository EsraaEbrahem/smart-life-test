var manageStudentTable;
var studentSectionTable = {};
var base_url = $("#base_url").val();

$(document).ready(function () {
    var request = $("#request").text();

    $("#topStudentMainNav").addClass('active');

    $("#addStudentNav").addClass('active');

    $('#registerDate').calendarsPicker({
        dateFormat: 'yyyy-mm-dd'
    });

    $('#dob').calendarsPicker({
        dateFormat: 'yyyy-mm-dd'
    });

    $("#photo").fileinput({
        overwriteInitial: true,
        maxFileSize: 1500,
        showClose: false,
        showCaption: false,
        showBrowse: false,
        browseOnZoneClick: true,
        removeLabel: '',
        removeIcon: '<i class="glyphicon glyphicon-remove"></i>',
        removeTitle: 'Cancel or reset changes',
        elErrorContainer: '#kv-avatar-errors-2',
        msgErrorClass: 'alert alert-block alert-danger',
        defaultPreviewContent: '<img src="' + base_url + 'assets/images/default/default_avatar.png" alt="Your Avatar" style="width:208px;height:200px;"><h6 class="text-muted">Click to select</h6>',
        layoutTemplates: {main2: '{preview} {remove} {browse}'},
        allowedFileExtensions: ["jpg", "png", "gif", "JPG", "PNG", "GIF"]
    });

    // change on the class
    $("#className").unbind('change').bind('change', function () {
        var class_id = $(this).val();
        $("#sectionName").load(base_url + 'student/fetchClassSection/' + class_id);
    });

    /*
    * submit the create student form
    */
    $("#createStudentForm").unbind('submit').bind('submit', function () {
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