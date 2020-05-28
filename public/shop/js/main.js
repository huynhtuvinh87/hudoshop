jQuery(document).ready(function ($) {
    $("header .form-search .list-search ul li").click(function () {
        var data_category = $(this).attr("data-category");
        var category = $(this).text();
        $("#search_category").val(data_category);
        $("header .input-group-btn button span").text(category);
    });
    $(".provinces-box ul li").on("click", function () {
        var location = $(this).text();
        $(".provinces-box>span").text(location);
    });
    $(".provinces-box span").hover(function () {
        $(this).siblings(".balloon").removeClass('hidden');
    });
    $(".provinces-box span").on("click", function () {
        $(this).siblings(".balloon").removeClass('hidden');
    });
    $(".provinces-box .close").on("click", function () {
        $(this).parent(".balloon").addClass('hidden');
    });
    $(".search-province").on("keyup", function () {
        var value = $(this).val().toLowerCase();
        $(".provinces-box ul li").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
    if ($('#home-page').length > 0) {
        $('body').addClass('home');
    }
    // } else {
    //     $('body').removeClass('home');
    //     $('body').addClass('page');
    // }
    $("header .main-nav-toggle").click(function () {

        if ($("body").hasClass("home") == false) {
            $("header nav .list-cat").parent("nav").find(".list-cat").toggleClass("nav-active");
            $("header .main-nav-toggle").parent("nav").find(".list-cat").slideToggle();
        }
    });

   

    // single product slide
    $('.product-detail-inner .slider-for').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        fade: true,
        centerMode: true,
        asNavFor: '.slider-nav'
    });
    $('.product-detail-inner .slider-nav').slick({
        slidesToShow: 4,
        slidesToScroll: 1,
        asNavFor: '.slider-for',
        dots: true,
        margin: 10,
        centerMode: true,
        focusOnSelect: true,

    });
    $('.slide-company .slider-for').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        fade: true,
        asNavFor: '.slider-nav'
    });
    $('.slide-company .slider-nav').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        asNavFor: '.slider-for',
        dots: false,
        centerMode: false,
        variableWidth: true,
        focusOnSelect: true
    });
    //change quantity of product

    //footer tooltip
    $('footer .bv-form').find('i').hover(function () {
        $(this).siblings('.help-block').addClass('visible');
    });

    if ($(window).width() <= 384) {
        $('#list-tab').each(function () {
            var elm = this,
                    jelm = $(this),
                    jtab = jelm.find('.nav-tabs'),
                    jitems = jtab.find('li');
            jelm.addClass('tab-carousel');
            elm.tabsCarousel = new Swiper(jelm.find('.wrap-tab').get(0), {
                direction: 'horizontal',
                wrapperClass: 'nav-tabs',
                slideClass: 'li',
                slidesPerView: 'auto'
            });
            elm.tabsCarousel.slideTo(jitems.index(jitems.filter('.active')) - 1);
        });
        $('.block_header').append('<i class="fa fa-angle-down" aria-hidden="true"></i>');
        $('.block_header .fa-angle-down').on('click', function () {
            // $(this).parent().addClass('open');
            if ($(this).parent().hasClass('open')) {
                $(this).parent().removeClass('open');
            } else {
                $(this).parent().addClass('open');
            }
            $(this).siblings('.block_tab').slideToggle();
        });
    }
    //Click button to show menu mobi
    $("header .row .fa-bars").on("click", function () {
        $(".menu-mobi.main").addClass("active");
        $(".overlay").show();
        $("#disabled").fadeIn();
        $("body").addClass("no-scroll");
    });
    $(".intro-header .left .fa-bars").on("click", function () {
        $(".menu-mobi.intro").addClass("active");
        $(".overlay").show();
        $("body").addClass("no-scroll");
        $("#disabled").fadeIn();
    });
    $(".menu-mobi .close-menu,.overlay").on("click", function () {
        $(".menu-mobi").removeClass("active");
        $(".overlay").hide();
        $("body").removeClass("no-scroll");
        $("#disabled").fadeOut();
    });
    //Show/Hide Filter
    $("button.button-filter").on("click", function () {
        $(".content").toggleClass("active");
    });
    $("a.button-filter, .header-mobi .back").on("click", function () {
        $(".content").toggleClass("active");
        $("body").toggleClass("no-scroll");
        console.log('23');
    });


    // $(".header-mobi .back").on("click",function(){
    //     $(".content").toggleClass("active");
    // });
    //Show hide item filter
    if ($(window).width() > 1024) {
        $("#sidebar .widget .fa-angle-down").on("click", function () {
            var parent = $(this).parents(".widget");
            if ($(this).hasClass("active")) {
                $(this).removeClass("active");
                $(this).parents(".widget-title").removeClass('open');
                parent.removeClass('open');
            } else {
                $(this).addClass("active");
                $(this).parents(".widget-title").addClass('open');
                parent.addClass('open');
            }
            $(this).parents(".widget-title").siblings("div").slideToggle();
            $(this).parents(".widget-title").siblings("ul").slideToggle();
        });
    } else {
        $("#sidebar .widget .widget-title").on("click", function () {
            var parent = $(this).parents(".widget");
            if ($(this).hasClass("open")) {
                $(this).removeClass("open");
                $(this).children('.fa-angle-down').removeClass('active');
                parent.removeClass('open');
            } else {
                $(this).addClass("open");
                $(this).children('.fa-angle-down').addClass('active');
                parent.addClass('open');
            }
            $(this).siblings("div").slideToggle();
            $(this).siblings("ul").slideToggle();
        });
    }
    $(".col-text .more").on("click", function (e) {
        e.preventDefault();
        $(this).siblings(".content-text").toggleClass("show-full");
        if ($(this).siblings(".content-text").hasClass("show-full")) {
            $(this).children("span").text("Hide");
            $(this).children("i").addClass("rotate");
        } else {
            $(this).children("span").text("More");
            $(this).children("i").removeClass("rotate");
        }
    });
    if ($(window).width() > 1025) {
        if ($(".grid-sub").length > 0) {
            var sidebar = new StickySidebar('#sidebar', {
                containerSelector: '#main-content',
                innerWrapperSelector: '.sidebar__inner',
                topSpacing: 0,
                bottomSpacing: 0
            });
        }
    }

    $('#sidebar .btn-reset').on('click', function () {
        $(this).parents('#sidebar').find('.checkbox-square').addClass('reset');
        $(this).parents('#sidebar').find('.checkbox-square input').prop('checked', false);
    });
    $('#sidebar').find('.checkbox-square').on('click', function () {
        $(this).removeClass('reset');
    });
    $('.attach').on('click', function () {
        $(this).siblings('.upload-image').trigger("click");
    });

    $(".top-company .show-cat").on("click", function () {
        if ($(".grid-sub").hasClass("active")) {
            $(".grid-sub").removeClass("active");
            $("body").removeClass("no-scroll");
        } else {
            $(".grid-sub").addClass("active");
            $("body").addClass("no-scroll");
        }
    });
    $(".grid-sub .header-mobi .back").on("click", function () {
        $(".grid-sub").removeClass("active");
        $("body").removeClass("no-scroll");
    });
});
