$(document).ready(function(){

    var myLatlng = new google.maps.LatLng(59.893186,30.316748);
    var myOptions = {
        zoom: 15,
        center: myLatlng,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        scrollwheel: false
    }
    var map = new google.maps.Map(document.getElementById('map_canvas'), myOptions);
    var marker = new google.maps.Marker({
        position: myLatlng,
        map: map,
        title: '',
        clickable: true
    });
    var info = new google.maps.InfoWindow({
        content:
        'Гостиница Холидей Инн Московские Ворота, Конгресс Холл<br />Московский проспект 97А'
    });

    $('#vk_comments iframe').attr('width','');

    google.maps.event.addListener(map, 'idle', function(){
        info.open(map, marker);
    });

    var to = setTimeout(function(){

        $('.lottery').addClass('active');
        $('.lottery').animate({
            'right' : '0px'
        },500);

    },15000);

    $('.lottery img').on('click',function(){
        if(!$('.lottery').hasClass('active')){
            $('.lottery').addClass('active');
            $('.lottery').animate({
                'right' : '0px'
            },500);
        } else {
            clearTimeout(to);
            $('.lottery').removeClass('active');
            $('.lottery').animate({
                'right' : '-465px'
            },500);
        }

    });

    $('.lottery .close').on('click',function(){
        clearTimeout(to);
        $('.lottery').animate({
            'right' : '-465px'
        },500);
    });

    $('[rel=gallery]').fancybox();

    $('header .contacts a').fancybox();

    $('.feedback form button').live('click',function(){
        var blank = false;
        $('.feedback form input[type=text]').each(function(i,o){
            if($(o).val().replace(/\s/g, "") == '') blank = true;
        });
        if(!blank){
            $.ajax({
                'type' : 'POST',
                'url'  : '/order',
                'async': false,
                'data' : $('.feedback form').serialize(),
                success : function(response){
                    $.fancybox($('#ok'));
                }
            });
        }
        return false;
    });

	$('.formanta form button').live('click',function(){
        var blank = false;
        $('.formanta form input, .formanta form select').each(function(i,o){
            if($(o).val().replace(/\s/g, "") == '') blank = true;
        });
        if(!blank){
            $.ajax({
                'type' : 'POST',
                'url'  : '/order/ticket',
                'async': false,
                'data' : $('.formanta form').serialize(),
                success : function(response){
                    $.fancybox($('#ok'));
                }
            });
        }
        return false;
    });
	/*
	$('.lottery input[type=submit]').live('click',function(){
        var blank = false;
        $('.lottery form input[type=text]').each(function(i,o){
            if($(o).val().replace(/\s/g, "") == '') blank = true;
        });
        if(!blank){
			$.fancybox($('#ok'));
            $.ajax({
                'type' : 'POST',
                'url'  : '/newRequest',
                'async': false,
                'data' : $('.lottery form').serialize(),
                success : function(response){
                    //$.fancybox($('#ok'));
                }
            });
        }
        return false;
    });
	*/

});
