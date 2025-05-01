var manageStudentTable;
var studentSectionTable = {};
var manageStudentMovesTable;
var manageStudentMovesTable = {};
var base_url = $("#base_url").val();

$(document).ready(function () {
    $("#topStudentMainNav").addClass('active');
    $("#manageStudentNav").addClass('active');

    var classSideBar = $('.classSideBar').attr('id');
    var class_id = classSideBar.substring(7);

    getClassSection(class_id);

})
;

function studentMoves(studentId = null)
{
    if(studentId){
        manageStudentMovesTable = $("#manageStudentMovesTable").DataTable({
            destroy: true,
            'ajax' : base_url + 'student/getStudentMoves/' + studentId,
            'order': []
        });
    }
}
/*
*----------------------------
* get class section function
*----------------------------
*/
function getClassSection(classId = null) {
    if (classId) {
        $(".list-group-item").removeClass('active');
        $("#classId" + classId).addClass('active');
        $.ajax({
            url: base_url + 'student/getClassSectionTab/' + classId,
            type: 'post',
            dataType: 'json',
            success: function (response) {
                $("#result").html(response.html);

                manageStudentTable = $("#manageStudentTable").DataTable({
                    'ajax': 'student/fetchStudentByClass/' + classId,
                    'order': []
                });

                /*
                *-------------------------------------
                * retrives from the getclassectiontab
                * function as a json format
                * and stores the section table into
                * the object
                *-------------------------------------
                */
                $.each(response.sectionData, function (index, value) {
                    index += 1;
                    studentSectionTable['studentTable' + index] = $("#manageStudentTable" + index).DataTable({
                        'ajax': 'student/fetchStudentByClassAndSection/' + value.class_id + '/' + value.section_id,
                        'order': []
                    });
                });
            } // /success
        }); // /ajax
    }
}

/*
*-------------------------------
* update student's info function
*-------------------------------
*/
function updateStudent(studentId = null) {
    if (studentId) {
        $('#editRegisterDate').calendarsPicker({
            dateFormat: 'yyyy-mm-dd'
        });

        $('#editDob').calendarsPicker({
            dateFormat: 'yyyy-mm-dd'
        });

        $("#editPhoto").fileinput({
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
            defaultPreviewContent: '<img src="' + base_url + 'assets/images/default/edit_avatar.png" alt="Your Avatar" style="width:208px;height:200px;"><h6 class="text-muted">Click to select</h6>',
            layoutTemplates: {main2: '{preview} {remove} {browse}'},
            allowedFileExtensions: ["jpg", "png", "gif", "JPG", "PNG", "GIF"]
        });

        $(".form-group").removeClass('has-error').removeClass('has-success');
        $('.text-danger').remove();
        // photo
        $('#edit-upload-image-message').html('');
        $(".fileinput-remove-button").click();

        // information
        $('#edit-personal-student-message').html('');


        $.ajax({
            url: base_url + 'student/fetchStudentData/' + studentId,
            type: 'post',
            dataType: 'json',
            success: function (response) {
                $("#editFname").val(response.fname);
                $("#editLname").val(response.lname);
                $("#editDob").val(response.dob);
                $("#editAge").val(response.age);
                $("#editContact").val(response.contact);
                $("#editEmail").val(response.email);
                $("#editAddress").val(response.address);
                $("#editCity").val(response.city);
                $("#editCountry").val(response.country);
                $("#editRegisterDate").val(response.register_date);
                $("#editClassName").val(response.class_id);

                $("#editSectionName").load('fetchClassSection/' + response.class_id, function (i) {
                    $("#editSectionName").val(response.section_id);
                });

                $("#student_photo").attr('src', base_url + response.image);

                $("#editClassName").unbind('change').bind('change', function () {
                    var class_id = $(this).val();
                    $("#editSectionName").load('fetchClassSection/' + class_id);
                });

                // submit the teacher information form
                $("#updateStudentInfoForm").unbind('submit').bind('submit', function () {
                    var form = $(this);
                    var url = form.attr('action');
                    var type = form.attr('method');

                    $.ajax({
                        url: url + '/' + studentId,
                        type: type,
                        data: form.serialize(),
                        dataType: 'json',
                        success: function (response) {
                            if (response.success == true) {
                                $("#edit-personal-student-message").html('<div class="alert alert-success alert-dismissible" role="alert">' +
                                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
                                    response.messages +
                                    '</div>');

                                manageStudentTable.ajax.reload(null, false);

                                // refresh the section table
                                $.each(studentSectionTable, function (index, value) {
                                    studentSectionTable[index].ajax.reload(null, false);
                                });

                                $('.form-group').removeClass('has-error').removeClass('has-success');
                                $('.text-danger').remove();
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
                                    $("#edit-personal-student-message").html('<div class="alert alert-warning alert-dismissible" role="alert">' +
                                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
                                        response.messages +
                                        '</div>');
                                }
                            } // /else
                        } // /success
                    }); // /ajax
                    return false;
                });  // /submit the teacher information form

                // submit the teacher photo form
                $("#updateStudentPhotoForm").unbind('submit').bind('submit', function () {
                    var form = $(this);
                    var formData = new FormData($(this)[0]);
                    var url = form.attr('action') + '/' + studentId;
                    var type = form.attr('method');

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
                                $("#edit-upload-image-message").html('<div class="alert alert-success alert-dismissible" role="alert">' +
                                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
                                    response.messages +
                                    '</div>');

                                manageStudentTable.ajax.reload(null, false);

                                // refresh the section table
                                $.each(studentSectionTable, function (index, value) {
                                    studentSectionTable[index].ajax.reload(null, false);
                                });

                                $('.form-group').removeClass('has-error').removeClass('has-success');
                                $('.text-danger').remove();

                                $(".fileinput-remove-button").click();

                                $.ajax({
                                    url: 'student/fetchStudentData/' + studentId,
                                    type: 'post',
                                    dataType: 'json',
                                    success: function (response) {
                                        $("#student_photo").attr('src', '../' + response.image);
                                    }
                                });

                            } else {
                                $("#edit-upload-image-message").html('<div class="alert alert-warning alert-dismissible" role="alert">' +
                                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
                                    response.messages +
                                    '</div>');
                            } // /else
                        } // /success
                    }); // /ajax
                    return false;
                }); // /submit the teacher photo form

            } // /success
        }); // /ajax

    } // /if
}


/*
*-------------------------------
* move student's info function
*-------------------------------
*/
function moveStudent(studentId = null) {
    if (studentId) {
        $('#moveDate').calendarsPicker({
            dateFormat: 'yyyy-mm-dd'
        });

        $(".form-group").removeClass('has-error').removeClass('has-success');
        $('.text-danger').remove();
        // photo
        $('#move-student-message').html('');

        $.ajax({
            url: base_url + 'student/fetchStudentData/' + studentId,
            type: 'post',
            dataType: 'json',
            success: function (response) {
                $("#moveClassName").val(response.class_id);

                $("#moveSectionName").load('fetchClassSection/' + response.class_id, function (i) {
                    $("#moveSectionName").val(response.section_id);
                });

                $("#moveClassName").unbind('change').bind('change', function () {
                    var class_id = $(this).val();
                    $("#moveSectionName").load('fetchClassSection/' + class_id);
                });

                // submit the teacher information form
                $("#moveStudentForm").unbind('submit').bind('submit', function () {
                    var form = $(this);
                    var url = form.attr('action');
                    var type = form.attr('method');

                    $.ajax({
                        url: url + '/' + studentId,
                        type: type,
                        data: form.serialize(),
                        dataType: 'json',
                        success: function (response) {
                            if (response.success == true) {
                                $("#edit-personal-student-message").html('<div class="alert alert-success alert-dismissible" role="alert">' +
                                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
                                    response.messages +
                                    '</div>');

                                manageStudentTable.ajax.reload(null, false);

                                // refresh the section table
                                $.each(studentSectionTable, function (index, value) {
                                    studentSectionTable[index].ajax.reload(null, false);
                                });

                                $('.form-group').removeClass('has-error').removeClass('has-success');
                                $('.text-danger').remove();
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
                                    $("#move-student-message").html('<div class="alert alert-warning alert-dismissible" role="alert">' +
                                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
                                        response.messages +
                                        '</div>');
                                }
                            } // /else
                        } // /success
                    }); // /ajax
                    return false;
                });  // /submit the student information form

            } // /success
        }); // /ajax

    } // /if
}

/*
*-------------------------------
* remove student's info function
*-------------------------------
*/
function removeStudent(studentId = null) {
    if (studentId) {
        $("#removeStudentBtn").unbind('click').bind('click', function () {
            $.ajax({
                url: 'student/remove/' + studentId,
                type: 'post',
                dataType: 'json',
                success: function (response) {
                    if (response.success == true) {
                        $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">' +
                            '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
                            response.messages +
                            '</div>');

                        manageStudentTable.ajax.reload(null, false);

                        // refresh the section table
                        $.each(studentSectionTable, function (index, value) {
                            studentSectionTable[index].ajax.reload(null, false);
                        });

                        $("#removeStudentModal").modal('hide');
                    } else {
                        $("#messages").html('<div class="alert alert-warning alert-dismissible" role="alert">' +
                            '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
                            response.messages +
                            '</div>');
                    }
                } // /success
            }); // /ajax
        }); // /remove student btn clicked
    } // /if
}
