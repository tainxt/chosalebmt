$(document).ready(function () {
    $(document).on('submit', '.login_form', function (ev) {
        ev.preventDefault();
        var data = $(this).serialize();
        ajax_login(data);
    });

    $(document).on('submit', '.register_form', function (ev) {
        ev.preventDefault();
        var data = $(this).serialize();

        ajax_register(data);
    });

    function ajax_login(data) {
        $.ajax({
            url: base_url + "Home/ajax_login",
            type: 'POST',
            data: data,
            success: function (result) {
                if (result) {
                    $('#login_error').addClass('alert-text alert-success').html("Đăng nhập thành công!");
                    setTimeout(function () {
                        location.reload(base_url);
                    }, 1000);

                } else {
                    shakeModal();
                    $('#login_error').addClass('alert-text alert-danger').html("Tài khoản hoặc mật khẩu không đúng!");
                }
            },
            error: function () {
                shakeModal();
                $('#login_error').addClass('alert-text alert-danger').html("Có lỗi trong lúc thực hiện, xin thử lại sau!");
            }
        });
    }

    function ajax_register(data) {
        $('#register_error').removeAttr('class');
        var isValid = true;
        var form_input = $('.register_form').find('input');
        for (var i = 0; i < form_input.length; i++) {
            if ($(form_input[i]).val() === "") {
                isValid = false;
                $(form_input[i]).closest(".form-group").addClass("has-error");
            }
        }
        if (isValid) {
            $.ajax({
                url: base_url + "Home/ajax_regsiter",
                type: 'POST',
                data: data,
                success: function (result) {
                    if (result) {
                        if (result === "0") {
                            shakeModal();
                            $('#register_error').addClass('alert-text alert-danger').html("Vui lòng nhập đầy đủ thông tin!");
                        } else if (result === "1") {
                            $('#register_error').addClass('alert-text alert-success').html("Đăng ký tài khoản thành công!");
                            setTimeout(function () {
                                location.reload(base_url);
                            }, 1000);
                        } else {
                            shakeModal();
                            $('#register_error').addClass('alert-text alert-warning').html(result);
                        }
                    } else {
                        shakeModal();
                        $('#register_error').addClass('alert-text alert-danger').html("Đăng ký tài khoản thất bại!");
                    }
                },
                error: function (er) {
                    shakeModal();
                    $('#register_error').addClass('alert-text alert-danger').html("Có lỗi trong lúc thực hiện, xin thử lại sau!");
                    console.log(er);
                }
            });
        } else {
            shakeModal();
            $('#register_error').addClass('alert-text alert-danger').html("Vui lòng nhập đầy đủ thông tin!");
        }


    }

    function shakeModal() {
        $('#loginModal .modal-dialog').addClass('shake');
        $('input[type="password"]').val('');
        setTimeout(function () {
            $('#loginModal .modal-dialog').removeClass('shake');
        }, 500);
    }

    /* ###### Password Confirm ###### */
    var password = document.getElementById("password"),
            confirm_password = document.getElementById("confirm_password");
    function validatePassword() {
        if (password.value !== confirm_password.value) {
            confirm_password.setCustomValidity("Mật khẩu xác nhận không khớp");
        } else {
            confirm_password.setCustomValidity('');
        }
    }
    password.onchange = validatePassword;
    confirm_password.onkeyup = validatePassword;

    // Refesh Captcha
    $('.refesh-captcha').click(function () {
        $('.refresh-button').addClass("rotate-refresh-button");
        $.ajax({
            type: "POST",
            url: base_url + "Home/created",
            success: function (res) {
                if (res)
                {
                    setTimeout(function () {
                        $(".captcha-image").html(res);
                        $('.refresh-button').removeClass("rotate-refresh-button");
                    }, 1000);
                }
            }
        });
    });


});

