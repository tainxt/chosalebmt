$(document).ready(function () {

    /*
     * Click vào nút thêm vào giỏ 
     */
    $(document).on("click", ".add-to-cart", function () {

        $(this).find('i').removeClass('fa-cart-plus fa-shopping-cart');
        $(this).find('i').addClass('fa-refresh rotate-refresh-button');



        var closet = $(this).closest('#form-add-to-cart');
        var id = $(closet).find('.product-name a').attr('data-id');
        var qty = $(closet).find('.select-qty .input-number').val();
        if (typeof (qty) === "undefined") {
            qty = "1";
        }

        setTimeout(function () {
            $(closet).find('.icon-cart').removeClass('fa-refresh rotate-refresh-button');
            $(closet).find('.icon-cart').addClass('fa-cart-plus');
        }, 500);

        $.ajax({
            url: base_url + "Giohang/addTocart",
            type: 'POST',
            data: 'id=' + id + "&qty=" + qty,
            beforeSend: function () {

            },
            success: function (data) {
                $('.nothing').hide();
                reload_cart();
                var json = JSON.parse(data);
                var result = json.status;
                if (result === "true") {

                    setTimeout(function () {
                        $('#my-cart-modal').modal('toggle');
                    }, 500);

                } else if (result === "false") {
                    alert_addTocart("warning", "Có lỗi trong lúc thêm sản phẩm vào giỏ");
                } else {
                    alert_addTocart("danger", result);
                }

            },
            error: function (e) {
                alert_addTocart("danger", e);
            }
        });

    });

    function number_format(nStr) {
        nStr += '';
        x = nStr.split('.');
        x1 = x[0];
        x2 = x.length > 1 ? '.' + x[1] : '';
        var rgx = /(\d+)(\d{3})/;
        while (rgx.test(x1)) {
            x1 = x1.replace(rgx, '$1' + ',' + '$2');
        }
        return x1 + x2;
    }

    $('#theAlertModal').click(function () {
        $(this).hide();
    });

    function alert_addTocart(type, message) {
        var tam = $('theAlertModal').AlertModal();
        tam.show({
            alert_class: "alert-modal-" + type,
            content: {html: message}
        });
    }

    function reload_cart() {
        $('#current_cart').html("");
        $.ajax({
            type: "POST",
            url: base_url + "Giohang/reload_cart",
            success: function (res) {
                if (res) {
                    $('#current_cart').append(res);
                } else {
                    console.log("nothing");
                }
            }
        });
    }

});
