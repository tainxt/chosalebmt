

$(document).ready(function () {
    $(".captcha-image").load(base_url + "Home/created");

    $("#owl-demo").owlCarousel({
        autoPlay: 10000,
        items: 4,
        itemsDesktop: [1199, 3],
        itemsDesktopSmall: [979, 3],
        pagination: false
    });

    $("#owl-cat-product").owlCarousel({
        autoPlay: false,
        items: 8,
        itemsDesktop: [1199, 6],
        itemsDesktopSmall: [979, 5],
        itemsTablet: [768, 4],
        itemsMobile: [600, 3],
        pagination: false,
        navigation: true
    });

    $('.owl-prev').html("");
    $('.owl-prev').append("<i class='fa fa-angle-left' aria-hidden='true'></i>");
    $('.owl-next').html("");
    $('.owl-next').append("<i class='fa fa-angle-right' aria-hidden='true'></i>");

    var localCache = {
        /**
         * timeout for cache in millis
         * @type {number}
         */
        timeout: 100000, // 100 sec
        /** 
         * @type {{_: number, data: {}}}
         **/
        data: {},
        remove: function (url) {
            delete localCache.data[url];
        },
        exist: function (url) {
            return !!localCache.data[url] && ((new Date().getTime() - localCache.data[url]._) < localCache.timeout);
        },
        get: function (url) {
            console.log('Cache tồn tại với id = ' + url);
            return localCache.data[url].data;
        },
        set: function (url, cachedData, callback) {
            localCache.remove(url);
            localCache.data[url] = {
                _: new Date().getTime(),
                data: cachedData
            };
            if ($.isFunction(callback))
                callback(cachedData);
        }
    };


    $('#owl-cat-product .item').click(function () {
        var parent_id = $(this).attr('data-id');
        $('#owl-cat-product .item').removeClass('active');
        $(this).addClass('active');
        $('#owl-demo').css('opacity', '0.5');
        $('.loading-product-img').removeClass('hidden');

        $.ajax({
            url: base_url + "home/testParent",
            type: 'post',
            data: 'parent_id=' + parent_id,
            dataType: 'html',
            cache: true,
            beforeSend: function () {
                if (localCache.exist(parent_id)) {
                    doSomething(localCache.get(parent_id));
                    return false;
                }
                return true;
            },
            complete: function (jqXHR, textStatus) {
                localCache.set(parent_id, jqXHR, doSomething);
            },
            error: function (e) {
                alert("lỗi cmnr");
                console.log(e);
            }
        });

    });

    $('.check-cache').click(function () {
        var parent_id = "3";
        if (localCache.exist(parent_id)) {
            doSomething(localCache.get(parent_id));
            return false;
        } else {
            console.log("cache chưa có");
        }
        return true;
    });

    function doSomething(data) {
        setTimeout(function () {
            $('#owl-demo').html("");
            $('#owl-demo').css('opacity', '1');
            $('.loading-product-img').addClass('hidden');
            $('#owl-demo').html(data.responseText);
            $('#owl-demo').data('owlCarousel').reinit();
            var l = $('#owl-demo .create-date').length;
            for(i = 1; i <= l; i++){
                var create_date =  $('.create-date-'+i).html() ;
                $('.create-date-'+i).html( moment_time(create_date) ) ;
            }
        }, 1000);
    }
    
    function rewite_time(time){
        
    }

    $('#myCarousel').carousel({
        interval: 100000
    });


    $(".carousel").swipe({
        swipe: function (event, direction, distance, duration, fingerCount, fingerData) {

            if (direction == 'left')
                $(this).carousel('next');
            if (direction == 'right')
                $(this).carousel('prev');

        },
        allowPageScroll: "vertical"
    });
    
    

});