$(document).ready(function () {
    $('.slider__slide-img').attr('src', function (count, value) {
        $($(this).parent()).backstretch(value);
    });

    $('.menu-catalog__item-img').attr('src', function (count, value) {
        $($(this).parent()).backstretch(value);
    });

    $('.popular__list-item-img').attr('src', function (count, value) {
        $($(this).parent()).css('backgroundImage', 'url(' + value + ')');
    });

    $('.tips__tip-img').attr('src', function (count, value) {
        $($(this).parent()).css('backgroundImage', 'url(' + value + ')');
    });

    $('.goods__photo-main-img').attr('src', function (count, value) {
        $($(this).parent()).css('backgroundImage', 'url(' + value + ')');
    });

    $('.goods__photo-small-img').attr('src', function (count, value) {
        $($(this).parent()).css('backgroundImage', 'url(' + value + ')');
    });

    $('.catalog__grid-item-photo-img').attr('src', function (count, value) {
        $($(this).parent()).css('backgroundImage', 'url(' + value + ')');
    });

    $('.news__item-img').attr('src', function (count, value) {
        $($(this).parent()).css('backgroundImage', 'url(' + value + ')');
    });

    $('.searched__item-photo-img').attr('src', function (count, value) {
        $($(this).parent()).css('backgroundImage', 'url(' + value + ')');
    });

    $('.our-team__item-photo-img').attr('src', function (count, value) {
        $($(this).parent()).css('backgroundImage', 'url(' + value + ')');
    });

    $('.individual-coat__form-img').attr('src', function (count, value) {
        $($(this).parent()).css('backgroundImage', 'url(' + value + ')');
    });

    $('.news__item-working-img').attr('src', function (count, value) {
        $($(this).parent()).css('backgroundImage', 'url(' + value + ')');
    });

    $('.catalog__linear-item-photo-img').attr('src', function (count, value) {
        $($(this).parent()).css('backgroundImage', 'url(' + value + ')');
    });


    (function () {
        var elem = $('.slider__slide');
        var controls = $('.slider__controls-list-item');
        var count = elem.size();
        controls.css('width', 100 / count + '%');
        controls.each(function(index) {
            if(index >= count) $(this).css('display','none');
        });
    })();

    $('.popular__list').mixItUp(
        {
            animation: {
                duration: 400,
                effects: 'fade translateZ(-360px) stagger(34ms)',
                easing: 'ease'
            },
            selectors: {
                target: '.popular__list-item-col',
                filter: '.popular__controls-btn'
            },
            layout: {
                display: 'inline-block'
            },
            load: {
                filter: '.category-2'
            }
        }
    );


    $('#slides-container').slick({
        speed: 150,
        fade: true,
        slide: '.slider__slide',
        infinite: true,
        autoplay: true,
        autoplaySpeed: 5000,
        onAfterChange: function (self, index) {
            $('.slider__controls-list-item').removeClass('active');
            $($('.slider__controls-list-item')[index]).addClass('active');
        }
    });


    $('.slider__controls-list-item').each(function (index, element) {
        $(element).click(function () {
            $('.slider__controls-list-item').removeClass('active');
            $(this).addClass('active');
            $('#slides-container').slickGoTo(index);
        });
    });


    $(".chosen-select").chosen({
        disable_search_threshold: 10,
        width: '200px'
    });

    $(".chosen-select-saw").chosen({
        disable_search_threshold: 10,
        width: '120px'
    });

    $(".fancybox-thumb").fancybox({
        prevEffect: 'none',
        nextEffect: 'none',
        helpers: {
            title: {
                type: 'outside'
            },
            thumbs: {
                width: 50,
                height: 50
            }
        }
    });

    var plusBtn = $('.goods__amount-box-plus', '.goods__amount-box');
    var minusBtn = $('.goods__amount-box-minus', '.goods__amount-box');
    var amount = $('#amount');

    plusBtn.click(function () {
        amount.val(parseInt(amount.val()) + 1);
    });

    minusBtn.click(function () {
        if (amount.val() <= 1) {
            return;
        } else {
            amount.val(parseInt(amount.val()) - 1);
        }
    });
});
