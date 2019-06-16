(function ($) {
    "use strict";

    var $document = $(document),
        $window = $(window),
        $body = $('body'),
        $html = $('html'),
        $ttPageContent = $('#tt-pageContent'),
        $ttFooter = $('footer'),
        $ttHeader = $('header'),
        $ttLeftColumnAside = $ttPageContent.find('.leftColumn.aside'),
        $ttFilterOptions = $ttPageContent.find('.tt-filters-options'),

        /* menu setting*/
        header_menu_timeout = 200,
        header_menu_delay = 200,

        //header
        $ttTopPanel = $('.tt-top-panel'),
        //header stuck
        $stucknav = $ttHeader.find('.tt-stuck-nav'),
        //header menu
        $ttDesctopMenu = $ttHeader.find('.tt-desctop-menu'),
        $ttDesctopParentMenu = $ttHeader.find('.tt-desctop-parent-menu'),
        $ttMobileParentMenu = $ttHeader.find('.tt-mobile-parent-menu'),
        $ttMobileParentMenuChildren = $ttMobileParentMenu.children(),
        $ttStuckParentMenu = $ttHeader.find('.tt-stuck-parent-menu'),
        //header search
        $ttSearchObj = $ttHeader.find('.tt-search'),
        $ttDesctopParentSearch = $ttHeader.find('.tt-desctop-parent-search'),
        $ttMobileParentSearch = $ttHeader.find('.tt-mobile-parent-search'),
        $ttStuckParentSearch = $ttHeader.find('.tt-stuck-parent-search'),
        $ttSearchObjPopupInput = $ttSearchObj.find('.tt-search-input'),
        $ttSearchObjPopupResults = $ttSearchObj.find('.search-results'),
        //header cart
        $ttcartObj = $ttHeader.find('.tt-cart'),
        $ttDesctopParentCart = $ttHeader.find('.tt-desctop-parent-cart'),
        $ttMobileParentCart = $ttHeader.find('.tt-mobile-parent-cart'),
        $ttStuckParentCart = $ttHeader.find('.tt-stuck-parent-cart'),
        //header account
        $ttAccountObj = $ttHeader.find('.tt-account'),
        $ttDesctopParentAccount = $ttHeader.find('.tt-desctop-parent-account'),
        $ttMobileParentAccount = $ttHeader.find('.tt-mobile-parent-account'),
        $ttStuckParentAccount = $ttHeader.find('.tt-stuck-parent-account'),
        //header langue and currency(*all in one module)
        $ttMultiObj = $ttHeader.find('.tt-multi-obj'),
        $ttDesctopParentMulti = $ttHeader.find('.tt-desctop-parent-multi'),
        $ttMobileParentMulti = $ttHeader.find('.tt-mobile-parent-multi'),
        $ttStuckParentMulti = $ttHeader.find('.tt-stuck-parent-multi'),

        // Template Blocks
        blocks = {
            ttCalendarDatepicker: $ttPageContent.find('.calendarDatepicker'),
            ttSliderBlog: $ttPageContent.find('.tt-slider-bizblog'),
            ttSlickMain: $ttPageContent.find('.tt-slick-main'),
            ttSliderBlogSingle: $ttPageContent.find('.tt-slider-bizblog-single'),
            ttVideoBlock: $('.tt-video-block'),
            ttBlogMasonry: $ttPageContent.find('.tt-bizblog-masonry'),
            ttPortfolioMasonry: $ttPageContent.find('.tt-portfolio-masonry'),
            ttProductMasonry: $ttPageContent.find('.tt-product-listing-masonry'),
            ttLookBookMasonry: $ttPageContent.find('.tt-lookbook-masonry'),
            ttInputCounter: $('.tt-input-counter'),
            ttCollapseBlock: $('.tt-collapse-block'),
            modalVideoProduct: $('#modalVideoProduct'),
            modalAddToCart: $('#modalAddToCartProduct'),
            ttMobileProductSlider: $('.tt-mobile-product-slider'),
            ttCollapse: $ttPageContent.find('.tt-collapse'),
            ttProductListing: $ttPageContent.find('.tt-product-listing'),
            ttCountdown: $ttPageContent.find('.tt-countdown'),
            ttBtnColumnClose: $ttLeftColumnAside.find('.tt-btn-col-close'),
            ttBtnToggle: $ttFilterOptions.find('.tt-btn-toggle a'),
            ttBtnAddProduct: $ttPageContent.find('.tt_product_showmore'),
            ttOptionsSwatch: $ttPageContent.find('.tt-options-swatch'),
            ttProductItem: $ttPageContent.find('.tt-product, .tt-product-design02'),
            ttProductDesign02: $ttPageContent.find('.tt-product-design02'),
            ttProductDesign01: $ttPageContent.find('.tt-product'),
            ttFilterDetachOption: $ttLeftColumnAside.find('.tt-filter-detach-option'),
            ttFilterSort: $ttFilterOptions.find('.tt-sort'),
            ttShopCart: $ttPageContent.find('.tt-shopcart-table, .tt-shopcart-table-02'),
            ttSliderLookbook: $ttPageContent.find('.tt-slider-lookbook'),
            ttCaruselLookbook: $ttPageContent.find('.tt-carousel-lookbook'),
            ttPortfolioContent: $ttPageContent.find('.tt-portfolio-content'),
            ttLookbook: $ttPageContent.find('.tt-lookbook'),
            ttAirSticky: $ttPageContent.find('.airSticky'),
            ttfooterMobileCollapse: $ttFooter.find('.tt-collapse-title'),
            ttBackToTop: $('.tt-back-to-top'),
            ttHeaderDropdown: $ttHeader.find('.tt-dropdown-obj'),
            mobileMenuToggle: $('.tt-menu-toggle'),
            ttCarouselProducts: $('.tt-carousel-products'),
            ttSliderFullwidth: $('.tt-slider-fullwidth'),
            ttCarouselBrands: $('.tt-carousel-brands'),
            sliderRevolution: $('.slider-revolution'),
            ttItemsCategories: $ttPageContent.find('.tt-items-categories'),
            ttDotsAbsolute: $ttPageContent.find('.tt-dots-absolute'),
            ttAlignmentImg: $ttPageContent.find('.tt-alignment-img'),
            ttModalQuickView: $('#ModalquickView'),
            ttProductSingleBtnZomm: $ttPageContent.find('.tt-product-single-img .tt-btn-zomm'),
            ttPromoFixed: $('.tt-promo-fixed'),
            ttInstafeedFluid: $ttPageContent.find('.instafeed-fluid'),
            ttInstafeedCol: $ttPageContent.find('.instafeed-col'),
        };

    var ttwindowWidth = window.innerWidth || $window.width();

    // for demo
    // boxedbutton
    var ttBoxedbutton = $('#tt-boxedbutton');
    if (ttBoxedbutton.length) {
        ttBoxedbutton.on('click', '.rtlbutton', function (e) {
            e.preventDefault;
            var target = e.target,
                $link = $('<link>', {
                    rel: 'stylesheet',
                    href: 'css/rtl.css',
                    class: 'rtl'
                });

            if (!$(this).hasClass('external-link')) {
                $(this).toggleClass('active');
            }
            if ($(this).hasClass('boxbutton-js')) {
                $html.toggleClass('tt-boxed');
                if (blocks.ttProductMasonry.length) {
                    gridProductMasonr();
                }
                if (blocks.ttLookBookMasonry.length) {
                    gridLookbookMasonr();
                }
                if (blocks.ttBlogMasonry.length) {
                    gridGalleryMasonr();
                }
                if (blocks.ttPortfolioMasonry.length) {
                    gridPortfolioMasonr();
                    initPortfolioPopup();
                }
                if (blocks.ttLookbook.length) {
                    ttLookbook(ttwindowWidth);
                }
                $('.slick-slider').slick('refresh');
            }
            if ($(this).hasClass('rtlbutton-js') && $(this).hasClass('active')) {
                $link.appendTo('head');
            } else if ($(this).hasClass('rtlbutton-js') && !$(this).hasClass('active')) {
                $('link.rtl').remove();
            }
        });
        ttBoxedbutton.on('click', '.rtlbutton-color li', function (e) {
            $('link[href^="css/theme-"]').remove();

            var dataValue = $(this).attr('data-color'),
                htmlLocation = $('link[href^="css/theme-"]');

            if ($(this).hasClass('active')) return;

            $(this).toggleClass('active').siblings().removeClass('active');

            if (dataValue != undefined) {
                $('head').append('<link rel="stylesheet" href="css/theme-' + dataValue + '.css" rel="stylesheet">');
            } else {
                $('head').append('<link rel="stylesheet" href="css/theme.css" rel="stylesheet">');
            }
            return false;
        });
    }
    // demo end

    // lazyLoad
    (function () {
        new LazyLoad();
        new LazyLoad({
            elements_selector: "iframe"
        });
        new LazyLoad({
            elements_selector: "video"
        });
    }());

    // toltip
    // toltip
    (function () {
        var ttwindowWidth = window.innerWidth || $window.width(),
            $ttTooltip = $('[data-tooltip="tt-tooltip"]');

        if ($ttTooltip.length && ttwindowWidth > 1024) {
            ttToltip();
        }
        $window.resize(debouncer(function (e) {
            var ttwindowWidth = window.innerWidth || $window.width();
            if (ttwindowWidth > 1024 && $ttTooltip.length) {
                ttToltip();
            } else {
                ttToltip();
            }
        }));

        function ttToltip() {
            $body.on('mouseenter mouseleave', '[data-tooltip="tt-tooltip"]', function (e) {
                var $this = $(this),
                    windW = window.innerWidth,
                    target = e.target,
                    objVaule = $this.data('title'),
                    objPlacement = $this.data('placement');

                if (e.type === 'mouseenter' && windW > 1024) {
                    ttOnHover();
                } else if (e.type === 'mouseleave' && e.relatedTarget && windW > 1024) {
                    ttOffHover();
                }

                function ttOnHover(e) {
                    $body.append('<div id="tt-tooltip-popup"><span>' + objVaule + '</span><i></i></div>');
                    var ttTooltipPopup = $('#tt-tooltip-popup');
                    if (objPlacement == "left") {
                        var tooltipHeight = ttTooltipPopup.innerHeight() / 2 + 1,
                            tooltipWidth = ttTooltipPopup.innerWidth(),
                            objTop = $this.offset().top + tooltipHeight,
                            objLeft = $this.offset().left - tooltipWidth - 15;
                        ttalignmentObj(objTop, objLeft, objPlacement);
                    } else if (objPlacement == "right") {
                        var tooltipHeight = ttTooltipPopup.innerHeight() / 2 + 1,
                            tooltipWidth = ttTooltipPopup.innerWidth(),
                            objTop = $this.offset().top + tooltipHeight,
                            objLeft = $this.offset().left + tooltipWidth - 15;
                        ttalignmentObj(objTop, objLeft, objPlacement);
                    } else if (objPlacement == "top") {
                        var tooltipHeight = ttTooltipPopup.innerHeight(),
                            objTop = $this.offset().top - tooltipHeight - 15,
                            tooltipWidth = ttTooltipPopup.innerWidth() / 2,
                            objWidth = $this.innerWidth() / 2,
                            objLeft = $this.offset().left + objWidth - tooltipWidth;
                        ttalignmentObj(objTop, objLeft, objPlacement);
                    } else if (objPlacement == "bottom") {
                        var objHeight = $this.innerHeight(),
                            objTop = $this.offset().top + objHeight + 15,
                            tooltipWidth = ttTooltipPopup.innerWidth() / 2,
                            objWidth = $this.innerWidth() / 2,
                            objLeft = $this.offset().left + objWidth - tooltipWidth;
                        ttalignmentObj(objTop, objLeft, objPlacement);
                    }
                    return false;
                }

                function ttalignmentObj(objTop, objLeft, objPlacement) {
                    $('#tt-tooltip-popup').css({
                        'top': objTop,
                        'left': objLeft
                    }).addClass('tooltip-' + objPlacement).animate({opacity: 1}, 300);
                }

                function ttOffHover(e) {
                    $body.find('#tt-tooltip-popup').remove();
                    return false
                }
            });
        }
    }());


    //instafeed
    $.fn.func_instafeed = function (new_obj) {
        var $this = $(this);
        if (!$this.length) return;
        var new_obj = new_obj || {},
            set_obj = {
                get: 'tagged',
                userId: '8549024636',
                clientId: '41bf4ef0051049e69de50f4cae13d37b',
                limit: 6,
                tagName: 'maindemo',
                sortBy: 'most-liked',
                resolution: "standard_resolution",
                accessToken: '8549024636.41bf4ef.ba30cf4b6655494ea783cc934f8a44fa',
                template: '<a href="{{link}}" target="_blank"><img src="{{image}}" /></a>'
            };
        $.extend(set_obj, new_obj);
        var feed = new Instafeed(set_obj);
        feed.run();
    };
    if (blocks.ttInstafeedFluid.length) {
        blocks.ttInstafeedFluid.func_instafeed({
            limit: 6
        });
    }
    if (blocks.ttInstafeedCol.length) {
        blocks.ttInstafeedCol.func_instafeed({
            limit: 8
        });
    }
    // header, search, at focus input - result of search
    if ($ttSearchObjPopupInput.length && $ttSearchObjPopupResults.length) {
        $ttSearchObj.on("input", function (ev) {
            if ($(ev.target).val()) {
                $ttSearchObjPopupResults.fadeIn("200");
            }
        });
        $ttSearchObjPopupInput.blur(function () {
            $ttSearchObjPopupResults.fadeOut("200");
        });
    }
    if (blocks.ttPromoFixed.length) {
        setTimeout(function () {
            blocks.ttPromoFixed.fadeTo("90", 1);
        }, 2300);
        blocks.ttPromoFixed.on('click', '.tt-btn-close', function () {
            $(this).closest('.tt-promo-fixed').hide();
        });
    }
    if (blocks.sliderRevolution.length) {
        sliderRevolution();
    }
    if (blocks.ttItemsCategories.length) {
        ttItemsCategories();
    }
    if (blocks.modalAddToCart.length) {
        modalAddToCart();
    }
    // Mobile Menu
    if (blocks.mobileMenuToggle.length) {
        blocks.mobileMenuToggle.initMM({
            enable_breakpoint: true,
            mobile_button: true,
            breakpoint: 1025
        });
    }
    //header top panel
    if ($ttTopPanel.length) {
        ttTopPanel();
    }
    // add product item
    if (blocks.ttBackToTop.length) {
        ttBackToTop();
    }
    // add product item
    if (blocks.ttBtnAddProduct.length) {
        ttAddProduct();
    }
    // switching click
    if (blocks.ttOptionsSwatch.length) {
        initSwatch(blocks.ttOptionsSwatch);
    }
    // Slide Column *listing-left-column.html
    if ($ttLeftColumnAside && blocks.ttBtnColumnClose && blocks.ttBtnToggle) {
        ttToggleCol();
    }
    //countDown
    if (blocks.ttCountdown.length) {
        ttCountDown(true);
    }
    // collapseBlock
    if (blocks.ttCollapse.length) {
        ttCollapse();
    }
    //modal video on page product
    if (blocks.modalVideoProduct.length) {
        ttVideoPopup();
    }
    //tt-collapse-block(pages product single)
    if (blocks.ttCollapseBlock.length) {
        ttCollapseBlock();
    }
    //calendarDatepicker(bizblog)
    if (blocks.ttCalendarDatepicker.length) {
        blocks.ttCalendarDatepicker.datepicker();
    }
    //video(bizblog listing)
    if (blocks.ttVideoBlock.length) {
        ttVideoBlock();
    }
    // determination ie
    if (getInternetExplorerVersion() !== -1) {
        $html.addClass("ie");
    }
    // inputCounter
    if (blocks.ttInputCounter.length) {
        ttInputCounter();
    }
    // header
    initStuck();
    if ($ttDesctopParentSearch.length) {
        mobileParentSearch();
    }
    if ($ttcartObj.length) {
        mobileParentCart();
    }
    if ($ttDesctopParentAccount.length) {
        mobileParentAccount();
    }
    if ($ttDesctopParentMulti.length) {
        mobileParentMulti();
    }
    // product item Design01
    if (blocks.ttProductDesign01.length) {
        ttProductHover();
    }
    if (blocks.ttfooterMobileCollapse.length) {
        ttFooterCollapse();
    }
    // lookbook.html
    if (blocks.ttLookbook.length) {
        ttLookbook(ttwindowWidth);
    }
    // shopping_cart.html
    if (blocks.ttShopCart.length) {
        ttShopCart(ttwindowWidth);
    }
    // slider fullwidth content(*index-07.html)
    if (blocks.ttSliderFullwidth.length) {
        blocks.ttSliderFullwidth.slick({
            dots: false,
            arrows: true,
            infinite: true,
            speed: 300,
            slidesToShow: 1,
            adaptiveHeight: true
        });
    }
    // carousel brandsh content(*index-07.html)
    if (blocks.ttCarouselBrands.length) {
        blocks.ttCarouselBrands.slick({
            dots: false,
            arrows: true,
            infinite: true,
            speed: 300,
            slidesToShow: 8,
            slidesToScroll: 1,
            adaptiveHeight: true,
            responsive: [
                {
                    breakpoint: 1230,
                    settings: {
                        slidesToShow: 6,
                    }
                },
                {
                    breakpoint: 1025,
                    settings: {
                        slidesToShow: 4,
                    }
                },
                {
                    breakpoint: 790,
                    settings: {
                        slidesToShow: 3
                    }
                },
                {
                    breakpoint: 576,
                    settings: {
                        slidesToShow: 2
                    }
                },
                {
                    breakpoint: 380,
                    settings: {
                        slidesToShow: 1
                    }
                }
            ]
        });
    }
    // carusel
    if (blocks.ttCarouselProducts.length) {
        blocks.ttCarouselProducts.each(function () {
            var slick = $(this),
                item = $(this).data('item');
            slick.slick({
                dots: false,
                arrows: true,
                infinite: true,
                speed: 300,
                slidesToShow: item || 4,
                slidesToScroll: item || 4,
                adaptiveHeight: true,
                responsive: [{
                    breakpoint: 1025,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3
                    }
                },
                    {
                        breakpoint: 791,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 2
                        }
                    }]
            });
        });
    }
    // lookbook.html
    // slider
    if (blocks.ttSliderLookbook.length) {
        blocks.ttSliderLookbook.slick({
            dots: true,
            arrows: true,
            infinite: true,
            speed: 300,
            slidesToShow: 1,
            adaptiveHeight: true
        });
    }
    // carusel
    if (blocks.ttCaruselLookbook.length) {
        blocks.ttCaruselLookbook.slick({
            dots: true,
            arrows: true,
            infinite: true,
            speed: 300,
            slidesToShow: 3,
            slidesToScroll: 3,
            adaptiveHeight: true,
            responsive: [{
                breakpoint: 1025,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2
                }
            },
                {
                    breakpoint: 790,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }]
        });
    }
    //bizblog listing slider
    if (blocks.ttMobileProductSlider.length) {
        blocks.ttMobileProductSlider.slick({
            dots: false,
            arrows: true,
            infinite: true,
            speed: 300,
            slidesToShow: 1,
            adaptiveHeight: true,
            lazyLoad: 'progressive',
        });
        if ($html.hasClass('ie')) {
            blocks.ttModalQuickView.each(function () {
                blocks.ttMobileProductSlider.slick("slickSetOption", "infinite", false);
            });
        }
    }
    //slick main (* index-14.html)
    if (blocks.ttSlickMain.length) {
        blocks.ttSlickMain.slick({
            dots: true,
            arrows: true,
            infinite: true,
            speed: 300,
            slidesToShow: 1,
            adaptiveHeight: true,
            responsive: [{
                breakpoint: 1025,
                settings: {
                    dots: false,
                }
            }]
        });
    }
    //bizblog listing slider
    if (blocks.ttSliderBlog.length) {
        blocks.ttSliderBlog.slick({
            dots: false,
            arrows: true,
            infinite: true,
            speed: 300,
            slidesToShow: 1,
            adaptiveHeight: true
        });
    }
    //bizblog single post slider
    if (blocks.ttSliderBlogSingle.length) {
        blocks.ttSliderBlogSingle.slick({
            dots: false,
            arrows: false,
            infinite: true,
            speed: 300,
            slidesToShow: 1,
            adaptiveHeight: true
        });
        //total slides
        var ttSlickQuantity = $('.tt-slick-quantity');
        if (ttSlickQuantity.length) {
            ttSlickQuantity.find('.total').html(blocks.ttSliderBlogSingle.slick("getSlick").slideCount);
            blocks.ttSliderBlogSingle.on('afterChange', function (event, slick, currentSlide) {
                var currentIndex = $('.slick-current').attr('data-slick-index');
                currentIndex++;
                ttSlickQuantity.find('.account-number').html(currentIndex);
            });
        }
        //button
        var ttSlickButton = $('.tt-slick-button');
        if (ttSlickButton.length) {
            ttSlickButton.find('.slick-next').on('click', function (e) {
                blocks.ttSliderBlogSingle.slick('slickNext');
            });
            ttSlickButton.find('.slick-prev').on('click', function (e) {
                blocks.ttSliderBlogSingle.slick('slickPrev');
            });
        }
    }

    //ttOptionsSwatch
    function initSwatch($obj) {
        $obj.each(function () {
            var $this = $(this);
            $this.on('click', 'li', function () {
                $(this).addClass('active').siblings().removeClass('active');
                return false;
            });
        });
    }

    // portfolio mobile click
    if (blocks.ttPortfolioContent.length && is_touch_device()) {
        ttPortfolioContentMobile();
    }

    //ttAddProduct
    function ttAddProduct() {
        var isotopShowmoreJs = $('.tt_product_showmore .btn'),
            ttAddItem = $('.tt-product-listing');

        if (isotopShowmoreJs.length && ttAddItem.length) {
            isotopShowmoreJs.on('click', function (e) {
                e.preventDefault();
                $.ajax({
                    url: 'ajax_product.php',
                    success: function (data) {
                        var $item = $(data);
                        ttAddItem.append($item);
                        ttProductSmall();
                        adjustOffset();
                    }
                });

                function adjustOffset() {
                    var offsetLastItem = ttAddItem.children().last().children().offset().top - 80;
                    $($body, $html).animate({
                        scrollTop: offsetLastItem
                    }, 500);
                }

                return false;
            });
        }
    }

    if (blocks.ttDotsAbsolute.length) {
        ttSlickDots();
    }
    //sticky(product-05.html)
    if (blocks.ttAirSticky.length) {
        ttAirSticky(ttwindowWidth);
    }
    // header - tt-dropdown-obj
    if (blocks.ttHeaderDropdown.length) {
        ttHeaderDropdown();
    }
    // product single tt-btn-zomm(*magnific popup)
    if (blocks.ttProductSingleBtnZomm.length) {
        ttProductSingleBtnZomm();
    }
    setTimeout(function () {
        $body.addClass('loaded');
    }, 1500);
    $window.on('load', function () {
        var ttwindowWidth = window.innerWidth || $window.width();
        if ($body.length) {
            $body.addClass('loaded');
        }
        // filters options product(definition layout)
        if ($ttFilterOptions.length) {
            ttFilterLayout(ttwindowWidth);
        }
        if (blocks.ttProductItem.length) {
            ttProductSmall(ttwindowWidth);
        }
        if (blocks.ttProductDesign02.length) {
            ttOverflowProduct();
        }
        // centering arrow
        if (blocks.ttAlignmentImg.length) {
            alignmentArrowValue();
        }
        if (blocks.ttProductMasonry.length) {
            gridProductMasonr();
        }
        if (blocks.ttLookBookMasonry.length) {
            gridLookbookMasonr();
        }
        if (blocks.ttBlogMasonry.length) {
            gridGalleryMasonr();
        }
        if (blocks.ttPortfolioMasonry.length) {
            gridPortfolioMasonr();
            initPortfolioPopup();
        }
    });

    var ttCachedWidth = $window.width();
    $window.on('resize', function () {
        var newWidth = $window.width();
        if (newWidth !== ttCachedWidth) {
            ttCachedWidth = newWidth;

            var ttwindowWidth = window.innerWidth || $window.width();

            // shopping_cart.html
            if (blocks.ttShopCart.length) {
                ttShopCart(ttwindowWidth);
            }
            // filters options product(definition layout)
            if ($ttFilterOptions.length) {
                ttFilterLayout(ttwindowWidth);
            }
            if (blocks.ttProductItem.length) {
                ttProductSmall();
            }
            if (blocks.ttProductDesign02.length) {
                ttOverflowProduct();
            }
            // portfolio mobile click
            if (blocks.ttPortfolioContent.length && is_touch_device()) {
                ttPortfolioContentMobile();
            }
            //sticky(product-05.html)
            if (blocks.ttAirSticky.length) {
                ttAirSticky(ttwindowWidth);
            }
            if ($ttLeftColumnAside.hasClass('column-open') && $ttLeftColumnAside.length) {
                $ttLeftColumnAside.find('.tt-btn-col-close a').trigger('click');
            }
            //header init stuck and detach
            if ($ttDesctopParentSearch.length) {
                mobileParentSearch();
            }
            if ($ttcartObj.length) {
                mobileParentCart();
            }
            if ($ttDesctopParentAccount.length) {
                mobileParentAccount();
            }
            if ($ttDesctopParentMulti.length) {
                mobileParentMulti();
            }
            if (blocks.ttDotsAbsolute.length) {
                ttSlickDots();
            }
            // centering arrow
            if (blocks.ttAlignmentImg.length) {
                alignmentArrowValue();
            }
        }
    });
    // Functions
    var cssFix = function () {
        var u = navigator.userAgent.toLowerCase(),
            is = function (t) {
                return (u.indexOf(t) != -1)
            };
        $html.addClass([
            (!(/opera|webtv/i.test(u)) && /msie (\d)/.test(u)) ? ('ie ie' + RegExp.$1) :
                is('firefox/2') ? 'gecko ff2' :
                    is('firefox/3') ? 'gecko ff3' :
                        is('gecko/') ? 'gecko' :
                            is('opera/9') ? 'opera opera9' : /opera (\d)/.test(u) ? 'opera opera' + RegExp.$1 :
                                is('konqueror') ? 'konqueror' :
                                    is('applewebkit/') ? 'webkit safari' :
                                        is('mozilla/') ? 'gecko' : '',
            (is('x11') || is('linux')) ? ' linux' :
                is('mac') ? ' mac' :
                    is('win') ? ' win' : ''
        ].join(''));
    }();

    function ttTopPanel() {
        $ttTopPanel.on('click', function (e) {
            e.preventDefault;
            var target = e.target;
            if ($('.tt-btn-close').is(target)) {
                $(this).slideUp(200);
            }
        });
    }

    //tabs init carusel
    $('a[data-toggle="tab"]').length && $('body').on('shown.bs.tab', 'a[data-toggle="tab"]', function (e) {
        $('.slick-slider').each(function () {
            $(this).slick("getSlick").refresh();
        });
        if (blocks.ttAlignmentImg.length) {
            alignmentArrowValue();
        }
    });
    $('.modal').on('shown.bs.modal', function (e) {
        var objSlickSlider = $(this).find('.slick-slider');
        if (objSlickSlider.length) {
            objSlickSlider.each(function () {
                $(this).slick("getSlick").refresh();
            });
        }
    });

    function ttItemsCategories() {
        blocks.ttItemsCategories.on('hover', function () {
            $(this).toggleClass('active');
        });
    }

    function ttHeaderDropdown() {
        var dropdownPopup = $('.header-popup-bg');
        if (!dropdownPopup.length) {
            $body.append('<div class="header-popup-bg"></div>');
        }
        $('header').on('click', '.tt-dropdown-obj', function (e) {
            var ttwindowWidth = window.innerWidth || $window.width(),
                $this = $(this),
                target = e.target,
                objSearch = $('.tt-search'),
                objSearchInput = objSearch.find('.tt-search-input');

            // search
            if ($this.hasClass('tt-search') && $('.tt-dropdown-toggle').is(target)) {
                searchPopup();
            }

            function searchPopup() {
                $this.addClass('active');
                objSearchInput.focus();
                return false;
            }

            if (objSearch.find('.tt-btn-close').is(target)) {
                objSearchClose();
                return false;
            }

            function objSearchClose() {
                $this.removeClass('active');
                objSearchInput.blur();
                return false;
            }

            // cart, account, multi-ob
            if (!$(this).hasClass('tt-search') && $('.tt-dropdown-toggle').is(target)) {
                ttwindowWidth <= 1024 ? popupObjMobile($this) : popupObjDesctop($this);
            }

            function popupObjMobile(obj) {
                $('header').find('.tt-dropdown-obj.active').removeClass('active');
                obj.toggleClass('active').find('.tt-dropdown-menu').removeAttr("style");
                $body.toggleClass('tt-popup-dropdown');
            }

            function popupObjDesctop(obj) {
                var $this = obj,
                    target = e.target;

                if ($this.hasClass('active')) {
                    $this.toggleClass('active').find('.tt-dropdown-menu').slideToggle(200);
                    return;
                }
                $('.tt-desktop-header .tt-dropdown-obj').each(function () {
                    var $this = $(this);
                    if ($this.hasClass('active')) {
                        $this.removeClass('active').find('.tt-dropdown-menu').css("display", "none");
                    }
                });
                if ($('.tt-dropdown-toggle').is(target)) {
                    toggleDropdown($this);
                }
            }

            function toggleDropdown(obj) {
                obj.toggleClass('active').find('.tt-dropdown-menu').slideToggle(200);
            }

            $(document).mouseup(function (e) {
                var ttwindowWidth = window.innerWidth || $window.width();

                if (!$this.is(e.target) && $this.has(e.target).length === 0) {
                    $this.each(function () {
                        if ($this.hasClass('active') && $this.hasClass('tt-search')) {
                            objSearch.find('.tt-btn-close').trigger('click');
                        }
                        if ($this.hasClass('active') && !$this.hasClass('tt-search')) {
                            if (ttwindowWidth <= 1024) {
                                closeObjPopupMobile();
                            } else {
                                $('.tt-dropdown-obj').each(function () {
                                    if ($(this).hasClass('active')) {
                                        $(this).removeClass('active').find('.tt-dropdown-menu').css("display", "none");
                                    }
                                });
                            }
                        }
                    });
                }
                if ($this.find('.tt-mobile-add .tt-close').is(e.target)) {
                    closeObjPopupMobile();
                }
            });

            function closeObjPopupMobile() {
                $('.tt-dropdown-obj.active').removeClass('active');
                $body.removeClass('tt-popup-dropdown');
                return false;
            }
        });
    }

    // button back to top
    function ttBackToTop() {
        blocks.ttBackToTop.on('click', function (e) {
            $('html, body').animate({
                scrollTop: 0
            }, 500);
            return false;
        });
        $window.scroll(function () {
            $window.scrollTop() > 500 ? blocks.ttBackToTop.stop(true.false).addClass('tt-show') : blocks.ttBackToTop.stop(true.false).removeClass('tt-show');
        });
    }

    // modal Add ToCart(*close)
    function modalAddToCart() {
        blocks.modalAddToCart.on('click', '.btn-close-popup', function (e) {
            $(this).closest('.modal-content').find('.modal-header .close').trigger('click');
            return false;
        });
    }

    // Mobile footer collapse
    function ttFooterCollapse() {
        blocks.ttfooterMobileCollapse.on('click', function (e) {
            e.preventDefault;
            $(this).toggleClass('tt-open');
        });
    }

    //slick slider functional for dots
    function ttSlickDots() {
        blocks.ttDotsAbsolute.each(function () {
            var $this = $(this).find('.slick-dots');
            if ($this.is(':visible')) {
                var upperParent = $this.closest('[class ^= container]');
                if (upperParent.length) {
                    upperParent.css({'paddingBottom': parseInt($this.height(), 10) + parseInt($this.css('marginTop'), 10)});
                }
            }
        });
    }

    // product item Design01 hover (*desctope)
    function ttProductHover() {
        $document.on('mouseenter mouseleave click', '#tt-pageContent .tt-product:not(.tt-view)', function (e) {
            var $this = $(this),
                windW = window.innerWidth,
                objLiftUp01 = $this.find('.tt-description'),
                objLiftUp02 = $this.find('.tt-product-inside-hover'),
                objHeight02 = objLiftUp02.height(),
                objCountdown = $this.find('.tt-countdown_box'),
                target = e.target;

            if (e.type === 'mouseenter' && windW > 1024) {
                ttOnHover();
            } else if (e.type === 'mouseleave' && e.relatedTarget && windW > 1024) {
                ttOffHover();
            }

            function ttOnHover(e) {
                $this.stop().css({
                    height: $this.innerHeight()
                }).addClass('hovered');
                objLiftUp01.stop().animate({'top': '-' + objHeight02}, 200);
                objLiftUp02.stop().animate({'opacity': 1}, 400);
                objCountdown.stop().animate({'bottom': objHeight02}, 200);
                return false;
            }

            function ttOffHover(e) {
                $this.stop().removeClass('hovered').removeAttr('style');
                objLiftUp01.stop().animate({'top': '0'}, 200, function () {
                    $(this).removeAttr('style')
                });
                objLiftUp02.stop().animate({'opacity': 0}, 100, function () {
                    $(this).removeAttr('style')
                });
                objCountdown.stop().animate({'bottom': 0}, 200, function () {
                    $(this).removeAttr('style')
                });
                return false
            }
        });
    }

    // shopping_cart.html
    function ttShopCart(ttwindowWidth) {
        var desctopQuantity = blocks.ttShopCart.find(".detach-quantity-desctope"),
            mobileQuantity = blocks.ttShopCart.find(".detach-quantity-mobile"),
            ttBtnClose = blocks.ttShopCart.find(".tt-btn-close");

        ttwindowWidth <= 789 ? insertDesctopeObj() : insertMobileObj();

        function insertDesctopeObj() {
            var objDesctope = desctopQuantity.find('.tt-input-counter').detach().get(0);
            mobileQuantity.append(objDesctope);
        }

        function insertMobileObj() {
            var objMobile = mobileQuantity.find('.tt-input-counter').detach().get(0);
            desctopQuantity.append(objMobile);
        }
    }

    // product Small
    function ttProductSmall() {
        var currentW = parseInt(blocks.ttProductItem.width(), 10),
            objProduct = $(".tt-product, .tt-product-design02");
        currentW <= 210 ? objProduct.addClass("tt-small") : objProduct.removeClass("tt-small");
    }

    function debouncer(func, timeout) {
        var timeoutID, timeout = timeout || 500;
        return function () {
            var scope = this,
                args = arguments;
            clearTimeout(timeoutID);
            timeoutID = setTimeout(function () {
                func.apply(scope, Array.prototype.slice.call(args));
            }, timeout);
        }
    }

    // centering arrow
    function alignmentArrowValue() {
        var ttwindowWidth = window.innerWidth || $window.width();

        if (ttwindowWidth > 1024) {
            setTimeout(function () {
                blocks.ttAlignmentImg.each(function () {
                    $(this).find('.slick-arrow').removeAttr("style");
                });
            }, 225);
        } else {
            setTimeout(function () {
                blocks.ttAlignmentImg.each(function () {
                    var ttObj = $(this),
                        $objParentArrow = ttObj.find('.slick-arrow');
                    if (ttObj.find('.tt-image-box').length == 0 || $objParentArrow.length == 0) return;
                    var $obj = ttObj.find('.tt-image-box').first();
                    $objParentArrow.css({
                        'top': $obj.findHeight() - $objParentArrow.findHeight() - parseInt(ttObj.css('marginTop'), 10) + 'px'
                    });

                    ttObj.find('.tt-product').length && ttProductSmall();
                });
            }, 225);
        }
    }

    $.fn.findHeight = function () {
        var $blocks = $(this),
            maxH = $blocks.eq(0).innerHeight();

        $blocks.each(function () {
            maxH = ($(this).innerHeight() > maxH) ? $(this).innerHeight() : maxH;
        });

        return maxH / 2;
    };

    // tt-hotspot
    function ttLookbook(ttwindowWidth) {
        //add lookbook popup
        var objPopup = $('.tt-lookbook-popup');
        if (!objPopup.length) {
            $body.append('<div class="tt-lookbook-popup"><div class="tt-lookbook-container"></div></div>');
        }
        blocks.ttLookbook.on('click', '.tt-hotspot', function (e) {
            var $this = $(this),
                target = e.target,
                ttHotspot = $('.tt-hotspot'),
                ttwindowWidth = window.innerWidth || $window.width(),
                ttCenterBtn = $('.tt-btn').innerHeight() / 2,
                ttWidthPopup = $('.tt-hotspot-content').innerWidth();


            ttwindowWidth <= 789 ? ttLookbookMobile($this) : ttLookbookDesktop($this);

            //ttLookbookDesktop
            function ttLookbookDesktop($this) {

                if ($this.hasClass('active')) return;

                var objTop = $this.offset().top + ttCenterBtn,
                    objLeft = $this.offset().left,
                    objContent = $this.find('.tt-hotspot-content').detach();

                //check if an open popup
                var checkChildren = $('.tt-lookbook-container').children().size();
                if (checkChildren > 0) {
                    if (ttwindowWidth <= 789) {
                        closePopupMobile();
                    } else {
                        closePopupDesctop();
                    }
                }

                //open popup
                popupOpenDesktop(objContent, objTop, objLeft);

            }

            function popupOpenDesktop(objContent, objTop, objLeft) {
                //check out viewport(left or right)
                var halfWidth = ttwindowWidth / 2,
                    objLeftFinal = 0;

                if (halfWidth < objLeft) {
                    objLeftFinal = objLeft - ttWidthPopup - 7;
                    popupShowLeft(objLeftFinal);
                } else {
                    objLeftFinal = objLeft + 45;
                    popupShowRight(objLeftFinal);
                }
                $('.tt-lookbook-popup').find('.tt-lookbook-container').append(objContent);
                $this.addClass('active').siblings().removeClass('active');

                function popupShowLeft(objLeftFinal) {
                    $('.tt-lookbook-popup').css({
                        'top': objTop,
                        'left': objLeftFinal,
                        'display': 'block'
                    }, 300).animate({
                        marginLeft: 26 + 'px',
                        opacity: 1
                    }, 300);
                }

                function popupShowRight(objLeftFinal) {
                    $('.tt-lookbook-popup').css({
                        'top': objTop,
                        'left': objLeftFinal,
                        'display': 'block'
                    }).animate({
                        marginLeft: -26 + 'px',
                        opacity: 1
                    });
                }
            }

            //ttLookbookMobile
            function ttLookbookMobile($this) {
                var valueTop = $this.attr('data-top') + '%',
                    valueLeft = $this.attr('data-left') + '%';

                $this.find('.tt-btn').css({
                    'top': valueTop,
                    'left': valueLeft
                });
                $this.css({
                    'top': '0px',
                    'left': '0px',
                    'width': '100%',
                    'height': '100%'
                });
                $this.addClass('active').siblings().removeClass('active');
                $this.find('.tt-content-parent').fadeIn(200);
            }

            //Close mobile
            if (ttwindowWidth <= 789) {
                if ($('.tt-btn-close').is(e.target)) {
                    closePopupMobile();
                    return false;
                }
                if ($('.tt-hotspot').is(e.target)) {
                    closePopupMobile();
                }
                $(document).mouseup(function (e) {
                    if (!$('.tt-lookbook-popup').is(e.target) && $('.tt-lookbook-popup').has(e.target).length === 0 && !$('.tt-hotspot').is(e.target) && $('.tt-hotspot').has(e.target).length === 0) {
                        closePopupDesctop();
                    }
                });
            }
            //Close desctope
            if (ttwindowWidth > 789) {
                //ttLookbookClose
                $(document).mouseup(function (e) {
                    var ttwindowWidth = window.innerWidth || $window.width();
                    if ($('.tt-btn-close').is(e.target)) {
                        closePopupDesctop();
                        return false;
                    }
                    if (!$('.tt-lookbook-popup').is(e.target) && $('.tt-lookbook-popup').has(e.target).length === 0 && !$('.tt-hotspot').is(e.target) && $('.tt-hotspot').has(e.target).length === 0) {
                        closePopupDesctop();
                    }
                });
            }

            function closePopupDesctop() {
                //detach content popup
                var detachContentPopup = $('.tt-lookbook-popup').removeAttr("style").find('.tt-hotspot-content').detach();
                $('.tt-hotspot.active').removeClass('active').find('.tt-content-parent').append(detachContentPopup);
            }

            function closePopupMobile() {
                if ($('.tt-lookbook-container').is(':has(div)')) {
                    var checkPopupContent = $('.tt-lookbook-container').find('.tt-hotspot-content').detach();
                    $('.tt-hotspot.active').find('.tt-content-parent').append(checkPopupContent);
                }
                $('.tt-lookbook').find('.tt-hotspot.active').each(function (index) {
                    var $this = $(this),
                        valueTop = $this.attr('data-top') + '%',
                        valueLeft = $this.attr('data-left') + '%';

                    $this.removeClass('active').removeAttr("style").css({
                        'top': valueTop,
                        'left': valueLeft,
                    }).find('.tt-btn').removeAttr("style").next().removeAttr("style");
                });
            }

            function checkclosePopupMobile() {
                $('.tt-hotspot').find('.tt-content-parent').each(function () {
                    var $this = $(this);
                    if ($this.css('display') == 'block') {
                        var $thisParent = $this.closest('.tt-hotspot'),
                            valueTop = $thisParent.attr('data-top') + '%',
                            valueLeft = $thisParent.attr('data-left') + '%';

                        $this.removeAttr("style").prev().removeAttr("style");
                        $thisParent.removeAttr("style").css({
                            'top': valueTop,
                            'left': valueLeft,
                        });
                    }
                });
            }

            $(window).resize(debouncer(function (e) {
                var ttwindowWidth = window.innerWidth || $window.width();
                if (ttwindowWidth <= 789) {
                    closePopupMobile();
                } else {
                    closePopupDesctop();
                    checkclosePopupMobile();
                }
            }));
        });
    }

    // Overflow Product
    function ttOverflowProduct() {
        blocks.ttProductDesign02.on("mouseenter", function () {
            if (window.innerWidth < 1024 && this.hasClass('tt-view')) return;
            var objImgHeight = $(this).find('.tt-image-box').height(),
                objScroll = $(this).find('.tt-description'),
                objScrollHeight = objScroll.height() + 25,
                valueHeight01 = objScroll.find('.tt-row').height(),
                valueHeight02 = objScroll.find('.tt-title').height(),
                valueHeight03 = objScroll.find('.tt-price').height(),
                valueHeight04 = objScroll.find('.tt-option-block').height(),
                valueHeight05 = objScroll.find('.tt-product-inside-hover').height(),
                valueHeighttotal = valueHeight01 + valueHeight02 + valueHeight03 + valueHeight04 + valueHeight05 + 60;

            if (objImgHeight > valueHeighttotal) return;

            $(this).addClass('tt-small');
            objScroll.height(objImgHeight).perfectScrollbar();
        }).on('mouseleave', function () {
            if (window.innerWidth < 1024) return;
            $(this).removeClass('tt-small').find('.tt-description').removeAttr('style').perfectScrollbar('destroy');
        });
    }

    // portfolio mobile click
    function ttPortfolioContentMobile() {
        blocks.ttPortfolioContent.on('click', 'figure img', function () {
            $(this).closest(".tt-portfolio-content").find('figure').removeClass('gallery-click');
            $(this).closest("figure").addClass('gallery-click');
        });
    }

    //toggle col (listing-left-column.html)
    function ttToggleCol() {
        var $btnClose = $ttLeftColumnAside.find('.tt-btn-col-close a');

        $('.tt-btn-toggle').on('click', function (e) {
            e.preventDefault();
            var ttScrollValue = $body.scrollTop() || $html.scrollTop();
            $ttLeftColumnAside.toggleClass('column-open').perfectScrollbar();
            $body.css("top", -ttScrollValue).addClass("no-scroll").append('<div class="modal-filter"></div>');
            var modalFilter = $('.modal-filter').fadeTo('fast', 1);
            if (modalFilter.length) {
                modalFilter.on('click', function () {
                    $btnClose.trigger('click');
                })
            }
            return false;
        });
        blocks.ttBtnColumnClose.on('click', function (e) {
            e.preventDefault();
            $ttLeftColumnAside.removeClass('column-open').perfectScrollbar('destroy');
            var top = parseInt($body.css("top").replace("px", ""), 10) * -1;
            $body.removeAttr("style").removeClass("no-scroll").scrollTop(top);
            $html.removeAttr("style").scrollTop(top);
            $(".modal-filter").off().remove();
        });
    }

    // Countdown
    function ttCountDown(showZero) {
        var showZero = showZero || false;
        blocks.ttCountdown.each(function () {
            var $this = $(this),
                date = $this.data('date'),
                set_year = $this.data('year') || 'Yrs',
                set_month = $this.data('month') || 'Mths',
                set_week = $this.data('week') || 'Wk',
                set_day = $this.data('day') || 'Day',
                set_hour = $this.data('hour') || 'Hrs',
                set_minute = $this.data('minute') || 'Min',
                set_second = $this.data('second') || 'Sec';

            if (date = date.split('-')) {
                date = date.join('/');
            } else return;

            $this.countdown(date, function (e) {
                var format = '<span class="countdown-row">';

                function addFormat(func, timeNum, showZero) {
                    if (timeNum === 0 && !showZero) return;

                    func(format);
                }

                addFormat(function () {
                    format += '<span class="countdown-section">'
                        + '<span class="countdown-amount">' + e.offset.totalDays + '</span>'
                        + '<span class="countdown-period">' + set_day + '</span>'
                        + '</span>';
                }, e.offset.totalDays, showZero);

                addFormat(function () {
                    format += '<span class="countdown-section">'
                        + '<span class="countdown-amount">' + e.offset.hours + '</span>'
                        + '<span class="countdown-period">' + set_hour + '</span>'
                        + '</span>';
                }, e.offset.hours, showZero);

                addFormat(function () {
                    format += '<span class="countdown-section">'
                        + '<span class="countdown-amount">' + e.offset.minutes + '</span>'
                        + '<span class="countdown-period">' + set_minute + '</span>'
                        + '</span>';
                }, e.offset.minutes, showZero);

                addFormat(function () {
                    format += '<span class="countdown-section">'
                        + '<span class="countdown-amount">' + e.offset.seconds + '</span>'
                        + '<span class="countdown-period">' + set_second + '</span>'
                        + '</span>';
                }, e.offset.seconds, showZero);

                format += '</span>';

                $(this).html(format);
            });
        });
    }

    function ttCollapseBlock() {
        blocks.ttCollapseBlock.each(function () {
            var obj = $(this),
                objOpen = obj.find('.tt-item.active'),
                objItemTitle = obj.find('.tt-item .tt-collapse-title');

            objOpen.find('.tt-collapse-content').slideToggle(200);

            objItemTitle.on('click', function () {
                $(this).next().slideToggle(200).parent().toggleClass('active');
            });
        });
    }

    function getInternetExplorerVersion() {
        var rv = -1;
        if (navigator.appName === 'Microsoft Internet Explorer') {
            var ua = navigator.userAgent;
            var re = new RegExp("MSIE ([0-9]{1,}[\.0-9]{0,})");
            if (re.exec(ua) != null)
                rv = parseFloat(RegExp.$1);
        } else if (navigator.appName === 'Netscape') {
            var ua = navigator.userAgent;
            var re = new RegExp("Trident/.*rv:([0-9]{1,}[\.0-9]{0,})");
            if (re.exec(ua) != null)
                rv = parseFloat(RegExp.$1);
        }
        return rv;
    }

    // identify touch device
    function is_touch_device() {
        return !!('ontouchstart' in window) || !!('onmsgesturechange' in window);
    }

    if (is_touch_device()) {
        $body.addClass('touch-device');
        $html.addClass('touch-device');
    }
    if (/Edge/.test(navigator.userAgent)) {
        $html.addClass('edge');
    }

    //video
    function ttVideoBlock() {
        $('.tt-video-block').on('click', function (e) {
            e.preventDefault();
            var myVideo = $(this).find('.movie')[0];
            if (myVideo.paused) {
                myVideo.play();
                $(this).addClass('play');
            } else {
                myVideo.pause();
                $(this).removeClass('play');
            }
        });
    }

    // Blog Masonr
    function gridGalleryMasonr() {
        // init Isotope
        var $grid = blocks.ttBlogMasonry.find('.tt-bizblog-init').isotope({
            itemSelector: '.element-item',
            layoutMode: 'masonry',
        });
        // layout Isotope after each image loads
        $grid.imagesLoaded().progress(function () {
            $grid.isotope('layout').addClass('tt-show');
        });
        // filter functions
        var ttFilterNav = blocks.ttBlogMasonry.find('.tt-filter-nav');
        if (ttFilterNav.length) {
            var filterFns = {
                ium: function () {
                    var name = $(this).find('.name').text();
                    return name.match(/ium$/);
                }
            };
            // bind filter button click
            ttFilterNav.on('click', '.button', function () {
                var filterValue = $(this).attr('data-filter');
                filterValue = filterFns[filterValue] || filterValue;
                $grid.isotope({
                    filter: filterValue
                });
                $(this).addClass('active').siblings().removeClass('active');
            });
        }
        var isotopShowmoreJs = $('.isotop_showmore_js .btn'),
            ttAddItem = $('.tt-add-item');
        if (isotopShowmoreJs.length && ttAddItem.length) {
            isotopShowmoreJs.on('click', function (e) {
                e.preventDefault();
                $.ajax({
                    url: 'ajax_post.php',
                    success: function (data) {
                        var $item = $(data);
                        ttAddItem.append($item);
                        $grid.isotope('appended', $item);
                        adjustOffset();
                    }
                });

                function adjustOffset() {
                    var offsetLastItem = ttAddItem.children().last().children().offset().top - 180;
                    $($body, $html).animate({
                        scrollTop: offsetLastItem
                    }, 500);
                }

                return false;
            });
        }
    }

    // Product Masonr (listing-metro.html)
    function gridProductMasonr() {
        // init Isotope
        var $grid = blocks.ttProductMasonry.find('.tt-product-init').isotope({
            itemSelector: '.element-item',
            layoutMode: 'masonry',
        });
        // layout Isotope after each image loads
        $grid.imagesLoaded().progress(function () {
            $grid.isotope('layout');
        });
        // filter functions
        var ttFilterNav = blocks.ttProductMasonry.find('.tt-filter-nav');
        if (ttFilterNav.length) {
            var filterFns = {
                ium: function () {
                    var name = $(this).find('.name').text();
                    return name.match(/ium$/);
                }
            };
            // bind filter button click
            ttFilterNav.on('click', '.button', function () {
                var filterValue = $(this).attr('data-filter');
                filterValue = filterFns[filterValue] || filterValue;
                $grid.isotope({
                    filter: filterValue
                });
                $(this).addClass('active').siblings().removeClass('active');
            });
        }
        //add item
        var isotopShowmoreJs = $('.isotop_showmore_js .btn'),
            ttAddItem = $('.tt-add-item');
        if (isotopShowmoreJs.length && ttAddItem.length) {
            isotopShowmoreJs.on('click', function (e) {
                e.preventDefault();
                $.ajax({
                    url: 'ajax_product_metro.php',
                    success: function (data) {
                        var $item = $(data);
                        ttAddItem.append($item);
                        $grid.isotope('appended', $item);
                        ttProductSmall();
                        adjustOffset();
                    }
                });

                function adjustOffset() {
                    var offsetLastItem = ttAddItem.children().last().children().offset().top - 80;
                    $($body, $html).animate({
                        scrollTop: offsetLastItem
                    }, 500);
                }

                return false;
            });
        }
    }

    // Lookbook Masonr
    function gridLookbookMasonr() {
        // init Isotope
        var $grid = blocks.ttLookBookMasonry.find('.tt-lookbook-init').isotope({
            itemSelector: '.element-item',
            layoutMode: 'masonry',
            gutter: 0
        });
        // layout Isotope after each image loads
        $grid.imagesLoaded().progress(function () {
            $grid.addClass('tt-show').isotope('layout');
        });
        //add item
        var isotopShowmoreJs = $('.isotop_showmore_js .btn'),
            ttAddItem = $('.tt-add-item');
        if (isotopShowmoreJs.length && ttAddItem.length) {
            isotopShowmoreJs.on('click', function (e) {
                e.preventDefault();
                $.ajax({
                    url: 'ajax_post.php',
                    success: function (data) {
                        var $item = $(data);
                        ttAddItem.append($item);
                        $grid.isotope('appended', $item);
                        adjustOffset();
                    }
                });

                function adjustOffset() {
                    var offsetLastItem = ttAddItem.children().last().children().offset().top - 180;
                    $($body, $html).animate({
                        scrollTop: offsetLastItem
                    }, 500);
                }

                return false;
            });
        }
    }

    // collapseBlock(pages listing) *listing-left-column.html
    function ttCollapse() {
        var item = blocks.ttCollapse,
            itemTitle = item.find('.tt-collapse-title'),
            itemContent = item.find('.tt-collapse-content');

        item.each(function () {
            if ($(this).hasClass('open')) {
                $(this).find(itemContent).slideDown();
            } else {
                $(this).find(itemContent).slideUp();
            }
        });
        itemTitle.on('click', function (e) {
            e.preventDefault();
            var speed = 300;
            var thisParent = $(this).parent(),
                nextLevel = $(this).next('.tt-collapse-content');
            if (thisParent.hasClass('open')) {
                thisParent.removeClass('open');
                nextLevel.slideUp(speed);
            } else {
                thisParent.addClass('open');
                nextLevel.slideDown(speed);
            }
        })
    }

    // ttFiltersOptions
    (function ($) {
        $.fn.removeClassFirstPart = function (mask) {
            return this.removeClass(function (index, cls) {
                var re = mask.replace(/\*/g, '\\S+');
                return (cls.match(new RegExp('\\b' + re + '', 'g')) || []).join(' ');
            });
        };
    })(jQuery);

    function ttFilterLayout(ttwindowWidth) {

        // detach filter aside left
        if ($ttFilterOptions.hasClass('desctop-no-sidebar') && !$ttFilterOptions.hasClass('filters-detach-mobile')) {
            ttwindowWidth <= 1024 ? insertMobileCol() : insertFilter();
        }
        if ($ttFilterOptions.hasClass('filters-detach-mobile')) {
            ttwindowWidth <= 1024 ? insertMobileCol() : insertFilter();
        }
        if (!$ttFilterOptions.hasClass('desctop-no-sidebar')) {
            ttwindowWidth <= 1024 ? insertMobileCol() : insertFilter();
        }

        function insertMobileCol() {
            var objFilterOptions = blocks.ttFilterSort.find('select').detach();
            blocks.ttFilterDetachOption.find('.filters-row-select').append(objFilterOptions);
        }

        function insertFilter() {
            var objColFilterOptions = blocks.ttFilterDetachOption.find('.filters-row-select select').detach();
            blocks.ttFilterSort.append(objColFilterOptions);
        }

        //active filter detection
        blocks.ttProductListing.removeClassFirstPart("tt-col-*");

        var ttQuantity = $ttFilterOptions.find('.tt-quantity'),
            ttProductItem = blocks.ttProductListing.find('.tt-col-item:first'),
            ttProductItemValue = (function () {
                if (ttQuantity.length && !ttQuantity.hasClass('tt-disabled')) {
                    var ttValue = parseInt(ttProductItem.css("flex").replace("0 0", "").replace("%", ""), 10) || parseInt(ttProductItem.css("max-width"), 10);
                    return ttValue;
                }
            }()),
            ttGridSwitch = $ttFilterOptions.find('.tt-grid-switch');


        if (ttProductItemValue == 16) {
            ttСhangeclass(ttQuantity, '.tt-col-six');
        } else if (ttProductItemValue == 25) {
            ttСhangeclass(ttQuantity, '.tt-col-four');
        } else if (ttProductItemValue == 33) {
            ttСhangeclass(ttQuantity, '.tt-col-three');
        } else if (ttProductItemValue == 50) {
            ttСhangeclass(ttQuantity, '.tt-col-two');
        } else if (ttProductItemValue == 100) {
            ttСhangeclass(ttQuantity, '.tt-col-one');
        }

        function ttСhangeclass(ttObj, ttObjvalue) {
            ttObj.find(ttObjvalue).addClass('active').siblings().removeClass('active');
            ttwindowWidth <= 1024 ? ttShowIconMobile(ttObj, ttObjvalue) : ttShowIconDesctop(ttObj, ttObjvalue);
        }

        function ttShowIconDesctop(ttObj, ttObjvalue) {

            ttObj.find('.tt-show').removeClass('tt-show');
            ttObj.find('.tt-show-siblings').removeClass('tt-show-siblings');

            var $this = ttObj.find(ttObjvalue);
            $this.addClass('tt-show');

            $this.next().addClass('tt-show-siblings');
            $this.prev().addClass('tt-show-siblings');
            var quantitySiblings = $('.tt-quantity .tt-show-siblings').length;
            if (quantitySiblings === 1) {
                ttObj.find('.tt-show-siblings').prev().addClass('tt-show-siblings');
            }
        }

        function ttShowIconMobile(ttObj, ttObjvalue) {
            ttObj.find('.tt-show').removeClass('tt-show');
            ttObj.find('.tt-show-siblings').removeClass('tt-show-siblings');

            var $this = ttObj.find(ttObjvalue);
            $this.addClass('tt-show');
            $this.prev().addClass('tt-show-siblings');
        }

        //click buttons filter
        ttQuantity.on('click', 'a', function (e) {
            e.preventDefault();
            if (ttQuantity.hasClass('tt-disabled')) {
                blocks.ttProductListing.removeClass('tt-row-view').find('.tt-col-item > div').removeClass('tt-view');
                ttQuantity.removeClass('tt-disabled');
                ttGridSwitch.removeClass('active');
                ttOverflowProduct();
            }
            ttQuantity.find('a').removeClass('active');
            var ttActiveValue = $(this).addClass('active').attr('data-value');
            blocks.ttProductListing.removeClassFirstPart("tt-col-*").addClass(ttActiveValue);
            ttProductSmall();
        });
    }

    $ttFilterOptions.find('.tt-grid-switch').on('click', function (e) {
        e.preventDefault();
        $(this).toggleClass('active');
        blocks.ttProductListing.toggleClass('tt-row-view').find('.tt-col-item > div').toggleClass('tt-view');
        $ttFilterOptions.find('.tt-quantity').toggleClass('tt-disabled');
    });

    // Portfolio
    function gridPortfolioMasonr() {
        // init Isotope
        var $grid = blocks.ttPortfolioMasonry.find('.tt-portfolio-content').isotope({
            itemSelector: '.element-item',
            layoutMode: 'masonry',
        });
        // layout Isotope after each image loads
        $grid.imagesLoaded().progress(function () {
            $grid.isotope('layout').addClass('tt-show');
        });
        // filter functions
        var ttFilterNav = blocks.ttPortfolioMasonry.find('.tt-filter-nav');
        if (ttFilterNav.length) {
            var filterFns = {
                ium: function () {
                    var name = $(this).find('.name').text();
                    return name.match(/ium$/);
                }
            };
            // bind filter button click
            ttFilterNav.on('click', '.button', function () {
                var filterValue = $(this).attr('data-filter');
                filterValue = filterFns[filterValue] || filterValue;
                $grid.isotope({
                    filter: filterValue
                });
                $(this).addClass('active').siblings().removeClass('active');
            });
        }
        //add item
        var isotopShowmoreJs = $('.isotop_showmore_js .btn'),
            ttAddItem = $('.tt-add-item');
        if (isotopShowmoreJs.length && ttAddItem.length) {
            isotopShowmoreJs.on('click', function (e) {
                e.preventDefault();
                $.ajax({
                    url: 'ajax_portfolio.php',
                    success: function (data) {
                        var $item = $(data);
                        ttAddItem.append($item);
                        $grid.isotope('appended', $item);
                        initPortfolioPopup();
                        adjustOffset();
                    }
                });

                function adjustOffset() {
                    var offsetLastItem = ttAddItem.children().last().children().offset().top - 180;
                    $($body, $html).animate({
                        scrollTop: offsetLastItem
                    }, 500);
                }

                return false;
            });
        }
    }

    function initPortfolioPopup() {
        var objZoom = $ttPageContent.find('.tt-portfolio-masonry .tt-btn-zomm');
        objZoom.magnificPopup({
            type: 'image',
            gallery: {
                enabled: true
            }
        });
    }

    //input-counter
    function ttInputCounter() {
        blocks.ttInputCounter.find('.minus-btn, .plus-btn').on('click', function (e) {
            var $input = $(this).parent().find('input');
            var count = parseInt($input.val(), 10) + parseInt(e.currentTarget.className === 'plus-btn' ? 1 : -1, 10);
            $input.val(count).change();
        });
        blocks.ttInputCounter.find("input").change(function () {
            var _ = $(this);
            var min = 1;
            var val = parseInt(_.val(), 10);
            var max = parseInt(_.attr('size'), 10);
            val = Math.min(val, max);
            val = Math.max(val, min);
            _.val(val);
        })
            .on("keypress", function (e) {
                if (e.keyCode === 13) {
                    e.preventDefault();
                }
            });
    }

    //popup on pages product single
    function ttVideoPopup() {
        blocks.modalVideoProduct.on('show.bs.modal', function (e) {
            var relatedTarget = $(e.relatedTarget),
                attr = relatedTarget.attr('data-value'),
                attrPoster = relatedTarget.attr('data-poster'),
                attrType = relatedTarget.attr('data-type');

            if (attrType === "youtube" || attrType === "vimeo" || attrType === undefined) {
                $('<iframe src="' + attr + '" allowfullscreen></iframe>').appendTo($(this).find('.modal-video-content'));
            }
            if (attrType === "video") {
                $('<div class="tt-video-block"><a href="#" class="link-video"></a><video class="movie" src="' + attr + '" poster="' + attrPoster + '" allowfullscreen></video></div>').appendTo($(this).find('.modal-video-content'));

            }
            ttVideoBlock();
        }).on('hidden.bs.modal', function () {
            $(this).find('.modal-video-content').empty();
        });
    }

    //product pages
    var elevateZoomWidget = {
        scroll_zoom: true,
        class_name: '.zoom-product',
        thumb_parent: $('#smallGallery'),
        scrollslider_parent: $('.slider-scroll-product'),
        checkNoZoom: function () {
            return $(this.class_name).parent().parent().hasClass('no-zoom');
        },
        init: function (type) {
            var _ = this;
            var currentW = window.innerWidth || $(window).width();
            var zoom_image = $(_.class_name);
            var _thumbs = _.thumb_parent;
            _.initBigGalleryButtons();
            _.scrollSlider();

            if (zoom_image.length == 0) return false;
            if (!_.checkNoZoom()) {
                var attr_scroll = zoom_image.parent().parent().attr('data-scrollzoom');
                attr_scroll = attr_scroll ? attr_scroll : _.scroll_zoom;
                _.scroll_zoom = attr_scroll == 'false' ? false : true;
                currentW > 575 && _.configureZoomImage();
                _.resize();
            }

            if (_thumbs.length == 0) return false;
            var thumb_type = _thumbs.parent().attr('class').indexOf('-vertical') > -1 ? 'vertical' : 'horizontal';
            _[thumb_type](_thumbs);
            _.setBigImage(_thumbs);
        },
        configureZoomImage: function () {
            var _ = this;
            $('.zoomContainer').remove();
            var zoom_image = $(this.class_name);
            zoom_image.each(function () {
                var _this = $(this);
                var clone = _this.removeData('elevateZoom').clone();
                _this.after(clone).remove();
            });
            setTimeout(function () {
                $(_.class_name).elevateZoom({
                    gallery: _.thumb_parent.attr('id'),
                    zoomType: "inner",
                    scrollZoom: Boolean(_.scroll_zoom),
                    cursor: "crosshair",
                    zoomWindowFadeIn: 300,
                    zoomWindowFadeOut: 300
                });
            }, 100);
        },
        resize: function () {
            var _ = this;
            $(window).resize(function () {
                var currentW = window.innerWidth || $(window).width();
                if (currentW <= 575) return false;
                _.configureZoomImage();
            });
        },
        horizontal: function (_parent) {
            _parent.slick({
                infinite: true,
                dots: false,
                arrows: true,
                slidesToShow: 6,
                slidesToScroll: 1,
                responsive: [{
                    breakpoint: 1200,
                    settings: {
                        slidesToShow: 4,
                        slidesToScroll: 1
                    }
                },
                    {
                        breakpoint: 992,
                        settings: {
                            slidesToShow: 4,
                            slidesToScroll: 1
                        }
                    }]
            });
        },
        vertical: function (_parent) {
            _parent.slick({
                vertical: true,
                infinite: true,
                slidesToShow: 5,
                slidesToScroll: 1,
                verticalSwiping: true,
                arrows: true,
                dots: false,
                centerPadding: "0px",
                customPaging: "0px",
                responsive: [{
                    breakpoint: 1200,
                    settings: {
                        slidesToShow: 5,
                        slidesToScroll: 1
                    }
                },
                    {
                        breakpoint: 992,
                        settings: {
                            slidesToShow: 5,
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 5,
                            slidesToScroll: 1
                        }
                    }]
            });
        },
        initBigGalleryButtons: function () {
            var bigGallery = $('.bigGallery');
            if (bigGallery.length == 0) return false;
            $('body').on('mouseenter', '.zoomContainer',
                function () {
                    bigGallery.find('button').addClass('show');
                }
            ).on('mouseleave', '.zoomContainer',
                function () {
                    bigGallery.find('button').removeClass('show');
                }
            );
        },
        scrollSlider: function () {
            var _scrollslider_parent = this.scrollslider_parent;
            if (_scrollslider_parent.length == 0) return false;
            _scrollslider_parent.on('init', function (event, slick) {
                _scrollslider_parent.css({'opacity': 1});
            });
            _scrollslider_parent.css({'opacity': 0}).slick({
                infinite: false,
                vertical: true,
                verticalScrolling: true,
                dots: true,
                arrows: false,
                slidesToShow: 1,
                slidesToScroll: 1,
                responsive: [{
                    breakpoint: 1200,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                },
                    {
                        breakpoint: 992,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                    }]
            }).mousewheel(function (e) {
                e.preventDefault();
                e.deltaY < 0 ? $(this).slick('slickNext') : $(this).slick('slickPrev');
            });
        },
        setBigImage: function (_parent) {
            var _ = this;
            _parent.find('a').on('click', function (e) {
                _.checkNoZoom() && e.preventDefault();
                var zoom_image = $(_.class_name);
                var getParam = _.checkNoZoom() ? 'data-image' : 'data-zoom-image';
                var setParam = _.checkNoZoom() ? 'src' : 'data-zoom-image';
                var big_image = $(this).attr(getParam);
                zoom_image.attr(setParam, big_image);

                if (!_.checkNoZoom()) return false;
                _parent.find('.zoomGalleryActive').removeClass('zoomGalleryActive');
                $(this).addClass('zoomGalleryActive');
            });
        }
    };
    elevateZoomWidget.init();

    // product single tt-btn-zomm(*magnific popup)
    function ttProductSingleBtnZomm() {
        $body.on('click', '.tt-product-single-img .tt-btn-zomm', function (e) {
            var objSmallGallery = $('#smallGallery');
            objSmallGallery.find('a').each(function () {
                var dataZoomImg = $(this).attr('data-zoom-image');
                if (dataZoomImg.length) {
                    $(this).closest('li').append("<a class='link-magnific-popup' href='#'></a>").find('.link-magnific-popup').attr('href', dataZoomImg);
                    if ($(this).hasClass('zoomGalleryActive')) {
                        $(this).closest('li').find('.link-magnific-popup').addClass('zoomGalleryActive');
                    }
                }
            });
            objSmallGallery.addClass('tt-magnific-popup').find('.link-magnific-popup').magnificPopup({
                type: 'image',
                gallery: {
                    enabled: true,
                    tCounter: '<span class="mfp-counter"></span>'
                },
                callbacks: {
                    close: function () {
                        setTimeout(function () {
                            objSmallGallery.removeClass('tt-magnific-popup').find('.link-magnific-popup').remove();
                        }, 200);

                    }
                }
            });
            objSmallGallery.find('.link-magnific-popup.zoomGalleryActive').trigger('click');
        });
    }

    //sticky(product-05.html)
    function ttAirSticky(ttwindowWidth) {
        var airStickyObj = blocks.ttAirSticky,
            tabObj = blocks.ttCollapseBlock.find('.tt-collapse-title');

        if (ttwindowWidth >= 789) {
            airStickyObj.airStickyBlock({
                debug: false,
                stopBlock: '.airSticky_stop-block',
                offsetTop: 70,
            });
        } else if (airStickyObj.hasClass('airSticky_absolute')) {
            airStickyObj.removeClass('airSticky_absolute');
        }
        $document.on('resize scroll', tabObj, function () {
            airStickyObj.trigger('render.airStickyBlock');
        });
        tabObj.on('click', function () {
            setTimeout(function () {
                airStickyObj.trigger('render.airStickyBlock');
            }, 170);
        });
    }

    /**
     * Stuck init. Properties: on/off
     * @value = 'off', default empty
     */
    function initStuck(value) {
        if ($stucknav.hasClass('disabled')) return;

        var value = value || false,
            ie = (getInternetExplorerVersion() !== -1) ? true : false;

        if (value === 'off') return false;
        var n = 0;
        $window.scroll(function () {
            var HeaderTop = $('header').innerHeight();
            if ($window.scrollTop() > HeaderTop) {
                if ($stucknav.hasClass('stuck')) return false;
                $stucknav.hide();
                $stucknav.addClass('stuck');
                window.innerWidth < 1025 ? $ttStuckParentMenu.append($ttMobileParentMenuChildren.detach()) : $ttStuckParentMenu.append($ttDesctopMenu.detach());
                $ttStuckParentCart.append($ttcartObj.detach());
                $ttStuckParentMulti.append($ttMultiObj.detach());
                $ttStuckParentAccount.append($ttAccountObj.detach());
                $ttStuckParentSearch.append($ttSearchObj.detach());


                if ($stucknav.find('.tt-stuck-cart-parent > .tt-cart > .dropdown').hasClass('open') || ie)
                    $stucknav.stop().show();
                else
                    $stucknav.stop().fadeIn(300);

            } else {
                if (!$stucknav.hasClass('stuck')) return false;
                $stucknav.hide();
                $stucknav.removeClass('stuck');
                if (window.innerWidth < 1025) {
                    $ttMobileParentMenu.append($ttMobileParentMenuChildren.detach());
                    $ttMobileParentCart.append($ttcartObj.detach());
                    $ttMobileParentMulti.append($ttMultiObj.detach());
                    $ttMobileParentAccount.append($ttAccountObj.detach());
                    $ttMobileParentSearch.append($ttSearchObj.detach());
                    return false;
                }
                $ttDesctopParentMenu.append($ttDesctopMenu.detach());
                $ttDesctopParentCart.append($ttcartObj.detach());
                $ttDesctopParentMulti.append($ttMultiObj.detach());
                $ttDesctopParentAccount.append($ttAccountObj.detach());
                $ttDesctopParentSearch.append($ttSearchObj.detach());
            }
        });
        $window.resize(function () {
            if (!$stucknav.hasClass('stuck')) return false;
            if (window.innerWidth < 1025) {
                $ttDesctopParentMenu.append($ttDesctopMenu.detach());
                $ttStuckParentMenu.append($ttMobileParentMenuChildren.detach());
            } else {
                $ttMobileParentMenu.append($ttMobileParentMenuChildren.detach());
                $ttStuckParentMenu.append($ttDesctopMenu.detach());
            }
        });
    }

    //header search
    function mobileParentSearch() {
        if (window.innerWidth < 1025) {
            if ($ttMobileParentSearch.children().lenght) return false;
            if ($('.stuck').length) return false;
            $ttMobileParentSearch.append($ttSearchObj.detach());
        } else {
            if ($ttDesctopParentSearch.children().lenght) return false;
            if ($('.stuck').length) return false;
            $ttDesctopParentSearch.append($ttSearchObj.detach());
        }
    }

    //header cart
    function mobileParentCart() {
        if (window.innerWidth < 1025) {
            if ($ttMobileParentCart.children().lenght) return false;
            if ($('.stuck').length) return false;
            $ttMobileParentCart.append($ttcartObj.detach());
        } else {
            if ($ttDesctopParentCart.children().lenght) return false;
            if ($('.stuck').length) return false;
            $ttDesctopParentCart.append($ttcartObj.detach());
        }
    }

    //header account
    function mobileParentAccount() {
        if (window.innerWidth < 1025) {
            if ($ttMobileParentAccount.children().lenght) return false;
            if ($('.stuck').length) return false;
            $ttMobileParentAccount.append($ttAccountObj.detach());
        } else {
            if ($ttDesctopParentAccount.children().lenght) return false;
            if ($('.stuck').length) return false;
            $ttDesctopParentAccount.append($ttAccountObj.detach());
        }
    }

    //header langue and currency(*all in one module)
    function mobileParentMulti() {
        if (window.innerWidth < 1025) {
            if ($ttMobileParentMulti.children().lenght) return false;
            if ($('.stuck').length) return false;
            $ttMobileParentMulti.append($ttMultiObj.detach());
        } else {
            if ($ttDesctopParentMulti.children().lenght) return false;
            if ($('.stuck').length) return false;
            $ttDesctopParentMulti.append($ttMultiObj.detach());
        }
    }

    /*
      header menu
    */
    // header menu(hover)
    (function toggle_header_menu() {
        var delay = header_menu_timeout,
            hoverTimer = header_menu_delay,
            timeout1 = false;

        var set_dropdown_maxH = function () {
            var wind_H = window.innerHeight,
                $ttDesctopMenu = $(this).find('.dropdown-menu'),
                menu_top = $ttDesctopMenu.get(0).getBoundingClientRect().top,
                menu_max_H = wind_H - menu_top,
                $ttDesctopMenu_H = $ttDesctopMenu.innerHeight(),
                $btn_top = blocks.ttBackToTop;

            if ($ttDesctopMenu_H > menu_max_H) {
                var $body = $('body'),
                    $stuck = $('.stuck-nav');
                $ttDesctopMenu.css({
                    maxHeight: menu_max_H - 20,
                    overflow: 'auto'
                });

                var scrollWidth = function () {
                    var $div = $('<div>').css({
                        overflowY: 'scroll',
                        width: '50px',
                        height: '50px',
                        visibility: 'hidden'
                    });

                    $body.append($div);
                    var scrollWidth = $div.get(0).offsetWidth - $div.get(0).clientWidth;
                    $div.remove();

                    return scrollWidth;
                };

                $body.css({
                    overflowY: 'hidden',
                    paddingRight: scrollWidth()
                });

                $stuck.css({
                    paddingRight: scrollWidth()
                });

                $btn_top.css({
                    right: scrollWidth()
                });
            }
        };

        if ($ttDesctopMenu.length > 0) {
            $('.tt-megamenu-submenu li a').each(function () {
                if ($(this).find('img').length) {
                    $(this).closest('ul').addClass('tt-sub-img');
                }
            });

            $ttDesctopMenu.find('.dropdown-menu').each(function () {
                if ($(this).length) {
                    $(this).closest('.dropdown').addClass('tt-submenu');
                }
            });

            $(document).on({
                mouseenter: function () {

                    var $this = $(this),
                        that = this,
                        windowW = window.innerWidth || $(window).width();

                    if (windowW > 1025 && $body.hasClass('touch-device')) {
                        $ttDesctopMenu.find('.dropdown.tt-submenu > a').one("click", false);
                    }
                    timeout1 = setTimeout(function () {

                        var $carousel = $this.find('.tt-menu-slider'),
                            $ttDesctopMenu = $this.find('.dropdown-menu');


                        $this.addClass('active')
                            .find(".dropdown-menu")
                            .stop()
                            .addClass('hover')
                            .fadeIn(hoverTimer);

                        if ($ttDesctopMenu.length & !$ttDesctopMenu.hasClass('one-col')) {
                            set_dropdown_maxH.call(that);
                        }

                        if ($carousel.length) {
                            if (!$carousel.hasClass('slick-initialized')) {
                                $carousel.slick({
                                    dots: false,
                                    arrows: true,
                                    infinite: true,
                                    speed: 300,
                                    slidesToShow: 2,
                                    slidesToScroll: 2,
                                    adaptiveHeight: true
                                });
                            }
                        }
                        $carousel.slick('setPosition');

                    }, delay);

                },
                mouseleave: function (e) {
                    var $this = $(this),
                        $dropdown = $this.find(".dropdown-menu");

                    if ($(e.target).parents('.dropdown-menu').length && !$(e.target).parents('.tt-megamenu-submenu').length && !$(e.target).parents('.one-col').length) return;

                    if (timeout1 !== false) {
                        clearTimeout(timeout1);
                        timeout1 = false;
                    }

                    if ($dropdown.length) {
                        $dropdown.stop().fadeOut({
                            duration: 0, complete: function () {
                                $this.removeClass('active')
                                    .find(".dropdown-menu")
                                    .removeClass('hover');
                            }
                        });
                    } else {
                        $this.removeClass('active')
                            .find(".dropdown-menu")
                            .removeClass('hover');
                    }

                    $dropdown.removeAttr('style');

                    $body.removeAttr('style');

                    $('.stuck-nav').css({
                        paddingRight: 'inherit'
                    });

                    blocks.ttBackToTop.css({
                        right: 0
                    });
                }
            }, '.tt-desctop-menu li');

            $('.multicolumn ul li').on('hover', function () {
                var $ul = $(this).find('ul:first');

                if ($ul.length) {
                    var windW = window.innerWidth,
                        windH = window.innerHeight,
                        ulW = parseInt($ul.css('width'), 10),
                        thisR = this.getBoundingClientRect().right,
                        thisL = this.getBoundingClientRect().left;

                    if (windW - thisR < ulW) {
                        $ul.removeClass('left').addClass('right');
                    } else if (thisL < ulW) {
                        $ul.removeClass('right').addClass('left');
                    } else {
                        $ul.removeClass('left right');
                    }
                    $ul.stop(true, true).fadeIn(300);
                }
            }, function () {
                $(this).find('ul:first').stop(true, true).fadeOut(300).removeAttr('style');
            });


            $('.tt-megamenu-submenu li').on("mouseenter", function () {
                var $ul = $(this).find('ul:first');
                if ($ul.length) {
                    var $dropdownMenu = $(this).parents('.dropdown').find('.dropdown-menu'),
                        dropdown_left = $dropdownMenu.get(0).getBoundingClientRect().left,
                        dropdown_Right = $dropdownMenu.get(0).getBoundingClientRect().right,
                        dropdown_Bottom = $dropdownMenu.get(0).getBoundingClientRect().bottom,
                        ulW = parseInt($ul.css('width'), 10),
                        thisR = this.getBoundingClientRect().right,
                        thisL = this.getBoundingClientRect().left;

                    if (dropdown_Right - 20 - thisR < ulW) {
                        $ul.removeClass('left').addClass('right');
                    } else if (thisL - ulW - 20 < dropdown_left) {
                        $ul.removeClass('right').addClass('left');
                    } else {
                        $ul.removeClass('left right');
                    }

                    $ul.stop(true, true).delay(150).fadeIn(300);

                    var ul_bottom = $ul.get(0).getBoundingClientRect().bottom;

                    if (dropdown_Bottom < ul_bottom) {
                        var move_top = dropdown_Bottom - ul_bottom;
                        $ul.css({
                            top: move_top
                        });
                    }
                }
            }).on('mouseleave', function () {
                $(this).find('ul:first').stop(true, true).fadeOut(300).removeAttr('style');
            });

            $('.dropdown div').on('hover', function () {
                $(this).children('.tt-title-submenu').toggleClass('active');
            });

        }

        function onscroll_dropdown_hover() {
            var $dropdown_active = $('.dropdown.hover');

            if (!$dropdown_active.find('.dropdown-menu').not('.one-col').length) return;

            if ($dropdown_active.length)
                set_dropdown_maxH.call($dropdown_active);
        }

        $(window).on('scroll', function () {
            onscroll_dropdown_hover();
        });
    })();

    //REVOLUTION SLIDER (function to reset the plug on the breakpoints)
    function sliderRevolution() {
        function click_to_play_video() {
            var $this = $(this),
                $video = $this.find('li video');

            if (!$video.length) return;

            $video.on('play', function () {
                var $btn = $(this).parents('li').find('.video-play');

                $btn.addClass('pause');
                $(this).parents('.tp-caption.fullscreenvideo').addClass('click-video');
            });

            $video.on('pause ended', function () {
                var $btn = $(this).parents('li').find('.video-play');

                $btn.removeClass('pause');
            });

            $this.find('.video-play').on('click', function (e) {
                var $video = $(this).parents('li').find('video');

                $video.trigger('click');
                e.preventDefault();
                e.stopPropagation();
                return false;
            });

            $this.on('revolution.slide.onbeforeswap', function (event, data) {
                $(this).find('.tp-caption.fullscreenvideo').removeClass('click-video');
            });
        }

        function autoplay_video(elem) {
            var $get_sliders = $(this);

            $get_sliders.each(function () {
                var $slider = $(this);

                var set_event = function () {
                    $slider.on('revolution.slide.onchange', function (event, data) {
                        var $this = $(this),
                            $active_slide = $this.find('li').eq(data.slideIndex - 1),
                            $video = $active_slide.find('video'),
                            autoplay = $active_slide.find('.tp-caption').attr('data-autoplay');

                        if ($video.length && autoplay === 'true') {
                            var video = $video.get(0);

                            video.currentTime = 0;

                            $slider.one('revolution.slide.onafterswap', function (event, data) {
                                if (video.paused) {
                                    video.play();
                                }
                            });
                        }
                    });
                };

                if ($slider.hasClass('revslider-initialised')) {
                    set_event();
                } else {
                    $slider.one('revolution.slide.onloaded', function () {
                        set_event();
                    });
                }
            });
        }

        $.fn.resizeRevolution = function (options, new_rev_obj, bp_arr) {
            if (!$(this).length || !$(options.slider).length || !options.breakpoints) return false;

            var wrapper = this,
                slider = options.slider,
                breakpoints = options.breakpoints,
                fullscreen_BP = options.fullscreen_BP || false,
                new_rev_obj = new_rev_obj || {},
                bp_arr = bp_arr || [],
                rev_obj = {
                    dottedOverlay: "true",
                    delay: 4600,
                    startwidth: 1920,
                    hideThumbs: 200,
                    hideTimerBar: "on",

                    thumbWidth: 100,
                    thumbHeight: 50,
                    thumbAmount: 5,

                    navigationArrows: "none",

                    touchenabled: "on",
                    onHoverStop: "on",

                    swipe_velocity: 0.7,
                    swipe_min_touches: 1,
                    swipe_max_touches: 1,
                    drag_block_vertical: false,

                    parallax: "mouse",
                    parallaxBgFreeze: "on",
                    parallaxLevels: [7, 4, 3, 2, 5, 4, 3, 2, 1, 0],

                    keyboardNavigation: "off",

                    navigationHAlign: "center",
                    navigationVAlign: "bottom",
                    navigationHOffset: 0,
                    navigationVOffset: 20,

                    soloArrowLeftHalign: "left",
                    soloArrowLeftValign: "center",
                    soloArrowLeftHOffset: 20,
                    soloArrowLeftVOffset: 0,

                    soloArrowRightHalign: "right",
                    soloArrowRightValign: "center",
                    soloArrowRightHOffset: 20,
                    soloArrowRightVOffset: 0,

                    shadow: 0,

                    spinner: "",
                    h_align: "left",

                    stopLoop: "off",
                    stopAfterLoops: -1,
                    stopAtSlide: -1,

                    shuffle: "off",

                    autoHeight: "off",
                    forceFullWidth: "off",

                    hideThumbsOnMobile: "off",
                    hideNavDelayOnMobile: 1500,
                    hideBulletsOnMobile: "off",
                    hideArrowsOnMobile: "off",
                    hideThumbsUnderResolution: 0,

                    hideSliderAtLimit: 0,
                    hideCaptionAtLimit: 0,
                    hideAllCaptionAtLilmit: 0,
                    startWithSlide: 0,
                    fullScreenOffsetContainer: false
                };

            $.extend(rev_obj, new_rev_obj);

            var get_Slider = function ($sliderWrapp) {
                return $sliderWrapp.find(slider);
            };

            var get_current_bp = function () {
                var wind_W = window.innerWidth;

                for (var i = 0; i < breakpoints.length; i++) {
                    var bp = breakpoints[i];

                    if (!breakpoints.length) return false;

                    if (wind_W <= bp) {
                        if (i === 0) {
                            return bp;
                        } else {
                            if (bp > breakpoints[i - 1])
                                return bp;
                        }
                    } else if (wind_W > bp && i === breakpoints.length - 1)
                        return Infinity;
                }
                return false;
            };

            var $sliderWrappers = $(wrapper);

            $sliderWrappers.each(function () {
                var $sliderWrapp = $(this),
                    $sliderInit = get_Slider($sliderWrapp),
                    $sliderCopy = $sliderWrapp.clone(),
                    bp = get_current_bp();

                if (!$sliderInit.length) return false;

                var start_Rev = function ($sliderInit, bp) {
                    var wind_W = window.innerWidth,
                        rev_settings_obj = {},
                        rev_screen_obj = {},
                        set_rev_obj = {};

                    if (fullscreen_BP) {
                        var full_width = (wind_W >= fullscreen_BP) ? 'off' : 'on',
                            full_screen = (wind_W >= fullscreen_BP) ? 'on' : 'off';

                        rev_screen_obj = {
                            fullWidth: full_width,
                            fullScreen: full_screen
                        };
                    }

                    if (bp_arr.length) {
                        for (var i = 0; i < bp_arr.length; i++) {
                            var this_obj = bp_arr[i];

                            if (this_obj.bp && this_obj.bp.length === 2 && this_obj.bp[0] < this_obj.bp[1]) {
                                var from = this_obj.bp[0],
                                    to = this_obj.bp[1];

                                if (from <= bp && to >= bp) {
                                    for (var key in this_obj) {
                                        if (key !== 'bp')
                                            rev_settings_obj[key] = this_obj[key];
                                    }
                                }
                            }
                        }
                    }

                    $.extend(set_rev_obj, rev_obj, rev_settings_obj, rev_screen_obj);

                    $($sliderInit).show().revolution(set_rev_obj);

                    $(options.functions).each(function () {
                        this.call($sliderInit);
                    });
                };

                start_Rev($sliderInit, bp);

                var restart_Rev = function (current_bp) {
                    if (!$($sliderInit).hasClass('revslider-initialised')) return;
                    bp = current_bp || 0;
                    $sliderInit.revkill();
                    $sliderWrapp.replaceWith($sliderCopy);
                    $sliderWrapp = $sliderCopy;
                    $sliderCopy = $sliderWrapp.clone();
                    $sliderInit = get_Slider($sliderWrapp);
                    start_Rev($sliderInit, bp);
                };

                function endResize(func) {
                    var windWidth = window.innerWidth,
                        interval;

                    interval = setInterval(function () {
                        var windWidthInterval = window.innerWidth;
                        if (windWidth === windWidthInterval) {
                            setTimeout(function () {
                                func();
                            }, 200);
                        }
                        clearInterval(interval);
                    }, 100);
                }

                $(window).on('resize', function () {
                    endResize(function () {
                        var current_bp = get_current_bp();
                        if (current_bp !== bp)
                            restart_Rev(current_bp);
                    })
                });
            });
        };

        var $slider = $('.slider-revolution.revolution-default'),
            fullscreen = $slider.attr('data-fullscreen') == 'false' ? false : 768,
            width = $slider.attr('data-width'),
            height = $slider.attr('data-height');

        $('.slider-revolution.revolution-default').resizeRevolution({
            slider: '.tp-banner',
            breakpoints: [414, 789, 1025],
            fullscreen_BP: fullscreen,
            functions: [
                click_to_play_video,
                autoplay_video
            ]
        }, {
            fullScreenOffsetContainer: "header, .tt-add-full-screen",
            navigationArrows: "true",
            startwidth: width || 1920,
            startheight: height || 800
        }, [{
            bp: [0, 790],
            startheight: height || 1200
        }]);

        $('.slider-revolution.revolution-static').resizeRevolution({
            slider: '.tp-banner',
            breakpoints: [414, 789, 1025],
            fullscreen_BP: 790,
            functions: [
                click_to_play_video,
                autoplay_video
            ]
        }, {
            fullScreenOffsetContainer: "header-static"
        }, [{
            bp: [0, 790],
            startheight: 1300
        },
            {
                bp: [0, 1025],
                fullScreenOffsetContainer: "header"
            }
        ]);

    }
})(jQuery);

/*!
 * jQuery Cookie Plugin v1.4.1
 * https://github.com/carhartl/jquery-cookie
 *
 * Copyright 2006, 2014 Klaus Hartl
 * Released under the MIT license
 */
(function (factory) {
    if (typeof define === 'function' && define.amd) {
        define(['jquery'], factory);
    } else if (typeof exports === 'object') {
        module.exports = factory(require('jquery'));
    } else {
        factory(jQuery);
    }
}(function ($) {

    var pluses = /\+/g;

    function encode(s) {
        return config.raw ? s : encodeURIComponent(s);
    }

    function decode(s) {
        return config.raw ? s : decodeURIComponent(s);
    }

    function stringifyCookieValue(value) {
        return encode(config.json ? JSON.stringify(value) : String(value));
    }

    function parseCookieValue(s) {
        if (s.indexOf('"') === 0) {
            s = s.slice(1, -1).replace(/\\"/g, '"').replace(/\\\\/g, '\\');
        }

        try {
            s = decodeURIComponent(s.replace(pluses, ' '));
            return config.json ? JSON.parse(s) : s;
        } catch (e) {
        }
    }

    function read(s, converter) {
        var value = config.raw ? s : parseCookieValue(s);
        return $.isFunction(converter) ? converter(value) : value;
    }

    var config = $.cookie = function (key, value, options) {

        if (arguments.length > 1 && !$.isFunction(value)) {
            options = $.extend({}, config.defaults, options);

            if (typeof options.expires === 'number') {
                var days = options.expires, t = options.expires = new Date();
                t.setMilliseconds(t.getMilliseconds() + days * 864e+5);
            }

            return (document.cookie = [
                encode(key), '=', stringifyCookieValue(value),
                options.expires ? '; expires=' + options.expires.toUTCString() : '', // use expires attribute, max-age is not supported by IE
                options.path ? '; path=' + options.path : '',
                options.domain ? '; domain=' + options.domain : '',
                options.secure ? '; secure' : ''
            ].join(''));
        }

        var result = key ? undefined : {},
            cookies = document.cookie ? document.cookie.split('; ') : [],
            i = 0,
            l = cookies.length;

        for (; i < l; i++) {
            var parts = cookies[i].split('='),
                name = decode(parts.shift()),
                cookie = parts.join('=');

            if (key === name) {
                result = read(cookie, value);
                break;
            }

            if (!key && (cookie = read(cookie)) !== undefined) {
                result[name] = cookie;
            }
        }

        return result;
    };

    config.defaults = {};

    $.removeCookie = function (key, options) {
        $.cookie(key, '', $.extend({}, options, {expires: -1}));
        return !$.cookie(key);
    };

}));

/*
 show newsletter Modal
 */
jQuery(function ($) {
    $(document).on('click', '#Modalnewsletter .checkbox-group', function () {
        $.cookie('modalnewsletter', '1', {expires: 7});
    });
    var modalnewsletter = $.cookie('modalnewsletter');

    function initnewsLetterObj($obj) {
        var pause = $obj.attr('data-pause');
        setTimeout(function () {
            $obj.modal('show');

        }, pause);
    }

    var newsLetterObj = $('#Modalnewsletter'),
        $body = $('body');

    if (modalnewsletter == 1) return;
    if (newsLetterObj.length) {
        initnewsLetterObj(newsLetterObj);
        $body.addClass('modal-newsletter');
        $('#Modalnewsletter').on('click', '.modal-header .close', function () {
            $body.removeClass('modal-newsletter');
        });
    }
});
jQuery(function ($) {
    $(document).on('click', '#modalVerifyAge .btn', function () {
        $.cookie('modalVerifyAge', '2', {expires: 2});
    });
    var modalnewsletter = $.cookie('modalVerifyAge');

    function initnewsLetterObj($obj) {
        var pause = $obj.attr('data-pause');
        setTimeout(function () {
            $obj.modal('show');

        }, pause);
    }

    var modalVerifyAge = $('#ModalVerifyAge'),
        $body = $('body');


    if (modalVerifyAge == 2) return;
    if (modalVerifyAge.length) {
        initnewsLetterObj(modalVerifyAge);
        modalVerifyAge.on('click', '.js-btn-close', function () {
            modalVerifyAge.find('.modal-header .close').trigger('click');
            return false;
        });

    }
    if (modalVerifyAge.length) {
        initnewsLetterObj(modalVerifyAge);
    }
});
jQuery(function ($) {

    function initnewsLetterObj($obj) {
        var pause = $obj.attr('data-pause');
        setTimeout(function () {
            $obj.modal('show');

        }, pause);
    }

    var modalDiscount = $('#ModalDiscount'),
        $body = $('body');

    if (modalDiscount.length) {
        initnewsLetterObj(modalDiscount);
        modalDiscount.on('click', '.js-reject-discount', function () {
            modalDiscount.find('.modal-header .close').trigger('click');
            return false;
        });

    }
    if (modalDiscount.length) {
        initnewsLetterObj(modalDiscount);
    }
});






