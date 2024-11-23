$(function () {
    var uRL  = $('.demo').val();
   
    var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
          toast.addEventListener('mouseenter', Swal.stopTimer)
          toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    });
 
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    const preloader = `<div class="preloader">
                            <img src="../public/assets/images/grid.svg" class="me-4" style="width: 3rem" alt="audio">
                        </div>`;


    // delete data common function
    function destroy_data(name, url) {
        var el = name;
        var id = el.attr('data-id');
        var dltUrl = url + id;
        if (confirm('Are you Sure Want to Delete This')) {
            $.ajax({
                url: dltUrl,
                type: "DELETE",
                cache: false,
                success: function (dataResult) {
                    if (dataResult == '1') {
                        el.parent().parent('tr').remove();
                    } else {
                        Toast.fire({
                            icon: 'error',
                            title: 'Deleted Succesfully.'
                        })
                    }
                }
            });
        }
    }

    function show_formAjax_error(data) {
        if (data.status == 422) {
            $('.error').remove();
            $.each(data.responseJSON.errors, function (i, error) {
                var el = $(document).find('[name="' + i + '"]');
                el.after($('<span class="error">' + error[0] + '</span>'));
            });
        }
    }

    // ========================================
    // script for Student Category module
    // ========================================
    
    $('#addStudentCategory').validate({
           rules: { title: { required: true }, },
        messages: { title: { required: "Please Enter Title" },},
        submitHandler: function (form) {
            var formdata = new FormData(form);
            $.ajax({
                url: uRL + '/staff/student_category',
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function (dataResult) {
                    if (dataResult == '1') {
                        $('#modal-default').modal('hide');
                        Toast.fire({
                            icon: 'success',
                            title: 'Added Succesfully.'
                        });
                        setTimeout(function () { window.location.reload(); }, 1000)
                    }
                },
                error: function (error) {
                    show_formAjax_error(error);
                }
            });
        }
    });

    $(document).on('click', '.editStudentCategory', function () {
        var id = $(this).attr('data-id');
        var dltUrl = 'student_category/' + id + '/edit';
        $.ajax({
            url: dltUrl,
            type: "GET",
            cache: false,
            success: function (dataResult) {
                $('#modal-info input[name=id]').val(dataResult.id);
                $('#modal-info input[name=title]').val(dataResult.title);
                $('#modal-info').modal('show');
            }
        });
    });

    $("#updateStudentCategory").validate({
        rules: { title: { required: true }, },
        messages:{ title: { required: "Please Enter Title" }, },
        submitHandler: function (form) {
            var formdata = new FormData(form);
            var id = $('#modal-info input[name=id]').val();
            $.ajax({
                url: uRL + '/staff/student_category/' + id,
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function (dataResult) {
                    if (dataResult == '1') {
                        $('#modal-info').modal('hide');
                        Toast.fire({
                            icon: 'success',
                            title: 'Updated Succesfully.'
                        });
                        setTimeout(function () { window.location.reload(); }, 1000);
                    }
                },
                error: function (error) {
                    show_formAjax_error(error);
                }
            });
        }
    });
  
    $(document).on("click", ".delete-studentCategory", function () {
        destroy_data($(this), 'student_category/')
    });
    
    // ========================================
    // script for Student module
    // ========================================
    
    $('#addStudent').validate({
        rules: {
             admission_no:{ required: true },
            academic_year:{ required: true },
                    class:{ required: true },
                  section:{ required: true },
                   f_name:{ required: true },
                   l_name:{ required: true },
                   gender:{ required: true },
                      dob:{ required: true },
        },
        messages: {
            admission_no: { required: "Please Enter Student Admission Number" },
            academic_year: { required: "Please Enter Student Academic Year" },
            class: { required: "Please Enter Student Class Name" },
            section: { required: "Please Enter Student Class Section Name" },
            f_name: { required: "Please Enter Student First Name" },
            l_name: { required: "Please Enter Student Last Name" },
            gender: { required: "Please Enter Student Gender" },
               dob: { required: "Please Enter Student Date Of Birth" },
        },
        submitHandler: function (form) {
            var formdata = new FormData(form);
            $.ajax({
                url: uRL + '/staff/students',
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function (dataResult) {
                    if (dataResult == '1') {
                        Toast.fire({
                            icon: 'success',
                            title: 'Added Succesfully.'
                        });
                        setTimeout(function () { window.location.href = uRL + '/staff/students'; }, 1000)
                    }
                },
                error: function (error) {
                    show_formAjax_error(error);
                }
            });
        }
    });

    $("#editStudent").validate({
        rules: {
            admission_no:{ required: true },
            academic_year:{ required: true },
                    class:{ required: true },
                  section:{ required: true },
                   f_name:{ required: true },
                   l_name:{ required: true },
                   gender:{ required: true },
                      dob:{ required: true },
        },
        messages:{ 
            admission_no: { required: "Please Enter Student Admission Number" },
            academic_year: { required: "Please Enter Student Academic Year" },
              class: { required: "Please Enter Student Class Name" },
            section: { required: "Please Enter Student Class Section Name" },
            f_name: { required: "Please Enter Student First Name" },
            l_name: { required: "Please Enter Student Last Name" },
            gender: { required: "Please Enter Student Gender" },
               dob: { required: "Please Enter Student Date Of Birth" },
            status: { required: "Please Enter Staff Status" }, 
        },
        submitHandler: function (form) {
            var id = $('.url').val();
            var formdata = new FormData(form);
            $.ajax({
                url: id,
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function (dataResult) {
                    if (dataResult == '1') {
                        Toast.fire({
                            icon: 'success',
                            title: 'Updated Succesfully.'
                        });
                        setTimeout(function () { window.location.href = uRL + '/staff/students'; }, 1000);
                    }
                },
                error: function (error) {
                    show_formAjax_error(error);
                }
            });
        }
    });
  
    $(document).on("click", ".delete-student", function () {
         destroy_data($(this), 'students/')
    });

    // ========================================
    // script for Parent Details module
    // ========================================
    
    $('#addParent').validate({
        rules: { guardian_email:{ required: true }, },
        messages: { guardian_email: { required: "Please Enter Guardian Email" }, },
        submitHandler: function (form) {
            var formdata = new FormData(form);
            $.ajax({
                url: uRL + '/staff/parents',
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function (dataResult) {
                    if (dataResult == '1') {
                        Toast.fire({
                            icon: 'success',
                            title: 'Added Succesfully.'
                        });
                        setTimeout(function () { window.location.href = uRL + '/staff/parents'; }, 1000)
                    }
                },
                error: function (error) {
                    show_formAjax_error(error);
                }
            });
        }
    });

    $("#editParent").validate({
        rules: { guardian_email:{ required: true }, },
        messages: { guardian_email: { required: "Please Enter Guardian Email" }, },
        submitHandler: function (form) {
            var id = $('.url').val();
            var formdata = new FormData(form);
            $.ajax({
                url: id,
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function (dataResult) {
                    console.log(dataResult);
                    if (dataResult == '1') {
                        Toast.fire({
                            icon: 'success',
                            title: 'Updated Succesfully.'
                        });
                        setTimeout(function () { window.location.href = uRL + '/staff/parents'; }, 1000);
                    }
                },
                error: function (error) {
                    show_formAjax_error(error);
                }
            });
        }
    });
  
    $(document).on("click", ".delete-parent", function () {
        destroy_data($(this), 'parents/')
    });

    //========================================
   // script for Change Select module
   // ========================================
    $('.class-select').change(function(){
        var val = $(this).children('option:selected').val();
        var sections = null;
        if( $(this).children('option:selected').attr('data-sections')){
            sections = $(this).children('option:selected').attr('data-sections');
        }
        $.ajax({
            url: uRL + '/get-class-section',
            type: 'POST',
            data: {class_id:val,sections:sections},
            success:function(response){ 
                $('.section-select').html(response);
            }
        })
    });

    // ========================================
    // script for Student Attandance Show Table module
    // ========================================

    $(".student-attandance").click(function() {
        var class_id = $('.class-select option:selected').val();
        var section_id = $('.class-section').val();
        var date = $('.att-date').val();
        $.ajax({
            type: "POST",
            url: uRL + '/staff/student-attendance/create',
            data: {date: date,class_id:class_id,section_id:section_id},
            success: function (responce) {
                $(".attendance-table").css("display", "block");
                $("tbody").html(responce);
            }
        });
    });

    // ========================================
    // script for Add Student Attandance module
    // ========================================
    
    $("#add-attendance").submit(function(e) {
        e.preventDefault();
        var formdata = new FormData(this);
        $.ajax({
            url: uRL + '/staff/student-attendance/store',
            type: 'POST',
            data: formdata,
            processData: false,
            contentType: false,
            success: function (dataResult) {
                console.log(dataResult);
                if (dataResult == '1') {
                    Toast.fire({
                        icon: 'success',
                        title: 'Added Succesfully.'
                    });
                    setTimeout(function () { window.location.href = uRL + '/staff/student-attendance'; }, 1000)
                }
            },
            error: function (error) {
                show_formAjax_error(error);
            }
        });
    });
    

    $(document).on("click", ".view_leave", function () {
        var id = $(this).attr('data-id');
        var url = $(this).attr('data-url');
        $.ajax({
            url: url + '/' + id,
            type: "GET",
            cache: false,
            success: function (dataResult) {
                console.log(dataResult);
                $('#view-applyLeave #id').html(dataResult[0].id);
                $('#view-applyLeave #apply_date').html(dataResult[0].apply_date);
                $('#view-applyLeave #leave_from').html(dataResult[0].leave_from);
                $('#view-applyLeave #leave_to').html(dataResult[0].leave_to);
                $('#view-applyLeave #leave_type').html(dataResult[0].type_id);
                $('#view-applyLeave #reason').html(dataResult[0].reason);
                var approve_status = dataResult[0].approve_status;
                if(approve_status == '0') {
                    $('#view-applyLeave #status').html('<label class="badge bg-light-warning">Pending</label>');
                }else if (approve_status == '1') {
                    $('#view-applyLeave #status').html('<label class="badge bg-light-success">Approve</label>');
                }else {
                    $('#view-applyLeave #status').html('<label class="badge bg-light-danger">Reject</label>');
                }
                $('#view-applyLeave').modal('show');
            },
            error: function (error) {
                show_formAjax_error(error);
            }
        });
    });
  
    $(document).on("click", ".change_status", function () {
        var id = $(this).attr('data-id');
        var val = $(this).attr('data-value');
        var url = $(this).attr('data-url');
        $.ajax({
            url: url + '/change-leave-status',
            type: "POST",
            data: {  id:id,approve_status:val},
            cache: false,
            success: function (dataResult) {
                window.location.reload();  
            },
            error: function (error) {
                show_formAjax_error(error);
            }
        });
    });

    // ========================================
    // script for Teacher Apply Leave module
    // ========================================

    $('#add_staffLeave').validate({
        rules: { 
            applyDate: { required: true},
            from_date: { required: true },
            to_date: { required: true },
            leave_type: { required: true },
            reason: { required: true },
        },
        messages: { 
            applyDate: { required: "Please Enter Apply Date" }, 
            from_date: { required: "Please Enter From Date Leave" },
            to_date: { required: "Please Enter To Date Leave" },
            leave_type: { required: "Please Enter Leave Type" },
            reason: { required: "Please Enter Reason Name" } 
        },
        submitHandler: function (form) {
            var url = $('.url').val();
          //  alert(url);
            var formdata = new FormData(form);
            $.ajax({
                url: url,
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function (dataResult) {
                    //console.log(dataResult);
                    if (dataResult == '1') {
                        $('#modal-default').modal('hide');
                        Toast.fire({
                            icon: 'success',
                            title: 'Added Succesfully.'
                        });
                        // setTimeout(function () { window.location.href = url + '/staff/staff-leaves'; }, 1000)
                        setTimeout(function () { window.location.reload(); }, 1000)
                    }
                },
                error: function (error) {
                    show_formAjax_error(error);
                }
            });
        }
    });

     // ========================================================
    // script for Show Days Student Attandance Show Table module
    // =========================================================

    $(".student-att-report").click(function() {
        var class_id = $('.class-select option:selected').val();
        var section_id = $('.class-section').val();
        var month = $('.att-month').val();
        $.ajax({
            type: "GET",
            url: uRL + '/staff/student-attendance-report',
            data: {class_id: class_id,section_id:section_id, month: month},
            success: function (dataResult) {
                $(".att-table").html(dataResult);
            }
        });
    });
    
});