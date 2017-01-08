

//load JSON file
$.getJSON(base_url + '/menu.json', function (data) {
//build menu

    var builddata = function () {
        var source = [];
        var items = [];
        for (i = 0; i < data.length; i++) {
            var item = data[i];
            var label = item["name"];
            var parentid = item["parent_id"];
            var id = item["id"];
            var url = item["url"];

            if (items[parentid]) {
                var item = {parentid: parentid, label: label, url: url, item: item, id: id};
                if (!items[parentid].items) {
                    items[parentid].items = [];
                }
                items[parentid].items[items[parentid].items.length] = item;
                items[id] = item;
            } else {
                items[id] = {parentid: parentid, label: label, url: url, item: item, id: id};
                source[id] = items[id];
            }
        }
        return source;
    };

    /* Build Menu Desktop */

    var buildUL = function (parent, items) {
        $.each(items, function () {
            if (this.label) {

                var divx = "";
                if (this.parentid === "0") {
                    divx = "<div class='sub-menu list-group list-categories'></div>";
                }

                var li = $("<li class='list-group-item hightline parent-" + this.parentid + " cat-id-" + this.id + "'>" + "<a href='" + base_url + "danhmuc/" + this.id + "/" + this.url + "'>" + this.label + "</a>" + divx + "</li>");
                li.appendTo(parent);

                if (this.items && this.items.length > 0) {

                    var ul = $("<ul>");
                    ul.appendTo(li);
                    buildUL(ul, this.items);
                }
            }
        });
    };

    /* Build Menu Mobile */

    var buildMobile = function (parent, items) {
        $.each(items, function () {
            var toggle = "";
            if (this.parentid === "0") {
                toggle = "class='dropdown-toggle' data-toggle='dropdown'";
            }
            if (this.label) {
                var li_mb = $("<li class='js-menu dropdown'>" + "<a href=''  " + toggle + " >" + this.label + "</a></li>");
                li_mb.appendTo(parent);
                if (this.items && this.items.length > 0) {
                    var ul_mb = $("<ul class='dropdown-menu js-menu'></ul>");
                    ul_mb.appendTo(li_mb);
                    buildMobile(ul_mb, this.items);
                }
            }
        });
    };

    var source = builddata();
    var ul = $("#csb-main-menu");
    ul.appendTo("#csb-main-menu");
    buildUL(ul, source);


    var ulMobile = $("#csm-menu-mobile");
    ulMobile.appendTo("#csm-menu-mobile");
    buildMobile(ulMobile, source);

    var slider_w = $('.box-main-slider').width();
    $('#csb-main-menu .sub-menu').css("width", slider_w + 30 + 2);
    var c = $('.tainxt > li').size();
    for (s = 0; s < data.length; s++) {
        var item = data[s];
        var parentid = item["parent_id"];
        var id = item["id"];
        if (parentid === "0") {
            //console.log(id);
            $(".tainxt > li.cat-id-" + id + " > ul").appendTo(".tainxt > li.cat-id-" + id + " > div");
        }

    }
    $('#csb-main-menu .sub-menu ul li').removeClass("list-group-item");

    //add bootstrap classes

    if ($("#csm-menu-mobile>li:has(ul.js-menu)")) {
        $("#csm-menu-mobile>li.js-menu").addClass('dropdown-submenu');
    }

    if ($("#csm-menu-mobile>li>ul.js-menu>li:has(> ul.js-menu)")) {
        $("#csm-menu-mobile>li>ul.js-menu li ").addClass('dropdown-submenu');
    }

    $("ul.js-menu").find("li:not(:has(> ul.js-menu))").removeClass("dropdown-submenu");



    $('a').click(function () {
        //return false;
    });


    $('.nav-slider li').click(function () {
        $('.nav-slider li').removeClass('sub-active');
        $(this).addClass('sub-active');
    });

    $('.easy-sidebar-toggle').click(function (e) {
        e.preventDefault();
        $('body').toggleClass('toggled');
        $('.navbar.easy-sidebar').removeClass('toggled');
    });
    $('html').on('swiperight', function () {
        $('body').addClass('toggled');
    });
    $('html').on('swipeleft', function () {
        $('body').removeClass('toggled');
    });


    $(document).on("click", '#csm-menu-mobile .dropdown-submenu', function () {
        //$(this).find('ul').css('display', 'block');
        $(this).find('ul').slideToggle('normal');
        $(this).find('ul').css('padding-left', '25px');
        $(this).addClass('haideptrai');
        return false;
    });

    $(document).on("click", '#csm-menu-mobile .haideptrai', function () {
        //$(this).find('ul').css('display', 'none');
        $(this).find('ul').slideUp();
        $(this).removeClass('haideptrai');
        return false;
    });

    $(document).on("click", '#csm-menu-mobile .haideptrai > ul > li', function () {
        //alert();
    });

    $(document).on('click', '.box-list-choose-cat', function () {
        $('.box-list-choose-cat .form-group').removeClass('choose-cat-active');
        $(this).find('.form-group').addClass('choose-cat-active');
        var slug = $(this).attr('data-slug');
        $('.choose_cat_up_btn').attr('data-cat-slug', slug);
    });

    $(document).on('click', '.choose_cat_up_btn', function () {
        var slug = $(this).attr('data-cat-slug');
        window.location.href = base_url + "Dangtin/Category/" + slug;
    });


});
