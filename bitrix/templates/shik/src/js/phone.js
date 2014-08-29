/**
 * Created by VESPER on 27.08.2014.
 */
(function( $ ){

//// ---> Проверка на существование элемента на странице
    jQuery.fn.exists = function() {
        return jQuery(this).length;
    }

//	Phone Mask
    $(function() {

        if($('#phone').exists()){

            $('#phone').each(function(){
                $(this).mask("+7(999) 999-9999");
            });

        }

        if($('.phone_form').exists()){

            var form = $('.phone_form'),
                btn = form.find('.btn_submit');

            form.find('.rfield').addClass('empty_field');

            setInterval(function(){

                if($('#phone').exists()){
                    var pmc = $('#phone');
                    if ( (pmc.val().indexOf("_") != -1) || pmc.val() == '' ) {
                        pmc.addClass('empty_field');
                    } else {
                        pmc.removeClass('empty_field');
                    }
                }

                var sizeEmpty = form.find('.empty_field').size();

                if(sizeEmpty > 0){
                    if(btn.hasClass('disabled')){
                        return false
                    } else {
                        btn.addClass('disabled')
                    }
                } else {
                    btn.removeClass('disabled')
                }

            },200);

            btn.click(function(){
                if($(this).hasClass('disabled')){
                    return false
                } else {
                    form.submit();
                }
            });

        }

    });

})( jQuery );