$(document).ready(function () {

    var sp_moi_trang = 1;

    /*
     * Khởi tạo cache
     */
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
            console.log('Cache tồn tại với url = ' + url);
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
            console.log('Set cache với url = ' + url);
        }
    };

    /* 
     * ##########################################################
     * Set cache cho trang đầu tiên
     * ##########################################################
     
     var first_page_html = $('.panel-box-product').html();
     var arr_str = {respone: first_page_html, pagetype: "abc"};
     var first_page = {responseText: arr_str};
     var curent_cat = $('.categories-paging').attr('paging-cat');
     var url_first_page = base_url + "Danhmuc/ajax_paging/" + 1 + "/" + 1 + "/" + curent_cat;
     localCache.set(url_first_page, first_page, doSomething);
     */


    $(document).on('click', '.btn-jump', function () {
        alert();
    });

    /* 
     * ##########################################################
     * Sự kiện click vào nút trang đầu tiên
     * ##########################################################
     */
    $(document).on('click', '.first-page', function () {
        // Loại paging
        var type_page = $('.categories-paging').attr('paging-type');

        // Danh mục hiện tại
        var curent_cat = $('.categories-paging').attr('paging-cat');
        $('.curent-page').html("1");
        ajax_paging(type_page, 1, curent_cat);
        return false;
    });


    /* 
     * ##########################################################
     * Sự kiện click vào nút trang cuối cùng
     * ##########################################################
     */
    $(document).on('click', '.last-page', function () {
        // Loại paging
        var type_page = $('.categories-paging').attr('paging-type');

        // Danh mục hiện tại
        var curent_cat = $('.categories-paging').attr('paging-cat');

        // Lấy tổng số trang
        var total_page = $('.total-page').html();

        $('.curent-page').html(total_page);

        ajax_paging(type_page, total_page, curent_cat);
        return false;
    });


    /* 
     * ##########################################################
     * Sự kiện click vào nút trang tiếp theo
     * ##########################################################
     */
    $(document).on('click', '.next-page', function () {
        // Loại paging
        var type_page = $('.categories-paging').attr('paging-type');

        // Lấy trang hiện tại
        var curent_page = $('.curent-page').html();

        // Danh mục hiện tại
        var curent_cat = $('.categories-paging').attr('paging-cat');

        // Lấy tổng số trang
        var total_page = $('.total-page').html();

        // Nếu trang hiện tại = tổng số trang
        if (curent_page === total_page) {
            alert("Trang cuối rồi");
        } else {

            if (type_page === "1") {
                var next_page = parseInt(curent_page) + 1;
                $('.curent-page').html(next_page);
                ajax_paging(type_page, next_page, curent_cat);
            } else if (type_page === "2") {

                var keyword = $('#txt-search-category').val();
                var next_page = parseInt(curent_page) + 1;
                $('.curent-page').html(next_page);
                ajax_search_paging(type_page, keyword, next_page, curent_cat);
            } else if (type_page === "3") {
                var keyword = $('#txt-search-category').val();
                if (keyword === "") {
                    keyword = "_null_";
                }
                var next_page = parseInt(curent_page) + 1;
                $('.curent-page').html(next_page);
                var data_paging = filter_hight_low();
                var data_hight_low = data_paging['select_hight_low'];
                var data_range = data_paging['select_range'];
                var data_time = data_paging['select_time'];
                ajax_filter(keyword, next_page, curent_cat, data_hight_low, data_range, data_time);
            }

        }
        return false;
    });

    /* 
     * ##########################################################
     * Sự kiện click vào nút trang trước
     * ##########################################################
     */
    $(document).on('click', '.preview-page', function () {
        // Loại paging
        var type_page = $('.categories-paging').attr('paging-type');

        // Lấy trang hiện tại
        var curent_page = $('.curent-page').html();

        // Danh mục hiện tại
        var curent_cat = $('.categories-paging').attr('paging-cat');

        // Lấy tổng số trang
        var total_page = $('.total-page').html();

        // Nếu trang hiện tại = 1
        if (curent_page === "1") {
            alert_error_page("Bạn đang ở trang đầu tiên");
        } else {

            if (type_page === "1") {
                var preview_page = parseInt(curent_page) - 1;
                $('.curent-page').html(preview_page);
                ajax_paging(type_page, preview_page, curent_cat);
            } else if (type_page === "2") {
                var preview_page = parseInt(curent_page) - 1;
                $('.curent-page').html(preview_page);
                var keyword = $('#txt-search-category').val();
                ajax_search_paging(type_page, keyword, preview_page, curent_cat);
            } else if (type_page === "3") {
                var keyword = $('#txt-search-category').val();
                if (keyword === "") {
                    keyword = "_null_";
                }
                var preview_page = parseInt(curent_page) - 1;
                $('.curent-page').html(preview_page);
                var data_paging = filter_hight_low();
                var data_hight_low = data_paging['select_hight_low'];
                var data_range = data_paging['select_range'];
                var data_time = data_paging['select_time'];
                ajax_filter(keyword, preview_page, curent_cat, data_hight_low, data_range, data_time);
            }


        }
        return false;
    });

    /* 
     * ##########################################################
     * Sự kiện click vào nút tim kiem
     * ##########################################################
     */
    $(document).on('click', '#btn-search', function () {
        var keyword = $('#txt-search-category').val();
        var type_page = 3;
        var curent_page = 1;
        var curent_cat = $('.categories-paging').attr('paging-cat');
        if (keyword === "") {
            alert("Insert a keyword");
        } else {

            var data_paging = filter_hight_low();
            var data_hight_low = data_paging['select_hight_low'];
            var data_range = data_paging['select_range'];
            var data_time = data_paging['select_time'];
            ajax_filter(keyword, curent_page, curent_cat, data_hight_low, data_range, data_time);

            $('.reset-filter').removeClass('hidden');
            setTimeout(function () {
                var total_products = $('#return-total-products').html();
                create_paging(type_page, total_products, sp_moi_trang);
            }, 1000);
        }
    });

    /* 
     * ##########################################################
     * Sự kiện click vào nút bỏ bộ lọc
     * ##########################################################
     */
    $(document).on('click', '.reset-filter', function () {
        var curent_cat = $('.categories-paging').attr('paging-cat');
        var total_products = $('#content-products').attr('data-total');
        ajax_paging(1, 1, curent_cat);

        setTimeout(function () {
            create_paging(1, total_products, 1);
            $(this).addClass('hidden');
        }, 1000);

    });

    function doSomething(data) {
        var array = JSON.parse("[" + data.responseText + "]");

        if (typeof (array[0].type) !== "undefined") {
            setTimeout(function () {
                $('.loading-product-img').addClass('hidden');
                $('.panel-box-product').css('opacity', '1');
                $('.panel-box-product').html("");
                $('.panel-box-product').html(array[0].respone);
            }, 1000);
            console.log("type = " + array[0].type);
        } else {
            setTimeout(function () {
                $('.loading-product-img').addClass('hidden');
                $('.panel-box-product').css('opacity', '1');
                $('.panel-box-product').html("");
                $('.panel-box-product').html(array[0].respone);
            }, 1000);
        }

    }

    function ajax_paging(type_page, curent_page, curent_cat) {
        $("html, body").animate({scrollTop: $('#content-products').offset().top}, 1000);
        var url = base_url + "Danhmuc/ajax_paging/" + type_page + "/" + curent_page + "/" + curent_cat;
        $.ajax({
            url: url,
            type: 'GET',
            cache: false,
            beforeSend: function () {
                $('.panel-box-product').css('opacity', '0.5');
                $('.loading-product-img').removeClass('hidden');
                if (localCache.exist(url)) {
                    doSomething(localCache.get(url));
                    return false;
                }
                return true;
            },
            complete: function (jqXHR, textStatus) {
                localCache.set(url, jqXHR, doSomething);
            },
            error: function (e) {
                console.log(e);
            }
        });
    }

    function ajax_search_paging(type_page, keyword, curent_page, curent_cat) {
        $("html, body").animate({scrollTop: $('#content-products').offset().top}, 1000);
        var url = base_url + "Danhmuc/ajax_search_paging/" + type_page + "/" + keyword + "/" + curent_page + "/" + curent_cat;
        $.ajax({
            url: url,
            type: 'GET',
            cache: false,
            beforeSend: function () {
                $('.panel-box-product').css('opacity', '0.5');
                $('.loading-product-img').removeClass('hidden');
                if (localCache.exist(url)) {
                    doSomething(localCache.get(url));
                    return false;
                }
                return true;
            },
            complete: function (jqXHR, textStatus) {
                localCache.set(url, jqXHR, doSomething);
                var array = JSON.parse("[" + jqXHR.responseText + "]");
                $('#return-total-products').html(array[0].total_products);
            },
            error: function (e) {
                console.log(e);
            }
        });
    }



    function alert_error_page(message) {
        $("html, body").animate({scrollTop: $('#content-products').offset().top}, 1000);
    }

    function create_paging(paging_type, total_products, per_page) {
        if (parseInt(total_products) > 0) {
            $('#default-paging').html("");
            $('#default-paging').attr('paging-type', paging_type);
            //$('#ajax-search-paging').remove();
            var total_page = Math.round(parseInt(total_products) / parseInt(per_page));
            var html_paging = "";
            html_paging += ''
                    + '<li><a class="first-page btn-primary" href="#" data-page="1">Trang đầu</a></li>'
                    + '<li><a class="preview-page" href="#"><i class="fa fa-angle-left" aria-hidden="true"></i>Trang trước</a></li>'
                    + '<li class="active"><a href="#"><span class="curent-page">1</span>/<span class="total-page">' + total_page + '</span></a></li>'
                    + '<li><a class="next-page" href="#">Trang sau<i class="fa fa-angle-right" aria-hidden="true"></i></a></li>'
                    + '<li><a class="last-page" href="#" data-page="' + total_page + '">Trang cuối</a></li>';

            $('#default-paging').append(html_paging);
        } else {
            $('#default-paging').html("");
        }
    }

    /*
     * Nút hiển thị nâng cao
     */

    $(document).on('click', '.show-advanced-btn', function () {
        $('.advanced-btns').toggle();
    });

    /*
     * ajax filter
     */
    function ajax_filter(keyword, page, id, highTolow, price, time) {
        $("html, body").animate({scrollTop: $('#content-products').offset().top}, 1000);
        var url = base_url + "Danhmuc/filter_products/" + keyword + "/" + page + "/" + id + "/" + highTolow + "/" + price + "/" + time;
        $.ajax({
            url: url,
            type: 'GET',
            cache: false,
            beforeSend: function () {
                $('.panel-box-product').css('opacity', '0.5');
                $('.loading-product-img').removeClass('hidden');
                if (localCache.exist(url)) {
                    doSomething(localCache.get(url));

                    var data = localCache.get(url);
                    var array = JSON.parse("[" + data.responseText + "]");
                    $('#return-total-products').html(array[0].total_products);

                    return false;
                }
                return true;
            },
            complete: function (jqXHR, textStatus) {
                localCache.set(url, jqXHR, doSomething);
                var array = JSON.parse("[" + jqXHR.responseText + "]");
                $('#return-total-products').html(array[0].total_products);
            },
            error: function (e) {
                console.log(e);
            }
        });
    }

    /*
     * Nút sắp xếp theo cao thấp
     */
    $(document).on('click', '.list-hight-low li a', function () {
        // Bỏ font weight: bold
        $('.list-hight-low li a').removeClass('text-bold');

        // Lấy nội dung của select
        var select_text = $(this).html();

        // Lấy giá trị của select sắp xếp giá
        var select_hight_low = $(this).attr('data-hight-low');

        // Lấy giá trị của select khoảng giá
        var select_range = $('.box-range button span').attr("data-range");
        if (typeof (select_range) === "undefined") {
            select_range = "0-x";
        }

        // Lấy giá trị của select time
        var select_time = $('.box-time button span').attr("data-time");
        if (typeof (select_time) === "undefined") {
            select_time = "3";
        }

        // ID danh mục hiện tại
        var id = $('.categories-paging').attr('paging-cat');

        // Lấy từ khóa tìm kiếm
        var keyword = $('#txt-search-category').val();
        if (keyword === "") {
            keyword = "_null_";
        }

        // Thay đổi tên hiển thị select và gắn thêm attr data-high-low
        $('.box-hight-low button span').html(select_text);
        $('.box-hight-low button span').attr("data-hight-low", select_hight_low);



        // Thêm font weight: bold
        $(this).addClass('text-bold');

        // Hiển thị nút reset filter
        $('.reset-filter').removeClass('hidden');

        ajax_filter(keyword, 1, id, select_hight_low, select_range, select_time);
        setTimeout(function () {
            var total_products = $('#return-total-products').html();
            create_paging(3, total_products, sp_moi_trang);
            // Ẩn select
            $('.dropdown.open .dropdown-toggle').dropdown('toggle');
        }, 1000);
        return false;
    });

    /*
     * Nút sắp xếp theo khoảng giá
     */
    $(document).on('click', '.list-range li a', function () {
        // Bỏ font weight: bold
        $('.list-range li a').removeClass('text-bold');

        // Lấy nội dung của select
        var select_text = $(this).html();

        // Lấy giá trị của select sắp xếp giá
        var select_range = $(this).attr('data-range');

        // Lấy giá trị của select high low
        var select_hight_low = $('.box-hight-low button span').attr("data-hight-low");
        if (typeof (select_hight_low) === "undefined") {
            select_hight_low = "asc";
        }

        // Lấy giá trị của select time
        var select_time = $('.box-time button span').attr("data-time");
        if (typeof (select_time) === "undefined") {
            select_time = "3";
        }

        // ID danh mục hiện tại
        var id = $('.categories-paging').attr('paging-cat');

        // Lấy từ khóa tìm kiếm
        var keyword = $('#txt-search-category').val();
        if (keyword === "") {
            keyword = "_null_";
        }

        // Thay đổi tên hiển thị select và gắn thêm attr data-high-low
        $('.box-range button span').html(select_text);
        $('.box-range button span').attr("data-range", select_range);



        // Thêm font weight: bold
        $(this).addClass('text-bold');

        // Hiển thị nút reset filter
        $('.reset-filter').removeClass('hidden');

        ajax_filter(keyword, 1, id, select_hight_low, select_range, select_time);
        setTimeout(function () {
            var total_products = $('#return-total-products').html();
            create_paging(3, total_products, sp_moi_trang);
            // Ẩn select
            $('.dropdown.open .dropdown-toggle').dropdown('toggle');
        }, 1000);
        return false;
    });

    /*
     * Nút sắp xếp theo thời gian
     */
    $(document).on('click', '.list-time li a', function () {
        // Bỏ font weight: bold
        $('.list-time li a').removeClass('text-bold');

        // Lấy nội dung của select
        var select_text = $(this).html();

        // Lấy giá trị của select sắp xếp giá
        var select_time = $(this).attr('data-time');

        // Lấy giá trị của select high low
        var select_hight_low = $('.box-hight-low button span').attr("data-hight-low");
        if (typeof (select_hight_low) === "undefined") {
            select_hight_low = "0";
        }

        // Lấy giá trị của select time
        var select_range = $('.box-range button span').attr("data-range");
        if (typeof (select_range) === "undefined") {
            select_range = "0-x";
        }

        // ID danh mục hiện tại
        var id = $('.categories-paging').attr('paging-cat');

        // Lấy từ khóa tìm kiếm
        var keyword = $('#txt-search-category').val();
        if (keyword === "") {
            keyword = "_null_";
        }

        // Thay đổi tên hiển thị select và gắn thêm attr data-high-low
        $('.box-time button span').html(select_text);
        $('.box-time button span').attr("data-time", select_time);

        // Thêm font weight: bold
        $(this).addClass('text-bold');

        // Hiển thị nút reset filter
        $('.reset-filter').removeClass('hidden');

        ajax_filter(keyword, 1, id, select_hight_low, select_range, select_time);
        setTimeout(function () {
            var total_products = $('#return-total-products').html();
            create_paging(3, total_products, sp_moi_trang);
            // Ẩn select
            $('.dropdown.open .dropdown-toggle').dropdown('toggle');
        }, 1000);
        return false;
    });

    function filter_hight_low() {
        // Lấy giá trị của select high low
        var select_hight_low = $('.box-hight-low button span').attr("data-hight-low");
        if (typeof (select_hight_low) === "undefined") {
            select_hight_low = "asc";
        }

        // Lấy giá trị của select price
        var select_range = $('.box-range button span').attr("data-range");
        if (typeof (select_range) === "undefined") {
            select_range = "0-x";
        }

        // Lấy giá trị của select time
        var select_time = $('.box-time button span').attr("data-time");
        if (typeof (select_time) === "undefined") {
            select_time = "3";
        }

        var result = {
            select_hight_low: select_hight_low,
            select_range: select_range,
            select_time: select_time
        };

        return result;

    }

});

