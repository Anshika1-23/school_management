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
    // script for Apply Leave module
    // ========================================

    $('#add_parentLeave').validate({
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
            reason: { required: "Please Enter Reason" } 
        },
        submitHandler: function (form) {
            var url = $('.url').val();
            var formdata = new FormData(form);
            $.ajax({
                url: url,
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
                        setTimeout(function () { window.location.reload(); }, 1000)
                    }
                },
                error: function (error) {
                    show_formAjax_error(error);
                }
            });
        }
    });

    $(document).on("click", ".view_parentLeave", function () {
        var id = $(this).attr('data-id');
        var url = $(this).attr('data-url');
        $.ajax({
            url: url+'/'+ id,
            type: "GET",
            cache: false,
            success: function (dataResult) {
                console.log(dataResult);
                $('#view_parentLeave #apply_date').html(dataResult[0].apply_date);
                $('#view_parentLeave #leave_from').html(dataResult[0].leave_from);
                $('#view_parentLeave #leave_to').html(dataResult[0].leave_to);
                $('#view_parentLeave #leave_type').html(dataResult[0].leave_title.title);
                $('#view_parentLeave #reason').html(dataResult[0].reason);
                var approve_status = dataResult[0].approve_status;
                if(approve_status == '0') {
                    $('#view_parentLeave #status').html('<label class="badge bg-light-warning">Pending</label>');
                }else if (approve_status == '1') {
                    $('#view_parentLeave #status').html('<label class="badge bg-light-success">Approve</label>');
                }else {
                    $('#view_parentLeave #status').html('<label class="badge bg-light-danger">Reject</label>');
                }
                $('#view_parentLeave').modal('show');
            },
            error: function (error) {
                show_formAjax_error(error);
            }
        });
    });

    $('#show-child-attendance').validate({
        rules: { 
            month: { required: true},
            year: { required: true },
        },
        submitHandler: function (form) {
            var formdata = new FormData(form);
            var id = $('.id').val();
            $.ajax({
                url: uRL+'/parent/child-attendance/'+id,
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function (dataResult) {
                    $('.attendance-box').html(dataResult);
                },
                error: function (error) {
                    show_formAjax_error(error);
                }
            });
        }
    });

     
});