$(function () {
    var uRL = $('.std-url').val();
       
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

    const preloader = `<div class="preloader">
                            <img src="../public/assets/images/grid.svg" class="me-4" style="width: 3rem" alt="audio">
                        </div>`;

    $('#studentLogin').validate({
        rules: {
            email: { required: true },
            password: { required: true }
        },
        messages: {
               email: { required: "Email is required" },
            password: { required: "Password is required" }
        },
        submitHandler: function (form) {
            $('form').append(preloader);
            var formdata = new FormData(form);
            $.ajax({
                url: uRL,
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function (dataResult) {
                    if (dataResult == '1') {
                        Toast.fire({
                            icon: 'success',
                            title: 'Logged In Succesfully.'
                        })
                        setTimeout(function(){
                            window.location.href = uRL+'/index';
                        }, 500);
                    } else {
                        $('.preloader').remove();
                        $.each(dataResult, function (i, error) {
                            var el = $(document).find('[name="' + i + '"]').css('border-color','red');
                            Toast.fire({
                                icon: 'error',
                                title: error
                            })
                        });
                    }
                }
            });
        }
    });
});