/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


/* JS drop menu */
$(document).ready(function () {

    $(document).on('click', '.box-filter .clickable', function (e) {
        var $this = $(this);
        if (!$this.hasClass('panel-collapsed')) {
            $this.parents('.panel').find('.panel-body').slideUp('normal');
            $this.addClass('panel-collapsed');
            $this.find('i').removeClass('glyphicon-chevron-up').addClass('glyphicon-chevron-down');
        } else {
            $this.parents('.panel').find('.panel-body').slideDown('normal');
            $this.removeClass('panel-collapsed');
            $this.find('i').removeClass('glyphicon-chevron-down').addClass('glyphicon-chevron-up');
        }
    });

    $('.box-filter .panel-body').hide();


    $('.btn-show-all-cat').click(function () {
        $('body').addClass('modal-open');
        var overlay = '<div class="modal-backdrop fade in"></div>';
        $('body').append(overlay);
        $('.categories-col-left').slideDown('fast');
    });

    $(document).on('click', '.modal-backdrop', function () {
        $('body').removeClass('modal-open');
        $(this).remove();
        $('.categories-col-left').slideUp('fast');
    });

    $('.collapse-list').click(function () {
        $('.panel-box-product .line-product').removeClass("col-xs-6 col-xxs-12 item col-sm-4 col-xs-12 col-lg-4");
        $('.panel-box-product .line-product').addClass("col-lg-12");

        $('.panel-box-product .line-product .border-product .thumbnail').addClass("col-md-4 col-sm-5 col-xs-6");
        $('.panel-box-product .line-product .border-product .caption').addClass("list-caption col-md-8 col-sm-7 col-xs-6");

        $('.panel-box-product .line-product .border-product .caption .poster span').removeClass("hidden");

        $('.panel-box-product .line-product .border-product .product-time').addClass("hidden");
    });

    $('.collapse-box').click(function () {

        $('.panel-box-product .line-product').removeClass("col-lg-12");
        $('.panel-box-product .line-product').addClass("col-xs-6 col-xxs-12 item col-sm-4 col-xs-12 col-lg-4");

        $('.panel-box-product .line-product .border-product .thumbnail').removeClass("col-md-4 col-sm-5 col-xs-6");
        $('.panel-box-product .line-product .border-product .caption').removeClass("col-md-8 col-sm-7 col-xs-6");
        $('.panel-box-product .line-product .border-product .caption .poster span').addClass("hidden");
        $('.panel-box-product .line-product .border-product .product-time').removeClass("hidden");

    });
});
