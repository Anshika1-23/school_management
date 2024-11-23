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

    $('.change-logo').click(function () {
        $('.change-com-img').click();
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
                            title: dataResult
                        })
                    }
                }
            });
        }
    }

    function show_formAjax_error(data) {
        $('.preloader').remove();
        if (data.status == 422) {
            $('.error').remove();
            $.each(data.responseJSON.errors, function (i, error) {
                var el = $(document).find('[name="' + i + '"]');
                el.after($('<span class="error">' + error[0] + '</span>'));
            });
        }
    }

    // ========================================
    // script for Admin Logout
    // ========================================

    $('.admin-logout').click(function () {
        $.ajax({
            url: uRL + '/admin/logout',
            type: "GET",
            cache: false,
            success: function (dataResult) {
                if (dataResult == '1') {
                    setTimeout(function () {
                        window.location.href = uRL + '/admin';
                    }, 500);
                    Toast.fire({
                        icon: 'success',
                        title: 'Logged Out Succesfully.'
                    })
                }
            }
        });
    });

    // ========================================
    // script for Session module
    // ========================================
    
    // $('#addSession').validate({
    //     rules: {
    //         title: { required: true },
    //         start_date: { required: true },
    //         end_date: { required: true },
    //     },
    //     messages: {
    //         title: { required: "Please Enter Session Title Name" },
    //         start_date: { required: "Please Enter Session Start Date Name" },
    //         end_date: { required: "Please Enter Session End Date Name" },
    //     },
    //     submitHandler: function (form) {
    //         var formdata = new FormData(form);
    //         $.ajax({
    //             url: uRL + '/admin/sessions',
    //             type: 'POST',
    //             data: formdata,
    //             processData: false,
    //             contentType: false,
    //             success: function (dataResult) {
    //                 if (dataResult == '1') {
    //                     Toast.fire({
    //                         icon: 'success',
    //                         title: 'Added Succesfully.'
    //                     });
    //                     setTimeout(function () { window.location.href = uRL + '/admin/sessions'; }, 1000)
    //                 }
    //             },
    //             error: function (error) {
    //                 show_formAjax_error(error);
    //             }
    //         });
    //     }
    // });

    // $("#editSession").validate({
    //     rules: {
    //         title: { required: true },
    //         start_date: { required: true },
    //         end_date: { required: true },
    //         status: { required: true },
    //     },
    //     messages:{ 
    //         title: { required: "Please Enter Blog Title Name" },
    //         start_date: { required: "Please Enter Session Start Date Name" },
    //         end_date: { required: "Please Enter Session End Date Name" },
    //         status: { required: "Please Enter Session Status" }, 
    //     },
    //     submitHandler: function (form) {
    //         var id = $('.url').val();
    //         var formdata = new FormData(form);
    //         $.ajax({
    //             url: id,
    //             type: 'POST',
    //             data: formdata,
    //             processData: false,
    //             contentType: false,
    //             success: function (dataResult) {
    //                 if (dataResult == '1') {
    //                     Toast.fire({
    //                         icon: 'success',
    //                         title: 'Updated Succesfully.'
    //                     });
    //                     setTimeout(function () { window.location.href = uRL + '/admin/sessions'; }, 1000);
    //                 }
    //             },
    //             error: function (error) {
    //                 show_formAjax_error(error);
    //             }
    //         });
    //     }
    // });
  
    // $(document).on("click", ".delete-session", function () {
    //     alert(1);
    //     destroy_data($(this), 'sessions/')
    // });


    // ========================================
    // script for Section module
    // ========================================

    $('#addSection').validate({
        rules: { title: { required: true }, },
        messages: { title: { required: "Please Enter Section Name" }, },
        submitHandler: function (form) {
            $('form').append(preloader);
            var formdata = new FormData(form);
            $.ajax({
                url: uRL + '/admin/sections',
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
                        setTimeout(function () { window.location.reload(); }, 1000);
                        $('.preloader').remove();
                    }
                },
                error: function (error) {
                    show_formAjax_error(error);
                }
            });
        }
    });

    $(document).on('click', '.editSection', function () {
        var id = $(this).attr('data-id');
        var dltUrl = 'sections/' + id + '/edit';
        $.ajax({
            url: dltUrl,
            type: "GET",
            cache: false,
            success: function (dataResult) {
                $('#modal-info input[name=id]').val(dataResult.id);
                $('#modal-info input[name=title]').val(dataResult.title);
                $('#modal-info input[name=status]').val(dataResult.status);
                $("#modal-info select[name=status] option").each(function () {
                    if ($(this).val() == dataResult.status) {
                        $(this).attr('selected', true);
                    }
                });
                $('#modal-info .u-url').val($('#modal-info .u-url').val() + '/' + dataResult.id);
                $('#modal-info').modal('show');

            }
        });
    });

    $("#editSection").validate({
        rules: {
            title: { required: true },
            status: { required: true }
        },
        messages: {
            title: { required: "Please Enter Section Name" },
            status: { required: "Please Enter Status" }
        },
        submitHandler: function (form) {
            var id = $('#modal-info input[name=id]').val();
            var formdata = new FormData(form);
            $('form').append(preloader);
            $.ajax({
                url: uRL + '/admin/sections/' + id,
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
                        $('.preloader').remove();
                    }
                },
                error: function (error) {
                    show_formAjax_error(error);
                }
            });
        }
    });

    $(document).on("click", ".delete-section", function () {
        destroy_data($(this), 'sections/')
    });

    // ========================================
    // script for Student Class module
    // ========================================
    
    $('#addClass').validate({
        rules: {
            title: { required: true },
        },
        messages: {
            title: { required: "Please Enter Class Name" },
        },
        submitHandler: function (form) {
            if($('input[name="section[]"]:checked').val() == undefined){
                $('input[name="section[]"]').parent().parent().parent().append('<span class="text-danger">Select Sections</span>');
            }else{
                $('form').append(preloader);
                var formdata = new FormData(form);
                $.ajax({
                    url: uRL + '/admin/classes',
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
                            setTimeout(function () { window.location.href = uRL + '/admin/classes'; }, 3000);
                            $('.preloader').remove();
                        }
                    },
                    error: function (error) {
                        show_formAjax_error(error);
                    }
                });
            }
        }
    });

    $("#editClass").validate({
        rules: {
            title: { required: true },
            section: { required: true },
            status: { required: true },
        },
        messages:{ 
            title: { required: "Please Enter Class Name" },
            section: { required: "Please Enter Section Name" },
            status: { required: "Please Enter Section Status" }, 
        },
        submitHandler: function (form) {
            var id = $('.url').val();
            $('form').append(preloader);
            var formdata = new FormData(form);
            if($('input[name="section[]"]:checked').val() == undefined){
                $('input[name="section[]"]').parent().parent().parent().append('<span class="text-danger">Select Sections</span>');
            }else{
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
                            setTimeout(function () { window.location.href = uRL + '/admin/classes'; }, 3000);
                            $('.preloader').remove();
                        }
                    },
                    error: function (error) {
                        show_formAjax_error(error);
                    }
                });
            }
        }
    });
  
    $(document).on("click", ".delete-class", function () {
        destroy_data($(this), 'classes/')
    });


    // ========================================
    // script for Subject module
    // ========================================
    
    $('#addSubject').validate({
        rules: {
            title: { required: true },
            title_type: { required: true },
        },
        messages: {
            title: { required: "Please Enter Subject Name" },
            title_type: { required: "Please Enter Subject Type Name" },
        },
        submitHandler: function (form) {
            $('form').append(preloader);
            var formdata = new FormData(form);
            $.ajax({
                url: uRL + '/admin/subjects',
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
                        setTimeout(function () { window.location.href = uRL + '/admin/subjects'; }, 1000);
                        $('.preloader').remove();
                    }
                },
                error: function (error) {
                    show_formAjax_error(error);
                }
            });
        }
    });

    $("#editSubject").validate({
        rules: {
            title: { required: true },
            title_type: { required: true },
            status: { required: true },
        },
        messages:{ 
            title: { required: "Please Enter Subject Name" },
            title_type: { required: "Please Enter Subject Type Name" },
            status: { required: "Please Enter Subject Status" }, 
        },
        submitHandler: function (form) {
            var id = $('.url').val();
            $('form').append(preloader);
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
                        setTimeout(function () { window.location.href = uRL + '/admin/subjects'; }, 1000);
                        $('.preloader').remove();
                    }
                },
                error: function (error) {
                    show_formAjax_error(error);
                }
            });
        }
    });
  
    $(document).on("click", ".delete-subject", function () {
        destroy_data($(this), 'subjects/')
    });

    //========================================
   // script for Change Select module
   // ========================================
    $('.class-select').change(function(){
        var val = $(this).children('option:selected').val();
        $.ajax({
            url: uRL + '/get-class-section',
            type: 'POST',
            data: {class_id:val},
            success:function(response){
                $('.section-select').html(response);
            }
        })
    });

     // ========================================
    // script for Assign Class Teacher Class module
    // ========================================
    
    $('#addAssignClassTeacher').validate({
        rules: {
           class_id: { required: true },
            section: { required: true },
             teacher: { required: true },
        },
        messages: {
           class_id: { required: "Please Enter Class Name" },
            section: { required: "Please Enter Section Name" },
            teacher: { required: "Please Enter Teacher Name" },
        },
        submitHandler: function (form) {
            var formdata = new FormData(form);
            $('form').append(preloader);
            $.ajax({
                url: uRL + '/admin/assign-class-teacher',
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
                        setTimeout(function () { window.location.href = uRL + '/admin/assign-class-teacher'; }, 1000);
                        $('.preloader').remove();
                    }else if(dataResult=="Assigned"){
                        Toast.fire({
                            icon: 'warning',
                            title: 'Teacher Class Already Assigned.'
                        });
                    }
                },
                error: function (error) {
                    show_formAjax_error(error);
                }
            });
        }
    });

    $("#editAssignClassTeacher").validate({
        rules: {
            class_id: { required: true },
            section: { required: true },
            teacher: { required: true },
            status: { required: true },
        },
        messages:{ 
            class_id: { required: "Please Enter Class Name" },
            section: { required: "Please Enter Section Name" },
            teacher: { required: "Please Enter Teacher Name" },
            status: { required: "Please Enter Section Status" }, 
        },
        submitHandler: function (form) {
            var id = $('.url').val();
            var formdata = new FormData(form);
            $('form').append(preloader);
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
                        setTimeout(function () { window.location.href = uRL + '/admin/assign-class-teacher'; }, 1000);
                        $('.preloader').remove();
                    }
                },
                error: function (error) {
                    show_formAjax_error(error);
                }
            });
        }
    });
  
    $(document).on("click", ".delete-assignClassTeacher", function () {
        destroy_data($(this), 'assign-class-teacher/')
    });


    // ========================================
    // script for Assign Subject Teacher Class module
    // ========================================

    $('#assignSubject-form').validate({
        rules: {
            class: { required: true },
            section: { required: true },
        },
        messages: {
            class: { required: "Select Class" },
            section: { required: "Select Section" },
        },
        submitHandler: function (form) {
            var formdata = new FormData(form);
            $('#assignSubject-form').append(preloader);
            $.ajax({
                url: uRL + '/admin/show-assigned-subjects',
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function (dataResult) {
                    $('.preloader').remove();
                    $('.show-assigned-subjects').html(dataResult);
                },
                error: function (error) {
                    show_formAjax_error(error);
                }
            });
        }
    })

    $('#assignedSubject-list').validate({
        rules: {
            "subject[]": { required: true },
            "teacher[]": { required: true },
         },
         messages: {
            "subject[]": { required: "Select Subject" },
            "teacher[]": { required: "Select Teacher" },
        },
        submitHandler: function (form) {
            $('.text-danger').remove();
            var formdata = new FormData(form);
            let empty_subject = 0;
            let empty_teacher = 0;
            $('.subject').each(function(){
                if($(this).val() == null){
                    empty_subject++;
                    $(this).after('<span class="text-danger">Select Subject.</span>');
                }
            });
            $('.teacher').each(function(){
                if($(this).val() == null){
                    empty_teacher++;
                    $(this).after('<span class="text-danger">Select Teacher.</span>')
                }
            });
            if(empty_subject == 0 && empty_teacher == 0){
                $('#assignedSubject-list').append(preloader);
                $.ajax({
                    url: uRL + '/admin/assign-subject-teacher',
                    type: 'POST',
                    data: formdata,
                    processData: false,
                    contentType: false,
                    success: function (dataResult) {
                        $('.preloader').remove();
                        if (dataResult == '1') {
                            Toast.fire({
                                icon: 'success',
                                title: 'Updated Succesfully.'
                            });
                        }
                    },
                    error: function (error) {
                        show_formAjax_error(error);
                    }
                });
            }
        }
    })
    
    $('#addAssignSubjectTeacher').validate({
        rules: {
           class_id: { required: true },
            section: { required: true },
            teacher: { required: true },
            subject: { required: true },
        },
        messages: {
           class_id: { required: "Please Enter Class Name" },
            section: { required: "Please Enter Section Name" },
            teacher: { required: "Please Enter Teacher Name" },
            subject: { required: "Please Enter Subject Name" },
        },
        submitHandler: function (form) {
            var formdata = new FormData(form);
            $('form').append(preloader);
            $.ajax({
                url: uRL + '/admin/assign-subject-teacher',
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
                        setTimeout(function () { window.location.href = uRL + '/admin/assign-subject-teacher'; }, 1000);
                        $('.preloader').remove();
                    }
                },
                error: function (error) {
                    show_formAjax_error(error);
                }
            });
        }
    });

    $("#editAssignSubjectTeacher").validate({
        rules: {
            class_id:{ required: true },
            section:{ required: true },
            teacher:{ required: true },
            subject:{ required: true },
            status:{ required: true },
        },
        messages:{ 
            class_id:{ required: "Please Enter Class Name"  },
            section:{ required: "Please Enter Section Name" },
            teacher:{ required: "Please Enter Teacher Name" },
            subject:{ required: "Please Enter Subject Name" },
             status:{ required: "Please Enter Status" }, 
        },
        submitHandler: function (form) {
            var id = $('.url').val();
            var formdata = new FormData(form);
            $('form').append(preloader);
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
                        setTimeout(function () { window.location.href = uRL + '/admin/assign-subject-teacher'; }, 1000);
                        $('.preloader').remove();
                    }
                },
                error: function (error) {
                    show_formAjax_error(error);
                }
            });
        }
    });
  
    $(document).on("click", ".delete-assignSubjectTeacher", function () {
        destroy_data($(this), 'assign-subject-teacher/')
    });

    // ========================================
    // script for Role module
    // ========================================

    $('#addRole').validate({
        rules: { title: { required: true }, },
        messages: { title: { required: "Please Enter Role Name" }, },
        submitHandler: function (form) {
            var formdata = new FormData(form);
            $('form').append(preloader);
            $.ajax({
                url: uRL + '/admin/roles',
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
                        setTimeout(function () { window.location.reload(); }, 1000);
                        $('.preloader').remove();
                    }
                },
                error: function (error) {
                    show_formAjax_error(error);
                }
            });
        }
    });

    $(document).on('click', '.editRole', function () {
        var id = $(this).attr('data-id');
        var dltUrl = 'roles/' + id + '/edit';
        $.ajax({
            url: dltUrl,
            type: "GET",
            cache: false,
            success: function (dataResult) {
                $('#modal-info input[name=id]').val(dataResult.id);
                $('#modal-info input[name=title]').val(dataResult.title);
                $('#modal-info input[name=status]').val(dataResult.status);
                $("#modal-info select[name=status] option").each(function () {
                    if ($(this).val() == dataResult.status) {
                        $(this).attr('selected', true);
                    }
                });
                $('#modal-info .u-url').val($('#modal-info .u-url').val() + '/' + dataResult.id);
                $('#modal-info').modal('show');

            }
        });
    });

    $("#editRole").validate({
        rules: {
            title: { required: true },
            status: { required: true }
        },
        messages: {
            title: { required: "Please Enter Role Name" },
            status: { required: "Please Enter Status" }
        },
        submitHandler: function (form) {
            var id = $('#modal-info input[name=id]').val();
            var formdata = new FormData(form);
            $('form').append(preloader);
            $.ajax({
                url: uRL + '/admin/roles/' + id,
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
                        $('.preloader').remove();
                    }
                },
                error: function (error) {
                    show_formAjax_error(error);
                }
            });
        }
    });

    $(document).on("click", ".delete-role", function () {
        destroy_data($(this), 'roles/')
    });

    // ========================================
    // script for Department module
    // ========================================

    $('#addDepartment').validate({
        rules: { title: { required: true }, },
        messages: { title: { required: "Please Enter Department Name" }, },
        submitHandler: function (form) {
            var formdata = new FormData(form);
            $('form').append(preloader);
            $.ajax({
                url: uRL + '/admin/departments',
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
                        setTimeout(function () { window.location.reload(); }, 1000);
                        $('.preloader').remove();
                    }
                },
                error: function (error) {
                    show_formAjax_error(error);
                }
            });
        }
    });

    $(document).on('click', '.editDepartment', function () {
        var id = $(this).attr('data-id');
        var dltUrl = 'departments/' + id + '/edit';
        $.ajax({
            url: dltUrl,
            type: "GET",
            cache: false,
            success: function (dataResult) {
                $('#modal-info input[name=id]').val(dataResult.id);
                $('#modal-info input[name=title]').val(dataResult.title);
                $('#modal-info input[name=status]').val(dataResult.status);
                $("#modal-info select[name=status] option").each(function () {
                    if ($(this).val() == dataResult.status) {
                        $(this).attr('selected', true);
                    }
                });
                $('#modal-info .u-url').val($('#modal-info .u-url').val() + '/' + dataResult.id);
                $('#modal-info').modal('show');

            }
        });
    });

    $("#editDepartment").validate({
        rules: {
            title: { required: true },
            status: { required: true }
        },
        messages: {
            title: { required: "Please Enter Department Name" },
            status: { required: "Please Enter Status" }
        },
        submitHandler: function (form) {
            var id = $('#modal-info input[name=id]').val();
            var formdata = new FormData(form);
            $('form').append(preloader);
            $.ajax({
                url: uRL + '/admin/departments/' + id,
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
                        $('.preloader').remove();
                    }
                },
                error: function (error) {
                    show_formAjax_error(error);
                }
            });
        }
    });

    $(document).on("click", ".delete-department", function () {
        destroy_data($(this), 'departments/')
    });

    // ========================================
    // script for Designation module
    // ========================================

    $('#addDesignation').validate({
        rules: { title: { required: true }, },
        messages: { title: { required: "Please Enter Designation Name" }, },
        submitHandler: function (form) {
            var formdata = new FormData(form);
            $('form').append(preloader);
            $.ajax({
                url: uRL + '/admin/designations',
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
                        setTimeout(function () { window.location.reload(); }, 1000);
                        $('.preloader').remove();
                    }
                },
                error: function (error) {
                    show_formAjax_error(error);
                }
            });
        }
    });

    $(document).on('click', '.editDesignation', function () {
        var id = $(this).attr('data-id');
        var dltUrl = 'designations/' + id + '/edit';
        $.ajax({
            url: dltUrl,
            type: "GET",
            cache: false,
            success: function (dataResult) {
                $('#modal-info input[name=id]').val(dataResult.id);
                $('#modal-info input[name=title]').val(dataResult.title);
                $('#modal-info input[name=status]').val(dataResult.status);
                $("#modal-info select[name=status] option").each(function () {
                    if ($(this).val() == dataResult.status) {
                        $(this).attr('selected', true);
                    }
                });
                $('#modal-info .u-url').val($('#modal-info .u-url').val() + '/' + dataResult.id);
                $('#modal-info').modal('show');

            }
        });
    });

    $("#editDesignation").validate({
        rules: {
            title: { required: true },
            status: { required: true }
        },
        messages: {
            title: { required: "Please Enter Designation Name" },
            status: { required: "Please Enter Status" }
        },

        submitHandler: function (form) {
            var formdata = new FormData(form);
            $('form').append(preloader);
            var id = $('#modal-info input[name=id]').val();
            $.ajax({
                url: uRL + '/admin/designations/' + id,
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
                        $('.preloader').remove();
                    }
                },
                error: function (error) {
                    show_formAjax_error(error);
                }
            });
        }
    });

    $(document).on("click", ".delete-designation", function () {
        destroy_data($(this), 'designations/')
    });

    // ========================================
    // script for Academic Year module
    // ========================================
    
    $('#addAcademicYear').validate({
        rules: {
            title: { required: true },
            year: { required: true },
            start_date: { required: true },
            end_date: { required: true },
        },
        messages: {
            title: { required: "Please Enter Title" },
            year: { required: "Please Enter Year" },
            start_date: { required: "Please Enter Start Date" },
            end_date: { required: "Please Enter End Date" },
        },
        submitHandler: function (form) {
            var formdata = new FormData(form);
            $('form').append(preloader);
            $.ajax({
                url: uRL + '/admin/academic_years',
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
                        setTimeout(function () { window.location.href = uRL + '/admin/academic_years'; }, 1000);
                        $('.preloader').remove();
                    }
                },
                error: function (error) {
                    show_formAjax_error(error);
                }
            });
        }
    });

    $("#updateAcademicYear").validate({
        rules: {
            title: { required: true },
            year: { required: true },
            start_date: { required: true },
            end_date: { required: true },
        },
        messages:{ 
            title: { required: "Please Enter Title" },
            year: { required: "Please Enter Year" },
            start_date: { required: "Please Enter Start Date" },
            end_date: { required: "Please Enter End Date" },
        },
        submitHandler: function (form) {
            var id = $('.id').val();
            var formdata = new FormData(form);
            $('form').append(preloader);
            $.ajax({
                url: uRL + '/admin/academic_years/'+id,
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function (dataResult) {
                    $('.preloader').remove();
                    if (dataResult == '1') {
                        Toast.fire({
                            icon: 'success',
                            title: 'Updated Succesfully.'
                        });
                        setTimeout(function () { window.location.href = uRL + '/admin/academic_years'; }, 1000);
                    }
                },
                error: function (error) {
                    show_formAjax_error(error);
                }
            });
        }
    });
  
    $(document).on("click", ".delete-academicYear", function () {
        destroy_data($(this), 'academic_years/')
    });


    // ========================================
    // script for Student Category module
    // ========================================
    
    $('#addStudentCategory').validate({
           rules: { title: { required: true },},
        messages: { title: { required: "Please Enter Title" }, },
        submitHandler: function (form) {
            var formdata = new FormData(form);
            $('form').append(preloader);
            $.ajax({
                url: uRL + '/admin/student_category',
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
                        setTimeout(function () { window.location.reload(); }, 1000);
                        $('.preloader').remove();
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
            var id = $('#modal-info input[name=id]').val();
            var formdata = new FormData(form);
            $('form').append(preloader);
            $.ajax({
                url: uRL + '/admin/student_category/' + id,
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
                        $('.preloader').remove();
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
    // Script For Get Parent Type
    // ========================================

    $('.parent-type').change(function(){
        if($(this).val() == 'sibling'){
            $('.staff-input').addClass('d-none');
            $('.student-input').removeClass('d-none');
        }else{
            $('.staff-input').removeClass('d-none');
            $('.student-input').addClass('d-none');
        }
    });

    //========================================
   // script for Select Sibling Class For Get Parents Detail module
   // ========================================
   $('.sibling-class').change(function(){
    var val = $(this).children('option:selected').val();
        $.ajax({
            url: uRL + '/get-class-section',
            type: 'POST',
            data: {class_id:val},
            success:function(response){
                $('.sibling-section').html(response);
            }
        })
    })

    $('.sibling-section').change(function(){
        var sib_class = $('.sibling-class option:selected').val();
        var sib_sec = $(this).children('option:selected').val();
        $.ajax({
            url: uRL + '/get-section-students',
            type: 'POST',
            data: {class:sib_class,section:sib_sec},
            success:function(response){
                $('.sibling').html(response);
            }
        })
    });

    $('.save-sibling').click(function(){
        $('.error').empty();
        var parent_type = $('.parent-type:checked').val();
        if(parent_type == 'sibling'){
            var s_class = $('.sibling-class').val();
            var s_section = $('.sibling-section').val();
            var sibling = $('.sibling').val();
            if(s_class == null || s_section == null || sibling == null){
                $('.error').html('Please Fill All the Fields.');
            }else{
                $('input[name=old_parent_id]').val(sibling);
                $('input[name=student_parent_type]').val(parent_type);
                $.ajax({
                    url: uRL + '/get-sibling-parent-info',
                    type: 'POST',
                    data: {parent_type:parent_type,sibling:sibling},
                    success:function(response){
                        $('.old-parent-info').html(response);
                    }
                })
            }
            $('.parent-body').addClass('d-none');
            $('#parents-modal').modal('hide');
        }else{
            var staff = $('.parent-staff').val();
            console.log(staff);
            if(staff == null){
                $('.error').html('Please Fill All the Fields.');
            }else{
                $('input[name=old_parent_id]').val(staff);
                $('input[name=student_parent_type]').val(parent_type);
                $.ajax({
                    url: uRL + '/get-sibling-parent-info',
                    type: 'POST',
                    data: {parent_type:parent_type,sibling:staff},
                    success:function(response){
                        $('.old-parent-info').html(response);
                    }
                })
            }
            $('.parent-body').addClass('d-none');
            $('#parents-modal').modal('hide');
        }
    });

    $(document).on('click','.remove-sibling-parent',function(){
        $('input[name=old_parent_id]').val('');
        $('input[name=student_parent_type]').val('');
        $('.old-parent-info').empty();
        $('.parent-body').removeClass('d-none');
    });

    $('#addStudent').validate({
        rules: {
             admission_no:{ required: true },
            academic_year:{ required: true },
                 stdClass:{ required: true },
                  section:{ required: true },
                //    f_name:{ required: true },
                   l_name:{ required: true },
                   gender:{ required: true },
                      dob:{ required: true }, 
        },
        messages: {
             admission_no: { required: "Please Enter Student Admission Number" },
            academic_year: { required: "Please Enter Student Academic Year" },
                 stdClass: { required: "Please Enter Student Class Name" },
                  section: { required: "Please Enter Student Class Section Name" },
                //    f_name: { required: "Please Enter Student First Name" },
                   l_name: { required: "Please Enter Student Last Name" },
                   gender: { required: "Please Enter Student Gender" },
                      dob: { required: "Please Enter Student Date Of Birth" },
        },
        submitHandler: function (form) {
            var formdata = new FormData(form);
            $('form').append(preloader);
            $.ajax({
                url: uRL + '/admin/students',
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
                        setTimeout(function () { window.location.href = uRL + '/admin/students'; }, 1000);
                        $('.preloader').remove();
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
                 stdClass:{ required: true },
                  section:{ required: true },
                   f_name:{ required: true },
                   l_name:{ required: true },
                   gender:{ required: true },
                      dob:{ required: true },
        },
        messages:{ 
            admission_no: { required: "Please Enter Student Admission Number" },
            academic_year: { required: "Please Enter Student Academic Year" },
            stdClass: { required: "Please Enter Student Class Name" },
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
            $('form').append(preloader);
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
                        setTimeout(function () { window.location.href = uRL + '/admin/students'; }, 1000);
                        $('.preloader').remove();
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
    // script for HomeWork module
    // ========================================
    $('.homework-class').change(function(){
        var cls = $('.homework-class option:selected').val();
        $.ajax({
            type: "POST",
            url: uRL + '/admin/get-class-subjects',
            data: {cls:cls},
            success: function (response) {
            $('.subject-select').html(response);
                
            }
        });
    });    


    $('#addHomeWork').validate({
        rules: {
             class_id:{ required: true },
              section:{ required: true },
              subject:{ required: true },
            work_date:{ required: true },
      submission_date:{ required: true },
                 mark:{ required: true },
                  des:{ required: true },
        },
        messages: {
                 class_id: { required: "Please Enter Class Id" },
                  section: { required: "Please Enter Section" },
                  subject: { required: "Please Enter Subject Name" },
                work_date: { required: "Please Enter HomeWork Date" },
          submission_date: { required: "Please Enter Submission Date" },
                     mark: { required: "Please Enter Student Marks" },
                      des: { required: "Please Enter Description" },
                   
        },
        submitHandler: function (form) {
            var formdata = new FormData(form);
            $('form').append(preloader);
            $.ajax({
                url: uRL + '/admin/homework',
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
                        setTimeout(function () { window.location.href = uRL + '/admin/homework'; }, 1000);
                        $('.preloader').remove();
                    }
                },
                error: function (error) {
                    show_formAjax_error(error);
                }
            });
        }
    });

    $("#editHomeWork").validate({
        rules: {
                class_id:{ required: true },
                 section:{ required: true },
                 subject:{ required: true },
               work_date:{ required: true },
         submission_date:{ required: true },
                    mark:{ required: true },
                     des:{ required: true },
        },
        messages: {
                class_id: { required: "Please Enter Class Id" },
                 section: { required: "Please Enter Section" },
                 subject: { required: "Please Enter Subject Name" },
               work_date: { required: "Please Enter HomeWork Date" },
         submission_date: { required: "Please Enter Submission Date" },
                    mark: { required: "Please Enter Student Marks" },
                     des: { required: "Please Enter Description" },
                  
        },
        submitHandler: function (form) {
            var id = $('.url').val();
            var formdata = new FormData(form);
            $('form').append(preloader);
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
                        setTimeout(function () { window.location.href = uRL + '/admin/homework'; }, 1000);
                        $('.preloader').remove();
                    }
                },
                error: function (error) {
                    show_formAjax_error(error);
                }
            });
        }
    });
  
    $(document).on("click", ".delete-homework", function () {
        destroy_data($(this), 'homework/')
    });


     // ========================================
    // script for Staff module
    // ========================================
    
    $('#addDocument').validate({
           rules: { title:{ required: true }, },
        messages: { title: { required: "Please Enter Document Info" }, },
        submitHandler: function (form) {
            var formdata = new FormData(form);
            $('form').append(preloader);
            $.ajax({
                url: uRL + '/admin/doc-info',
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
                        setTimeout(function () { window.location.href = uRL + '/admin/doc-info'; }, 1000);
                        $('.preloader').remove();
                    }
                },
                error: function (error) {
                    show_formAjax_error(error);
                }
            });
        }
    });

    $("#editDocument").validate({
        rules: { title: { required: true },},
        messages:{ title: { required: "Please Enter Document Info" }, },
        submitHandler: function (form) {
            var id = $('.url').val();
            var formdata = new FormData(form);
            $('form').append(preloader);
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
                        setTimeout(function () { window.location.href = uRL + '/admin/doc-info'; }, 1000);
                        $('.preloader').remove();
                    }
                },
                error: function (error) {
                    show_formAjax_error(error);
                }
            });
        }
    });
  
    $(document).on("click", ".delete-document", function () {
        destroy_data($(this), 'doc-info/')
    });


    // ========================================
    // script for Parent Details module
    // ========================================
    
    $('#addParent').validate({
        rules: { guardian_email:{ required: true }, },
        messages: { guardian_email: { required: "Please Enter Guardian Email" }, },
        submitHandler: function (form) {
            var formdata = new FormData(form);
            $('form').append(preloader);
            $.ajax({
                url: uRL + '/admin/parents',
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
                        setTimeout(function () { window.location.href = uRL + '/admin/parents'; }, 1000);
                        $('.preloader').remove();
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
            $('form').append(preloader);
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
                        setTimeout(function () { window.location.href = uRL + '/admin/parents'; }, 1000);
                        $('.preloader').remove();
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

     // ========================================
    // script for Staff module
    // ========================================
    
    $('#addStaff').validate({
        rules: {
            role:{ required: true },
            f_name:{ required: true },
            email:{ required: true },
            mobile:{ required: true },
            gender:{ required: true },
        },
        messages: {
            f_name: { required: "Please Enter First Name" },
             email: { required: "Please Enter Email" },
        },
        submitHandler: function (form) {
            var formdata = new FormData(form);
            $('form').append(preloader);
            $.ajax({
                url: uRL + '/admin/staffs',
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
                        setTimeout(function () { window.location.href = uRL + '/admin/staffs'; }, 1000);
                        $('.preloader').remove();
                    }
                },
                error: function (error) {
                    show_formAjax_error(error);
                }
            });
        }
    });

    $("#updateStaff").validate({
        rules: {
            role:{ required: true },
            f_name:{ required: true },
            email:{ required: true },
            mobile:{ required: true },
            gender:{ required: true },
        },
        messages:{ 
            f_name: { required: "Please Enter First Name" },
             email: { required: "Please Enter Email Name" },
            status: { required: "Please Enter Staff Status" }, 
        },
        submitHandler: function (form) {
            var id = $('.id').val();
            var formdata = new FormData(form);
            $('form').append(preloader);
            $.ajax({
                url: uRL + '/admin/staffs/'+id,
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
                        setTimeout(function () { window.location.href = uRL + '/admin/staffs'; }, 1000);
                    }else{
                        $('.preloader').remove();
                    }
                },
                error: function (error) {
                    show_formAjax_error(error);
                }
            });
        }
    });
  
    $(document).on("click", ".delete-staff", function () {
        destroy_data($(this), 'staffs/')
    });

    // ========================================
    // script for Leave Type module
    // ========================================

    $('#addLeave').validate({
        rules: { title: { required: true }, },
        messages: { title: { required: "Please Enter Leave Name" }, },
        submitHandler: function (form) {
            var formdata = new FormData(form);
            $('form').append(preloader);
            $.ajax({
                url: uRL + '/admin/leaves',
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
                        setTimeout(function () { window.location.reload(); }, 1000);
                    }else{
                        $('.preloader').remove();
                    }
                },
                error: function (error) {
                    show_formAjax_error(error);
                }
            });
        }
    });

    $(document).on('click', '.editLeave', function () {
        var id = $(this).attr('data-id');
        var dltUrl = 'leaves/' + id + '/edit';
        $.ajax({
            url: dltUrl,
            type: "GET",
            cache: false,
            success: function (dataResult) {
                $('#modal-info input[name=id]').val(dataResult.id);
                $('#modal-info input[name=title]').val(dataResult.title);
                $('#modal-info input[name=status]').val(dataResult.status);
                $("#modal-info select[name=status] option").each(function () {
                    if ($(this).val() == dataResult.status) {
                        $(this).attr('selected', true);
                    }
                });
                $('#modal-info .u-url').val($('#modal-info .u-url').val() + '/' + dataResult.id);
                $('#modal-info').modal('show');

            }
        });
    });

    $("#editLeave").validate({
        rules: {
            title: { required: true },
            status: { required: true }
        },
        messages: {
            title: { required: "Please Enter Leave Type Name" },
            status: { required: "Please Enter Status" }
        },

        submitHandler: function (form) {
            var id = $('#modal-info input[name=id]').val();
            var formdata = new FormData(form);
            $('form').append(preloader);
            $.ajax({
                url: uRL + '/admin/leaves/' + id,
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
                    }else{
                        $('.preloader').remove();
                    }
                },
                error: function (error) {
                    show_formAjax_error(error);
                }
            });
        }
    });

    $(document).on("click", ".delete-leave", function () {
        destroy_data($(this), 'leaves/')
    });

     // ========================================
    // script for Leave Define module
    // ========================================
    
    $('#addDefine').validate({
        rules: {
            role:{ required: true },
            leave:{ required: true },
            day:{ required: true },
        },
        messages: {
              role: { required: "Please Enter Role Name" },
             leave: { required: "Please Enter Leave Type Name" },
               day: { required: "Please Enter Leave Define days" },
        },
        submitHandler: function (form) {
            var formdata = new FormData(form);
            $('form').append(preloader);
            $.ajax({
                url: uRL + '/admin/l-define',
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
                        setTimeout(function () { window.location.href = uRL + '/admin/l-define'; }, 1000);
                        $('.preloader').remove();
                    }
                },
                error: function (error) {
                    show_formAjax_error(error);
                }
            });
        }
    });

    $("#editDefine").validate({
        rules: {
            role:{ required: true },
            leave:{ required: true },
            day:{ required: true },
            status: { required: true },
        },
        messages:{ 
            role: { required: "Please Enter Role Name" },
           leave: { required: "Please Enter Leave Type Name" },
             day: { required: "Please Enter Leave Define days" },
          status: { required: "Please Enter Leave Define Status" }, 
        },
        submitHandler: function (form) {
            var id = $('.url').val();
            var formdata = new FormData(form);
            $('form').append(preloader);
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
                        setTimeout(function () { window.location.href = uRL + '/admin/l-define'; }, 1000);
                    }else{
                        $('.preloader').remove();
                    }
                },
                error: function (error) {
                    show_formAjax_error(error);
                }
            });
        }
    });
  
    $(document).on("click", ".delete-LeaveDefine", function () {
        destroy_data($(this), 'l-define/')
    });


    // ========================================
    // script for Notice Board module
    // ========================================
    
    $('#addNotice').validate({
        rules: {
            title:{ required: true },
            notice:{ required: true },
            date:{ required: true },
            message_to:{ required: true },
        },
        messages: { 
            title: { required: "Title is Required." }, 
            notice: { required: "Notice is Required" }, 
            date: { required: "Date is Required" }, 
            message_to: { required: "Select Users" }, 
        },
     submitHandler: function (form) {
        var formdata = new FormData(form);
        $('form').append(preloader);
         $.ajax({
             url: uRL + '/admin/notice-list',
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
                        setTimeout(function () {
                            window.location.href = uRL + '/admin/notice-list'; 
                            $('.preloader').remove();
                        }, 1000)
                 }
             },
             error: function (error) {
                 show_formAjax_error(error);
             }
         });
     }
 });

 $("#editNotice").validate({
    rules: {
        title:{ required: true },
        notice:{ required: true },
        date:{ required: true },
        message_to:{ required: true },
    },
    messages: { 
        title: { required: "Title is Required." }, 
        notice: { required: "Notice is Required" }, 
        date: { required: "Date is Required" }, 
        message_to: { required: "Select Users" }, 
    },
     submitHandler: function (form) {
        var id = $('.id').val();
        var formdata = new FormData(form);
        $('form').append(preloader);
        $.ajax({
             url: uRL + '/admin/notice-list/'+id,
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
                        setTimeout(function () {
                            window.location.href = uRL + '/admin/notice-list';
                            $('.preloader').remove();
                        }, 1000);
                }
             },
             error: function (error) {
                 show_formAjax_error(error);
             }
         });
     }
 });

 $(document).on("click", ".delete-notice", function () {
     destroy_data($(this), 'notice-list/')
 });



 // ========================================
    // script for Notice Board module
    // ========================================
    
    $('#addHoliday').validate({
        rules: {
            title:{ required: true },
            details:{ required: true },
            from_date:{ required: true },
            to_date:{ required: true },
        },
        messages: { 
            title: { required: "Title is Required." }, 
            notice: { required: "Details is Required" }, 
            from_date: { required: "From Date is Required" }, 
            to_date: { required: "To Date is Required" }, 
        },
        submitHandler: function (form) {
            var formdata = new FormData(form);
            $('form').append(preloader);
            $.ajax({
                url: uRL + '/admin/holiday',
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
                            setTimeout(function () {
                                window.location.href = uRL + '/admin/holiday'; 
                                $('.preloader').remove();
                            }, 1000)
                    }
                },
                error: function (error) {
                    show_formAjax_error(error);
                }
            });
        }
    });

    $("#editHoliday").validate({
        rules: {
            title:{ required: true },
            details:{ required: true },
            from_date:{ required: true },
            to_date:{ required: true },
        },
        messages: { 
            title: { required: "Title is Required." }, 
            details: { required: "Details is Required" }, 
            from_date: { required: "From Date is Required" }, 
            to_date: { required: "To Date is Required" }, 
        },
        submitHandler: function (form) {
            var id = $('.id').val();
            var formdata = new FormData(form);
            $('form').append(preloader);
            $.ajax({
                url: uRL + '/admin/holiday/'+id,
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
                        setTimeout(function () { 
                            $('.preloader').remove();
                            window.location.href = uRL + '/admin/holiday';
                        }, 1000);
                    }
                },
                error: function (error) {
                    show_formAjax_error(error);
                }
            });
        }
    });

    $(document).on("click", ".delete-holiday", function () {
        destroy_data($(this), 'holiday/')
    });

    // ========================================
    // script for Fees Group module
    // ========================================

    $('#addFeesGroup').validate({
        rules: { title: { required: true }, },
        messages: { title: { required: "Please Enter Title" }, },
        submitHandler: function (form) {
            var formdata = new FormData(form);
            $.ajax({
                url: uRL + '/admin/fees-group',
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
                        setTimeout(function () {
                            $('.preloader').remove();
                            window.location.reload(); 
                        }, 1000);
                    }
                },
                error: function (error) {
                    show_formAjax_error(error);
                }
            });
        }
    });

    $(document).on('click', '.editFeesGroup', function () {
        var id = $(this).attr('data-id');
        var dltUrl = 'fees-group/' + id + '/edit';
        $.ajax({
            url: dltUrl,
            type: "GET",
            cache: false,
            success: function (dataResult) {
                console.log(dataResult);
                $('#modal-info input[name=id]').val(dataResult.id);
                $('#modal-info input[name=title]').val(dataResult.title);
                $('#modal-info textarea[name=descr]').val(dataResult.descr);
                $('#modal-info .u-url').val($('#modal-info .u-url').val() + '/' + dataResult.id);
                $('#modal-info').modal('show');

            }
        });
    });

    $("#updateFeesGroup").validate({
           rules: { title: { required: true }, },
        messages: { title: { required: "Please Enter Title" }, },

        submitHandler: function (form) {
            var id = $('#modal-info input[name=id]').val();
            var formdata = new FormData(form);
            $('form').append(preloader);
            $.ajax({
                url: uRL + '/admin/fees-group/' + id,
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
                        setTimeout(function () { 
                            $('.preloader').remove();
                            window.location.reload(); 
                        }, 1000);
                    }
                },
                error: function (error) {
                    show_formAjax_error(error);
                }
            });
        }
    });

    $(document).on("click", ".delete-fees-group", function () {
        destroy_data($(this), 'fees-group/')
    });

    // ========================================
    // script for Fees Type module
    // ========================================

    $('#addFeesType').validate({
        rules: {
            title: { required: true },
            group: { required: true },
        },
        messages: {
            title: { required: "Please Enter Title" },
            group: { required: "Please Select Group" },
        },
        submitHandler: function (form) {
            var formdata = new FormData(form);
            $('form').append(preloader);
            $.ajax({
                url: uRL + '/admin/fees-type',
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function (dataResult) {
                    console.log(dataResult);
                    if (dataResult == '1') {
                        $('#modal-default').modal('hide');
                        Toast.fire({
                            icon: 'success',
                            title: 'Added Succesfully.'
                        });
                        setTimeout(function () { 
                            $('.preloader').remove();
                            window.location.reload(); }, 
                        1000);
                    }
                },
                error: function (error) {
                    show_formAjax_error(error);
                }
            });
        }
    });

    $(document).on('click', '.editFeesType', function () {
        var id = $(this).attr('data-id');
        var dltUrl = 'fees-type/' + id + '/edit';
        $.ajax({
            url: dltUrl,
            type: "GET",
            cache: false,
            success: function (dataResult) {
                $('#modal-info input[name=id]').val(dataResult.id);
                $('#modal-info input[name=title]').val(dataResult.title);
                $("#modal-info select[name=group] option").each(function () {
                    if ($(this).val() == dataResult.group) {
                        $(this).attr('selected', true);
                    }
                });
                $('#modal-info textarea[name=descr]').val(dataResult.descr);
                $('#modal-info .u-url').val($('#modal-info .u-url').val() + '/' + dataResult.id);
                $('#modal-info').modal('show');

            }
        });
    });

    $("#updateFeesType").validate({
        rules: {
            title: { required: true },
            group: { required: true },
        },
        messages: {
            title: { required: "Please Enter Title" },
            group: { required: "Please Select Group" },
        },
        submitHandler: function (form) {
            var formdata = new FormData(form);
            var id = $('#modal-info input[name=id]').val();
            $.ajax({
                url: uRL + '/admin/fees-type/' + id,
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

    $(document).on("click", ".delete-fees-type", function () {
        destroy_data($(this), 'fees-type/')
    });

    // ========================================
    // script for Show Fees type row in fees invoice create page module
    // ========================================
    // reset student select box on change
    $('.class-select').change(function(){
        $('.student-select').html('<option value="" selected disabled>First Select Section</option>');
    });

    // get section students
    $('.section-select').change(function(){
        var section = $(this).val();
        var cls = $('.class-select option:selected').val();
        $.ajax({
            type: "POST",
            url: uRL + '/admin/get-section-students',
            data: {cls:cls,section:section},
            success: function (response) {
            $('.student-select').html(response);
                
            }
        });
    });

    $('.invoice-fees-type').change(function(){
        var id = $(this).val();
        $.ajax({
            type: "POST",
            url: uRL + '/admin/show-fees-type-markup',
            data: {id:id},
            success: function (response) {
            //   console.log(responce);.
            $('.types-box').html(response);
                
            }
        });
    });


    // ========================================
    // script for Fees Invoice module
    // ========================================

    $('#addFeesInvoice').validate({
        rules: {
            class: { required: true },
            section: { required: true },
            student: { required: true },
            type: { required: true },
            due_date: { required: true },
            status: { required: true },
            pay_method: {
                required: function() {
                  return $('.invoice-status').val() == '1';
                }
              }
        },
        submitHandler: function (form) {
            var formdata = new FormData(form);
            $('form').append(preloader);
            $.ajax({
                url: uRL + '/admin/fees-invoice-list',
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
                        setTimeout(function () { 
                            $('.preloader').remove();
                            window.location.href = uRL+'/admin/fees-invoice-list';
                        }, 1000);
                    }
                },
                error: function (error) {
                    show_formAjax_error(error);
                }
            });
        }
    });

    

    $("#updateFeesInvoice").validate({
        rules: {
            due_date: { required: true },
            status: { required: true },
            pay_method: {
                required: function() {
                  return $('.invoice-status').val() == '1';
                }
              }
        },
        submitHandler: function (form) {
            var id = $('.id').val();
            var formdata = new FormData(form);
            $('form').append(preloader);
            $.ajax({
                url: uRL + '/admin/fees-invoice-list/' + id,
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
                        setTimeout(function () { 
                            window.location.href = uRL+'/admin/fees-invoice-list';
                            $('.preloader').remove(); 
                        }, 1000);
                    }
                },
                error: function (error) {
                    show_formAjax_error(error);
                }
            });
        }
    });

    $(document).on("click", ".delete-fees-type", function () {
        destroy_data($(this), 'fees-type/')
    });


    // ========================================
    // script for Staff Attandance Show Table module
    // ========================================

    $(".staff-attandance").click(function() {
        var role = $('.att-role option:selected').val();
        var date = $('.att-date').val();
        $.ajax({
            type: "POST",
            url: uRL + '/admin/staff-attendance/create',
            data: {role: role, date: date},
            success: function (responce) {
                $(".attendance-table").css("display", "block");
                $("tbody").html(responce);
            }
        });
    });
    
    // ========================================
    // script for Add Staff Attandance module
    // ========================================
    
    $("#add-attendance").submit(function(e) {
        e.preventDefault();
        var formdata = new FormData(this);
        $.ajax({
            url: uRL + '/admin/staff-attendance/store',
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
                    setTimeout(function () { window.location.href = uRL + '/admin/staff-attendance'; }, 1000)
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
        var  val = $(this).attr('data-value');
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

    // ========================================================
    // script for Show Days Staff Attandance Show Table module
    // =========================================================

    $(".attandance-report").click(function() {
        var role = $('.att-role option:selected').val();
        var month = $('.att-month').val();
        $.ajax({
            type: "GET",
            url: uRL + '/admin/staff-attendance-report',
            data: {role: role, month: month},
            success: function (dataResult) {
               // console.log(dataResult);
                $(".att-table").html(dataResult);
            }
        });
    });

    // ========================================
    // script for Admin  module
    // ========================================

    $('#updateProfileSetting').validate({
        rules: {
            admin_name: { required: true },
            email: { required: true },
            username: { required: true },
            phone: { required: true },
        },
        submitHandler: function (form) {
            var formdata = new FormData(form);
            $.ajax({
                url: uRL + '/admin/profile-settings',
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function (dataResult) {
                    if (dataResult == '1') {
                        Toast.fire({
                            icon: 'success',
                            title: 'Updated Succesfully.',
                        });
                        setTimeout(function () { window.location.href = uRL + '/admin/profile-settings'; }, 1000);
                    }else if(dataResult == '0'){
                        Toast.fire({
                            icon: 'info',
                            title: 'Already Updated',
                        });
                        setTimeout(function () { window.location.href = uRL + '/admin/profile-settings'; }, 1000);
                    }
                },
                error: function (error) {
                    show_formAjax_error(error);
                }
            });
        }
    });

    $('#updatePassword').validate({ 
        rules: {
            password: { required: true },
            new: { required: true },
            new_confirm: { equalTo:'#password' },
        },
        submitHandler: function (form) {
            var formdata = new FormData(form);
            $.ajax({
                url: uRL + '/admin/change-password',
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function (dataResult) {
                    console.log(dataResult);
                    if (dataResult == '1') {
                        Toast.fire({
                            icon: 'success',
                            title: 'Updated Succesfully.',
                        });
                        setTimeout(function () { window.location.href = uRL + '/admin/profile-settings'; }, 1000);
                    }else if(dataResult == '0'){
                        Toast.fire({
                            icon: 'info',
                            title: 'Already Updated',
                        });
                    }else{
                        Toast.fire({
                            icon: 'warning',
                            title: dataResult,
                        });
                    }
                },
                error: function (error) {
                    show_formAjax_error(error);
                }
            });
        }
    });

     // ========================================
    // script for Student Report Table module
    // ========================================

    $(".stdClass-report").click(function() {
        var stdclass = $('.std-class option:selected').val();
        var section = $('.class-section').val();
        $.ajax({
            type: "POST",
            url: uRL + '/admin/class-report',
            data: {stdclass:stdclass,section:section},
            success: function (responce) {
                  console.log(responce);
                   $(".classReport-table").css("display", "block");
                   $(".std-count").html(responce);
               }
        });
    });

    // ========================================
    // script for Guardian Report Table module
    // ========================================

    $(document).on('click', '.editGuaridanReport', function () {
        var id = $(this).attr('data-id');
        var dltUrl = 'guardian-report/' + id;
        $.ajax({
            url: dltUrl,
            type: "GET",
            cache: false,
            success: function (dataResult) {
                $('#modal-info').modal('show');
                $('#modal-info .modal-body').html(dataResult);
            }
        });
    });

    $('#createPayroll').validate({ 
        // rules: {
        //     password: { required: true },
        //     new: { required: true },
        //     new_confirm: { equalTo:'#password' },
        // },
        submitHandler: function (form) {
            var formdata = new FormData(form);
            $('form').append(preloader);
            $.ajax({
                url: uRL + '/admin/staff-payroll',
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function (dataResult) {
                    console.log(dataResult);
                    if (dataResult == '1') {
                        Toast.fire({
                            icon: 'success',
                            title: 'Generated Succesfully.',
                        });
                        setTimeout(function () { 
                            window.location.href = uRL + '/admin/staff-payroll'; 
                            $('.preloader').remove();
                        }, 1000);
                    }
                },
                error: function (error) {
                    show_formAjax_error(error);
                }
            });
        }
    });


    $('#updatePayroll').validate({ 
        // rules: {
        //     password: { required: true },
        //     new: { required: true },
        //     new_confirm: { equalTo:'#password' },
        // },
        submitHandler: function (form) {
            var id = $('.id').val();
            var formdata = new FormData(form);
            $('form').append(preloader);
            $.ajax({
                url: uRL + '/admin/staff-payroll/'+id,
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function (dataResult) {
                    if (dataResult == '1') {
                        Toast.fire({
                            icon: 'success',
                            title: 'Updated Succesfully.',
                        });
                        setTimeout(function () { 
                            window.location.href = uRL + '/admin/staff-payroll'; 
                            $('.preloader').remove();
                        }, 1000);
                    }
                },
                error: function (error) {
                    show_formAjax_error(error);
                }
            });
        }
    });

    $('#payPayrollAmount').validate({ 
        rules: {
            pay_method: { required: true },
            payment_date: { required: true },
        },
        submitHandler: function (form) {
            var formdata = new FormData(form);
            var id = $('.id').val();
            $.ajax({
                url: uRL + '/admin/staff-payroll/pay/'+id,
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function (dataResult) {
                    console.log(dataResult);
                    if (dataResult == '1') {
                        Toast.fire({
                            icon: 'success',
                            title: 'Updated Succesfully.',
                        });
                        setTimeout(function () { window.location.href = uRL + '/admin/staff-payroll'; }, 1000);
                    }
                },
                error: function (error) {
                    show_formAjax_error(error);
                }
            });
        }
    });


    $('#showRecordPermission').validate({ 
        rules: {
            role: { required: true },
        },
        submitHandler: function (form) {
            var formdata = new FormData(form);
            $.ajax({
                url: uRL + '/admin/login-permission',
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function (dataResult) {
                    // console.log(dataResult);
                    $('.result-card').html(dataResult);
                },
                error: function (error) {
                    show_formAjax_error(error);
                }
            });
        }
    });

    $(document).on('click','.set-all-permission',function(){
        var role = $(this).attr('data-role');
        var st = $(this).attr('data-status');
        $('.result-card').append(preloader);
        $.ajax({
            url: uRL + '/admin/set-staff-login-permission',
            type: 'POST',
            data: {role:role,status:st},
            success: function (dataResult) {
                $('.preloader').remove();
                if (dataResult == '1') {
                    Toast.fire({
                        icon: 'success',
                        title: 'Updated Succesfully.',
                    });

                    setTimeout(function () { window.location.reload(); }, 1000);
                }
            },
            error: function (error) {
                show_formAjax_error(error);
            }
        });
    });

    $(document).on('click','.reset-allStaff-password',function(){
        var role = $(this).attr('data-role');
        $('.result-card').append(preloader);
        $.ajax({
            url: uRL + '/admin/reset-all-staff-password',
            type: 'POST',
            data: {role:role},
            success: function (dataResult) {
                $('.preloader').remove();
                if (dataResult == '1') {
                    
                    Toast.fire({
                        icon: 'success',
                        title: 'All Password Reset to 123456.',
                    });
                }
            },
            error: function (error) {
                show_formAjax_error(error);
            }
        });
    });


    $(document).on('click','.reset-login-password',function(){
        var id = $(this).attr('data-id');
        var type = $(this).attr('data-type');
        $('.result-card').append(preloader);
        $.ajax({
            url: uRL + '/admin/reset-login-password',
            type: 'POST',
            data: {id:id,type:type},
            success: function (dataResult) {
                $('.preloader').remove();
                if (dataResult == '1') {
                    Toast.fire({
                        icon: 'success',
                        title: 'Password Reset to 123456.',
                    });
                }
            },
            error: function (error) {
                show_formAjax_error(error);
            }
        });
    });


    $(document).on('click','.save-login-password',function(){
        if($(this).siblings('input[name=password]').val() == ''){
            Toast.fire({
                icon: 'warning',
                title: 'Enter Password.',
                timer: 1000
            });
            $(this).siblings('input[name=password]').focus();
        }else{
            var id = $(this).attr('data-id');
            var type = $(this).attr('data-type');
            var pass = $(this).val();
            $('.result-card').append(preloader);
            $.ajax({
                url: uRL + '/admin/set-login-password',
                type: 'POST',
                data: {id:id,pass:pass,type:type},
                success: function (dataResult) {

                    $('.preloader').remove();
                    if (dataResult == '1') {
                        Toast.fire({
                            icon: 'success',
                            title: 'Saved Successfully.',
                        });
                        $('input[name=password]').val('');
                    }
                },
                error: function (error) {
                    show_formAjax_error(error);
                }
            }); 
        }
    });


    $(document).on('click','.setAll_studentsLoginPermssion',function(){
        var cls = $(this).attr('data-class');
        var section = $(this).attr('data-section');
        var status = $(this).attr('data-status');
        $('.result-card').append(preloader);
        $.ajax({
            url: uRL + '/admin/set-all-students-login-permission',
            type: 'POST',
            data: {class:cls,section:section,status:status},
            success: function (dataResult) {
                $('.preloader').remove();
                if (dataResult == '1') {
                    Toast.fire({
                        icon: 'success',
                        title: 'Updated Succesfully.',
                    });

                    setTimeout(function () { window.location.reload(); }, 1000);
                }
            },
            error: function (error) {
                show_formAjax_error(error);
            }
        });
    });

    $(document).on('click','.resetAll_studentsPassword',function(){
        var cls = $(this).attr('data-class');
        var section = $(this).attr('data-section');
        $('.result-card').append(preloader);
        $.ajax({
            url: uRL + '/admin/reset-all-students-password',
            type: 'POST',
            data: {class:cls,section:section},
            success: function (dataResult) {
                $('.preloader').remove();
                if (dataResult == '1') {
                    Toast.fire({
                        icon: 'success',
                        title: 'Updated Succesfully.',
                    });

                    setTimeout(function () { window.location.reload(); }, 1000);
                }
            },
            error: function (error) {
                show_formAjax_error(error);
            }
        });
    });

    $(document).on('click','.resetAll_parentsPassword',function(){
        var cls = $(this).attr('data-class');
        var section = $(this).attr('data-section');
        $('.result-card').append(preloader);
        $.ajax({
            url: uRL + '/admin/reset-all-parents-password',
            type: 'POST',
            data: {class:cls,section:section},
            success: function (dataResult) {
                $('.preloader').remove();
                if (dataResult == '1') {
                    Toast.fire({
                        icon: 'success',
                        title: 'Updated Succesfully.',
                    });

                    setTimeout(function () { window.location.reload(); }, 1000);
                }
            },
            error: function (error) {
                show_formAjax_error(error);
            }
        });
    });

    $(document).on('click','.setAll_parentsLoginPermssion',function(){
        var cls = $(this).attr('data-class');
        var section = $(this).attr('data-section');
        var status = $(this).attr('data-status');
        $('.result-card').append(preloader);
        $.ajax({
            url: uRL + '/admin/set-all-parents-login-permission',
            type: 'POST',
            data: {class:cls,section:section,status:status},
            success: function (dataResult) {
                $('.preloader').remove();
                if (dataResult == '1') {
                    Toast.fire({
                        icon: 'success',
                        title: 'Updated Succesfully.',
                    });

                    setTimeout(function () { window.location.reload(); }, 1000);
                }
            },
            error: function (error) {
                show_formAjax_error(error);
            }
        });
    });

    $(document).on('click','.permission-checkbox',function(){
        var id = $(this).attr('data-id');
        var status = '0';
        if($(this).prop('checked') == true){
            status = '1';
        }
        var type = $(this).attr('data-type');
        $('.result-card').append(preloader);
        $.ajax({
            url: uRL + '/admin/reset-login-permission',
            type: 'POST',
            data: {id:id,status:status,type:type},
            success: function (dataResult) {
                $('.preloader').remove();
                if (dataResult == '1') {
                    Toast.fire({
                        icon: 'success',
                        title: 'Updated Succesfully.',
                    });
                }
            },
            error: function (error) {
                show_formAjax_error(error);
            }
        });
    });

    $('#showPromotionTable').validate({ 
        rules: {
            from_year: { required: true },
            to_year: { required: true },
            class: { required: true },
            section: { required: true },
        },
        submitHandler: function (form) {
            var formdata = new FormData(form);
            $.ajax({
                url: uRL + '/admin/student-promote',
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function (dataResult) {
                    // console.log(dataResult);
                    $('.promote-box').html(dataResult);
                },
                error: function (error) {
                    show_formAjax_error(error);
                }
            });
        }
    });

    $(document).on('click','.submit-promote-form',function(){
        if($('.promote-checkbox:checkbox:checked').length == 0){
            Toast.fire({
                icon: 'warning',
                title: 'Please Check the Checkboxes.',
            });
        }else{
            var from_year = $('input[name=from_year]').val();
            var to_year = $('input[name=to_year]').val();
            var from_class = $('input[name=from_class]').val();
            var from_section = $('input[name=from_section]').val();
            var students = [];
            var type = [];
            var promote_class = [];
            var promote_section = [];
            var roll_no = [];
            $('.promote-checkbox:checkbox:checked').each(function(i){
                students.push($(this).attr('data-id'));
                var typ = $(this).parent('td').siblings().children('select[name=type] option:selected').val();
                var cls = $(this).parent('td').siblings().children('.promote-class').val();
                var sec = $(this).parent('td').siblings().children('.promote-section').val();
                var rollno = $(this).parent('td').siblings().children('input[name=roll_no]').val();
                type.push(typ);
                promote_class.push(cls);
                promote_section.push(sec);
                roll_no.push(rollno);
            });
            $.ajax({
                url: uRL + '/admin/save-student-promote',
                type: 'POST',
                data: {from_class:from_class,from_section:from_section,from_year:from_year,to_year:to_year,students:students,promote_class:promote_class,promote_section:promote_section,roll_no:roll_no},
                success: function (dataResult) {
                    Toast.fire({
                        icon: 'success',
                        title: 'Promoted Succesfully.',
                    });
                    setTimeout(function () { window.location.reload(); }, 1000);
                },
                error: function (error) {
                    show_formAjax_error(error);
                }
            });
           
        }
    });
    
});
    
