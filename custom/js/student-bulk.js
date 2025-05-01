var manageStudentTable;
var studentSectionTable = {};
var base_url = $("#base_url").val();

$(document).ready(function() {
    var request = $("#request").text();

    $("#topStudentMainNav").addClass('active');

        $("#addBulkStudentNav").addClass('active');
        $("#createBulkForm").unbind('submit').bind('submit', function() {

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
                        $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
                            '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                            response.messages +
                            '</div>');

                        $('.form-group').removeClass('has-error').removeClass('has-success');
                        $('.text-danger').remove();

                        $('input[type="text"]').val('');
                        $("#createBulkForm")[0].reset();
                    }
                    else {
                        if(response.messages instanceof Object) {
                            $.each(response.messages, function(index, value) {

                                var key = $("#" + index );

                                key.closest('.form-group')
                                    .removeClass('has-error')
                                    .removeClass('has-success')
                                    .addClass(value.length > 0 ? 'has-error' : 'has-success')
                                    .find('.text-danger').remove();

                                key.after(value);
                            });
                        }
                        else {
                            $("#messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
                                '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                                response.messages +
                                '</div>');
                        }
                    } // /else
                } // /.sucess
            }); // /.ajax

            return false;
        });
});

/*
*----------------------------
* get class section function
*----------------------------
*/
function getClassSection(classId = null)
{
    if(classId) {
        $(".list-group-item").removeClass('active');
        $("#classId"+classId).addClass('active');
        $.ajax({
            url: base_url + 'student/getClassSectionTab/'+classId,
            type: 'post',
            dataType: 'json',
            success:function(response) {
                $("#result").html(response.html);

                manageStudentTable = $("#manageStudentTable").DataTable({
                    'ajax' : 'student/fetchStudentByClass/'+classId,
                    'order' : []
                });

                /*
                *-------------------------------------
                * retrives from the getclassectiontab
                * function as a json format
                * and stores the section table into
                * the object
                *-------------------------------------
                */
                $.each(response.sectionData, function(index, value) {
                    index += 1;
                    studentSectionTable['studentTable' + index] = $("#manageStudentTable"+index).DataTable({
                        'ajax' : 'student/fetchStudentByClassAndSection/'+value.class_id+'/'+value.section_id,
                        'order': []
                    });
                });
            } // /success
        }); // /ajax
    }
}

/*
*-------------------------------
* add row student's info function
*-------------------------------
*/
function addRow()
{
    var countTotalTR = $("#addBulkStudentTable tbody tr").length;
    var countId = 0;

    if(countTotalTR <= 0) {
        countId = 1;
    } else {
        var lastRowNumber = $("#addBulkStudentTable tbody tr:last").attr('id');
        var countId = lastRowNumber.substring(3);
        countId = Number(countId) + 1;
    } // /else

    $.ajax({
        url: base_url + 'student/getAppendBulkStudentRow/'+countId,
        type: 'post',
        success:function(response) {
            if($("#addBulkStudentTable tbody tr").length > 1) {
                $("#addBulkStudentTable tbody tr:last").after(response);
            }
            else {
                $("#addBulkStudentTable tbody").append(response);
            }
        } // /success
    }); // ajax
}

/*
*-------------------------------
* remove row studnt's info function
*-------------------------------
*/
function removeRow(rowId = null)
{
    if(rowId) {
        $("#row"+rowId).fadeOut().remove();
    }
}
