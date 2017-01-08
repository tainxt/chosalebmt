/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function () {

    var navListItems = $('div.setup-panel div a'),
            allWells = $('.setup-content'),
            allNextBtn = $('.nextBtn');

    allWells.hide();


    navListItems.click(function (e) {
        e.preventDefault();
        var $target = $($(this).attr('href')),
                $item = $(this);

        if (!$item.hasClass('disabled')) {
            navListItems.removeClass('btn-primary').addClass('btn-default');
            $item.addClass('btn-primary');
            allWells.hide();
            $target.show();
            $target.find('input:eq(0)').focus();
        }

    });


    allNextBtn.click(function () {
        var curStep = $(this).closest(".setup-content"),
                curStepBtn = curStep.attr("id"),
                nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
                curInputs = curStep.find("input[type='text'],input[type='number']"),
                isValid = true;
        $(".form-group").removeClass("has-error");
        for (var i = 0; i < curInputs.length; i++) {
            if (!curInputs[i].validity.valid) {
                isValid = false;
                $(curInputs[i]).closest(".form-group").addClass("has-error");
            }
        }

        if (isValid)
            nextStepWizard.removeAttr('disabled').trigger('click');

    });

    $('.stepwizard-step a').click(function () {
        var x = $(this).attr('data-step');


        if (x === "2") {
            $('#step-1 .input-null').remove();
            curStep = $('#step-1');
            curInputs = curStep.find("input[type='text'],input[type='number']");
            isValid = true;
            for (var i = 0; i < curInputs.length; i++) {
                if (!curInputs[i].validity.valid) {
                    isValid = false;
                    $(curInputs[i]).closest(".form-group").addClass("has-error");
                    $(curInputs[i]).closest(".form-group").append("<span class='input-error input-null'>Vui lòng điền vào ô này</span>");
                }
            }

            if ($('.select2').val() === null) {
                isValid = false;
            }

            if (parseInt($('.txt-qty').val()) < 1) {
                $('.qty-error').html("Số lượng phải lớn hơn 1");
                $('.input-product-qty').addClass('has-error');
                isValid = false;
            }

            if (isValid === false) {
                $('.step-1').trigger('click');
            }

        } else if (x === "3") {

            //if (x === "3") {
            $('.error-upload-img').remove();
            curStep = $('.preview-upload-img');
            var g = $('.preview-upload-img > .thumbnail').length;
            isValid = true;


            if (g == 0) {
                var img_zone = document.getElementById('img-zone')
                isValid = false;
                $('.step-2').trigger('click');
                var the_msg = '<div class="error-upload-img alert alert-danger">';
                the_msg += '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
                the_msg += 'Hãy chọn hình ảnh cho sản phẩm của bạn!';
                the_msg += '</div>';
                $(the_msg).insertBefore(img_zone);
            }


        }

    });

    $('div.setup-panel div a.btn-primary').trigger('click');


    $('.status-product').change(function () {
        var x = $(this).val();
        if (x === "1") {
            $('.percent-status input').val("");

            $('.box-status').removeClass('col-sm-12')
                    .addClass('col-sm-6');
            setTimeout(function () {
                $('.percent-status').slideDown('fast');
            }, 500);

        } else {
            $('.percent-status').slideUp('fast');

            setTimeout(function () {
                $('.box-status').removeClass('col-sm-6')
                        .addClass('col-sm-12');
                $('.percent-status input').val("100");
            }, 500);

        }
    });

    $('.percent-status').hide();

    $('.discount-product').change(function () {
        var x = $(this).val();
        if (x === "1") {

            $('.percent-discount input').val("");

            $('.box-discount').removeClass('col-sm-12')
                    .addClass('col-sm-6');
            setTimeout(function () {
                $('.percent-discount').slideToggle('500');
            }, 150);
        } else {
            $('.percent-discount').slideUp('fast');
            setTimeout(function () {
                $('.percent-discount input').val("0");
                $('.box-discount').removeClass('col-sm-6')
                        .addClass('col-sm-12');
            }, 500);

        }
    });

    $('.percent-discount').hide();

    $(".input-product-name input").change(function () {
        var str = $(this).val();
        if (str.length > 0) {
            $('.input-product-name').removeClass('has-error');
            str = str.toLowerCase();
            str = str.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g, "a");
            str = str.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g, "e");
            str = str.replace(/ì|í|ị|ỉ|ĩ/g, "i");
            str = str.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g, "o");
            str = str.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g, "u");
            str = str.replace(/ỳ|ý|ỵ|ỷ|ỹ/g, "y");
            str = str.replace(/đ/g, "d");
            str = str.replace(/!|@|\$|%|\^|\*|\(|\)|\+|\=|\<|\>|\?|\/|,|\.|\:|\'| |\"|\&|\#|\[|\]|~/g, "-");
            str = str.replace(/-+-/g, "-"); //thay thế 2- thành 1-
            str = str.replace(/^\-+|\-+$/g, "");//cắt bỏ ký tự - ở đầu và cuối chuỗi
            $('.slug').val(str);
        }
    });

    $(".input-product-qty input").change(function () {
        var str = $(this).val();
        if (str.length > 0) {
            $('.input-product-qty').removeClass('has-error');
        }
    });

    $(".input-product-keyword input").change(function () {
        var str = $(this).val();
        if (str.length > 0) {
            $('.input-product-keyword').removeClass('has-error');
        }
    });

    $(".input-product-tag input").change(function () {
        var str = $(this).val();
        if (str.length > 0) {
            $('.input-product-tag').removeClass('has-error');
        }
    });

    $(document).on('click', '.delete-upload-img', function () {
        var file_name = $(this).attr('del_file_name');
        var box_parent = $(this).closest('.preview-upload-img');
        $.ajax({
            url: base_url + "upload/delete_image",
            type: 'post',
            data: 'del_file_name=' + file_name,
            success: function (res) {
                if (res) {
                    $(box_parent).fadeOut('fast');
                    setTimeout(function () {
                        $(box_parent).remove();
                    }, 1000);
                } else {
                    alert("Không có dữ liệu trả về!");
                }
            },
            error: function () {
                alert('Có lỗi trong lúc thực hiện!');
            }

        });
        return false;
    });

    /* Lấy địa chỉ */
    $('#cur-address').click(function () {
        $('.ct-name').attr('disabled', 'disabled');
        $('.ct-phone').attr('disabled', 'disabled');
        $('.ct-address').attr('disabled', 'disabled');
        $.ajax({
            url: base_url + "Dangtin/get_cur_address",
            dataType: 'json',
            success: function (res) {
                if (res) {
                    $('.ct-name').val(res.u_fullname);
                    $('.ct-phone').val(res.ud_phone);
                    $('.ct-address').val(res.ud_address);
                    console.log(res);
                } else {
                    alert("Không có dữ liệu trả về!");
                }
            },
            error: function () {
                alert('Có lỗi trong lúc thực hiện!');
            }
        });
    });

    $('#new-address').click(function () {
        var info_input = $('#step-3').find("input[type='text'],input[type='number']");
        for (i = 0; i < info_input.length; i++) {
            $(info_input[i]).removeAttr('disabled');
        }
        $('.ct-address').removeAttr('disabled');
    });

    $('.btn-upload-form').click(function () {
        var editor = CKEDITOR.instances['product_description'].getData();
        $('#product_description').val(editor);
        var data = $('#add-product-form').serialize();
        $.ajax({
            url: base_url + "Dangtin/ProcessAdd",
            type: 'post',
            data: data,
            success: function (res) {
                if (res === "true") {
                    $('.add-success').trigger("click");
                } else {
                    alert("Vui lòng nhập đầy đủ thông tin");
                }
            },
            error: function () {
                alert("Có lỗi");
            }
        });
    });

    $('.add-success').click(function () {
        var url = base_url + "Dangtin/success";
        $.confirm({
            title: 'Thêm sản phẩm thành công!',
            titleIcon: 'glyphicon glyphicon-ok',
            template: 'success',
            templateOk: 'success',
            message: 'Bạn có muốn xem trước sản phẩm của mình vừa đăng tải không?',
            labelCancel: 'Thôi! Về trang chủ',
            onOk: function () {
                window.location.replace(url);
            },
            onCancel: function () {
                window.location.replace(base_url);
            }
        });
    });

    $(document).on('click', '.update-info-img-btn', function () {
        var box_parent = $(this).closest('.image-info-update'),
                name_img = $(box_parent).find('.delete-upload-img').attr('del_file_name');
        alt_img = $(box_parent).find('.alt-img').val(),
                title_img = $(box_parent).find('.title-img').val();

        $.ajax({
            url: base_url + "Upload/add_info_img",
            data: "name=" + name_img + "&alt=" + alt_img + "&title=" + title_img,
            type: 'post',
            success: function (res) {
                if (res) {
                    alert(res);
                } else {
                    alert("Không cập nhật đc");
                }
            },
            error: function () {
                alert("Có lỗi trong lúc thực hiện");
            }
        });
    });


});


