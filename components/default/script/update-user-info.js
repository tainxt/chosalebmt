$(window).load(function () {
    $('#update-user-info').modal('show');
});
$(document).ready(function () {

    $('#BSbtndanger').filestyle({
        buttonName: 'btn-primary',
        buttonText: ' Chọn hình'
    });

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#preview-avatar').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#BSbtndanger").change(function () {
        readURL(this);
    });


    $("#txt-number").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
                // Allow: Ctrl+A, Command+A
                        (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) ||
                        // Allow: home, end, left, right, down, up
                                (e.keyCode >= 35 && e.keyCode <= 40)) {
                    // let it happen, don't do anything
                    return;
                }
                // Ensure that it is a number and stop the keypress
                if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                    e.preventDefault();
                }
            });

    $('#txt-date').datepicker({
        autoclose: true,
        format: 'dd/mm/yyyy'
    });

    $('#txt-date').datepicker('setDate', new Date(1994, 01, 01));
    $('#txt-date').datepicker('update');
    $('#txt-date').val('');

    $(document).on('submit', '#form-update-info', function (ev) {
        ev.preventDefault();
        var formData = new FormData($(this)[0]);
        update_info(formData);
    });

    function update_info(data) {

        $('#result-update').removeAttr('class');
        $.ajax({
            url: base_url + "Home/procee_update_info",
            type: 'POST',
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            success: function (result) {
                if (result) {
                    $('#result-update').addClass('alert-text alert-success').html(result);
                    setTimeout(function () {
                        $('#update-user-info').modal('toggle');
                    }, 1000);

                } else {
                    shakeModal();
                    $('#result-update').addClass('alert-text alert-danger').html("Tài khoản hoặc mật khẩu không đúng!");
                }
            },
            error: function (e) {
                shakeModal();
                $('#result-update').addClass('alert-text alert-danger').html("Có lỗi trong lúc thực hiện");
            }
        });
    }

    function shakeModal() {
        $('#form-update-info .modal-dialog').addClass('shake');
        setTimeout(function () {
            $('#form-update-info .modal-dialog').removeClass('shake');
        }, 500);
    }

});