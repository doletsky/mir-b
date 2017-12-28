var global, windowWidth, windowHeight;
var arrow_pos;
var arrow_pad;
var cart_icon_pos;
var $piclist;
var piclistSliderOpt = {
		dots: true,
		slidesToShow: 1,
		slidesToScroll: 1
	};
var scrollbarWidth = getScrollbarWidth();

/*get scrollbar width*/
function getScrollbarWidth() {
	var outer = document.createElement("div");
	outer.style.visibility = "hidden";
	outer.style.width = "100px";
	outer.style.msOverflowStyle = "scrollbar"; // needed for WinJS apps

	document.body.appendChild(outer);

	var widthNoScroll = outer.offsetWidth;
	// force scrollbars
	outer.style.overflow = "scroll";

	// add innerdiv
	var inner = document.createElement("div");
	inner.style.width = "100%";
	outer.appendChild(inner);

	var widthWithScroll = inner.offsetWidth;

	// remove divs
	outer.parentNode.removeChild(outer);

	return widthNoScroll - widthWithScroll;
}

function onResize(){

	windowWidth = global.window.width();
	//console.log(windowWidth);

	$('.mobile_nav').height($('.wrapper').height()+$('footer').height());


	//
	$('#item_4, #item_5').hover(
		function(){
			$('#item_4').addClass('hovered');
			$('#item_5').addClass('hovered');
		},
		function(){
			$('#item_4').removeClass('hovered');
			$('#item_5').removeClass('hovered');
		}
	);
	//--

	//
	$('.lineForm, .sel80').css('width', '100%');
	//--


	//
	if(windowWidth <= 1196 && windowWidth > 952){
		arrow_pad = 10;
	}
	else if(windowWidth <= 952){
		arrow_pad = 30;
	}
	else{
		arrow_pad = 20;
	}
	arrow_pos = Math.floor($('.responsive .cat_menu_box').width()+arrow_pad*2);
	$('.cat_menu_box#item_4 .block_pattern_top').css({'left': arrow_pos+'px'});
	$('.cat_menu_box#item_4 .block_pattern_bottom').css({'left': arrow_pos+'px'});
	//--


	//
	$('.cat_menu_box#item_4 > a').css('width', Math.floor($('.responsive .cat_menu_box').width()*2 + arrow_pad*2));
	//--


	//
	$('.input2').click(function(){
		$(this).find('input').focus();
	});
	//--


	// fix cart & favorite
	if(windowWidth > 690){
		var cartPos = offsetPosition($('#cart')[0]);
		var c_hght = cartPos;

		$(function(){
			$(window).scroll(function(){
				var top = $(this).scrollTop();

				var elem1 = $('#cart');
				var elem2 = $('#favorite');

				if (top < c_hght) {
					elem1.removeClass('fixed');
					elem2.removeClass('fixed');
				} else {
					elem1.addClass('fixed');
					elem2.addClass('fixed');
				}
			});
		});
	}
	else{
		var cartPosMob = offsetPosition($('#mobile_cart')[0]);
		var c_mob_hght = cartPosMob;

		$(function(){
			$(window).scroll(function(){
				var top = $(this).scrollTop();

				var elem1_mob = $('#mobile_cart');
				var elem2_mob = $('#mobile_favorite');

				if (top < c_mob_hght) {
					elem1_mob.removeClass('fixed');
					elem2_mob.removeClass('fixed');
				} else {
					elem1_mob.addClass('fixed');
					elem2_mob.addClass('fixed');
				}
			});
		});
	}
	//--

	/*piclist gallery init & destroy*/
	$piclist = $piclist || $('.piclist');

	if (windowWidth > 690 - scrollbarWidth) {
		if ($piclist.length && $piclist.hasClass('slick-initialized')) {
			$piclist
				.slick('unslick');
		}
	} else {
		if ($piclist.length && !$piclist.hasClass('slick-initialized')) {
			$piclist
				.slick(piclistSliderOpt);
		}
	}


}

$(window).load(function(){
	
	// gallery
	$(".photosgallery-vertical").sliderkit({
		circular:true,
		mousewheel:false,
		shownavitems:3,
		verticalnav:true,
		navclipcenter:true,
		auto:false,
		navpanelautoswitch:false,
		scroll:1
	});
	//--

	
});

$(document).ready(function(){
		
	$(".color-select").click(function(){
		$("#color-select").click();
		return false;
	});


	// placeholder
	$('input[placeholder], textarea[placeholder]').placeholder();
	//--
	
	
	// main slider
	$('.main_slider .flexslider').flexslider({
		animation: "slide",
		animationLoop: true,
		slideshow: false,
		itemMargin: 0,
		minItems: 1,
		maxItems: 1,
		prevText: "",     
		nextText: "",
		controlNav: false,
		directionNav: true,
		start: function(slider){
			$('body').removeClass('loading');
		}
	});
	//--
	
	
	// articles slider
	$('.articles_slider .flexslider, .news_slider .flexslider').flexslider({
		animation: "slide",
		animationLoop: true,
		slideshow: false,
		itemMargin: 0,
		minItems: 1,
		maxItems: 1,
		prevText: "",     
		nextText: "",
		controlNav: false,
		directionNav: true,
		start: function(slider){
			$('body').removeClass('loading');
		}
	});
	//--
		
	
	// catalogue menu slider
	$('.responsive').slick({
		dots: false,
		infinite: false,
		speed: 300,
		arrows: true,
		slidesToShow: 7,
		slidesToScroll: 1,
		respondTo: 'min',
		responsive: [
			{
				breakpoint: 970,
				settings: {
					slidesToShow: 3,
					slidesToScroll: 3,
				}
			}
		]
	});
	
	$('.responsive_320').slick({
		dots: false,
		infinite: false,
		speed: 300,
		arrows: true,
		slidesToShow: 1,
		slidesToScroll: 1
	});
	//--
	
	
	// item slider
	$('.item_photo_2 .flexslider').flexslider({
		animation: "slide",
		animationLoop: true,
		slideshow: false,
		itemMargin: 0,
		minItems: 1,
		maxItems: 1,
		prevText: "",     
		nextText: "",
		controlNav: false,
		directionNav: true,
		start: function(slider){
			$('body').removeClass('loading');
		}
	});
	//
	
	
	// attended slider
	$('.items_slider').slick({
		dots: false,
		infinite: false,
		speed: 300,
		arrows: true,
		slidesToShow: 3,
		slidesToScroll: 1,
		swipe: false,
		responsive: [
			{
				breakpoint: 1000,
				settings: {
					slidesToShow: 2,
				}
			},
			{
				breakpoint: 970,
				settings: {
					slidesToShow: 3,
				}
			},
			{
				breakpoint: 750,
				settings: {
					slidesToShow: 2,
				}
			},
			{
				breakpoint: 550,
				settings: {
					slidesToShow: 1,
				}
			}
		]
	});
	//--
	
	// viewed slider
	$('.viewed_items_slider').slick({
		dots: false,
		infinite: false,
		speed: 300,
		arrows: true,
		slidesToShow: 4,
		slidesToScroll: 1,
		responsive: [
			{
				breakpoint: 1150,
				settings: {
					slidesToShow: 3,
				}
			},
			{
				breakpoint: 970,
				settings: {
					slidesToShow: 3,
				}
			},
			{
				breakpoint: 750,
				settings: {
					slidesToShow: 2,
				}
			},
			{
				breakpoint: 550,
				settings: {
					slidesToShow: 1,
				}
			}
		]
	});
	//--
	
	
	// certificates slider
	$('.certificates_slider')
		.slick({
			dots: false,
			speed: 300,
			arrows: true,
			slidesToShow: 1,
			slidesToScroll: 1,
			responsive: [
				{
					breakpoint: 1196,
					settings: {
						slidesToShow: 3,
					}
				},
				{
					breakpoint: 690,
					settings: {
						slidesToShow: 1,
					}
				}
			],
			autoplay: true,
			autoplaySpeed: 6000
		})
		.on('mouseleave', function() {
			$(this).slick('slickPlay');
		});
	//--
	
		
	// footer menu
	$('.foot_nav > ul > li').click(function(){
		if(!$(this).hasClass('active')){
			$('.foot_nav > ul > li').removeClass('active');
			$(this).addClass('active');
			return false;
		}
	});
	//--
		
	
	// mobile menu
	$('.navbar_toggle').click(function(){
		$('.mobile_nav').fadeIn(500);
	});
	$('.close_menu').click(function(){
		$('.mobile_nav').fadeOut(500);
	});
	//--
	
	
	// input values
	$(document).on("click",'.arr_minus',function () {
			var $input = $(this).parent().find('.inp_sm');
			var count = parseInt($input.val()) - 1;
			count = count < 1 ? 1 : count;
			$input.val(count);
			$input.change();
			return false;
	});
	$(document).on("click",'.arr_plus',function () {
			var $input = $(this).parent().find('.inp_sm');
			$input.val(parseInt($input.val()) + 1);
			$input.change();
			return false;
	});
	//--
	
	
	// show filter form
	$('.show_filter').click(function(){
		$(this).next('form').stop(true,true).slideDown(500);
		// select refrese
		var params = {
		refreshEl: "#game2,#price2",
		visRows: 9
		}
		cuSelRefresh(params);
		//--
	});
	$('.hide_filter').click(function(){
		$(this).parent().parent('form').stop(true,true).slideUp(500);
	});
	//--
	
	
	// sort filter
	/*
	$('.sort a').click(function(){
		if(!$(this).hasClass('active')){
			$('.sort a').removeClass('active');
			$(this).addClass('active');
		}
		return false;
	});
	$('.sort2 a').click(function(){
		if(!$(this).hasClass('active')){
			$('.sort2 a').removeClass('active');
			$(this).addClass('active');
		}
		return false;
	});
	*/
	
	
	// select
	var params = {
		changedEl: ".lineForm select",
		visRows: 9,
		scrollArrows: false
	}
	cuSel(params);
	//--
	
	

	
	
	
	// fancybox
	$(".fancybox").fancybox({
		helpers: {
			overlay: {
				locked: false
			}
		},
		beforeShow: function() {
			$(this.element).addClass('fancybox_active');
		},
		beforeClose: function() {
			$(this.element).removeClass('fancybox_active');
		}
	});
	//--
	
	
	// cue length helper
	$(".height-slider").slider({orientation:'vertical',min:150,max:200,value:180,slide:function(event,ui)
	{$('.cue_text_head strong').html(sdf_FTS(ui.value/100,2,'')+' м');
	if(ui.value>180)
		$('.cue_helper_description strong').html(ui.value-20+' см');
	else
		$('.cue_helper_description strong').html('160 см');}});
	//--

	// cue length helper
	$(".height-slider").slider({orientation:'vertical',min:150,max:200,value:180,slide:function(event,ui)
	{$('.cue_text_head span.strong').html(sdf_FTS(ui.value/100,2,'')+' м');
	if(ui.value>180)
		$('.cue_helper_description span.strong').html(ui.value-20+' см');
	else
		$('.cue_helper_description span.strong').html('160 см');}});
	//--


	//
	$('ul.tabs4 li:first-child').click(function(){
		if(!$(this).hasClass('current')){
			$('ul.tabs4 li').removeClass('current');
			$(this).addClass('current');
			$(this).parent().parent().find('.box').removeClass('visible');
			$(this).parent().parent().find('.box.addr1').addClass('visible');
		}
	});
	$('ul.tabs4 li:last-child').click(function(){
		if(!$(this).hasClass('current')){
			$('ul.tabs4 li').removeClass('current');
			$(this).addClass('current');
			$(this).parent().parent().find('.box').removeClass('visible');
			$(this).parent().parent().find('.box.addr2').addClass('visible');
		}
	});
	$('ul.tabs5 li:first-child').click(function(){
		if(!$(this).hasClass('current')){
			$('ul.tabs5 li').removeClass('current');
			$(this).addClass('current');
			$(this).parent().parent().find('.box').removeClass('visible');
			$(this).parent().parent().find('.box.phone1').addClass('visible');
		}
	});
	$('ul.tabs5 li:last-child').click(function(){
		if(!$(this).hasClass('current')){
			$('ul.tabs5 li').removeClass('current');
			$(this).addClass('current');
			$(this).parent().parent().find('.box').removeClass('visible');
			$(this).parent().parent().find('.box.phone2').addClass('visible');
		}
	});
	//--
	
	
	// cart item delete
	$('.delete').click(function(){
		$(this).parent().parent('.cart_tab_row').remove();
	});
	//--
	
	
	//
	$('.sliderkit-nav-clip ul li:first-child').addClass('sliderkit-active');
	$('.sliderkit-nav-clip ul li').click(function(){
		$('.sliderkit-nav-clip ul li').removeClass('sliderkit-active');
		$(this).addClass('sliderkit-active');
	});
	//--
	
	
	// phone validation
	$('#contact_submit').click(function(e) {
		if (!validatePhone('txtPhone')) {
			$('#phone_message').css('visibility', 'visible');
			$('#txtPhone').css('color', '#F00');
		}
	});
	$('#txtPhone').focus(function(){
		$('#txtPhone').css('color', '#473a49');
	});
	//--

	// zoom image
	$('.cloudzoom').CloudZoom({
		zoomPosition: 3,
		zoomOffsetX: 0,
		zoomOffsetY: 0,
		zoomSizeMode: 'image',
		autoInside: 1640,
		lazyLoadZoom: true
	});
	$(document)
		.on('cloudzoom_start_zoom', '.cloudzoom', function(){
			var $that = $(this);

			$that
				.addClass('cloudzoom_active')
				.closest('.sliderkit-panel, .mobile_photo, .single_photo')
				.addClass('hover');
		})
		.on('cloudzoom_end_zoom', '.cloudzoom', function(){
			$(this)
				.removeClass('cloudzoom_active')
				.closest('.sliderkit-panel, .mobile_photo, .single_photo')
				.removeClass('hover');
		})
		.on('click', '.fancybox', function () {
			var $cloudzoom = $(this).find('.cloudzoom');

			if ($cloudzoom.length) {
				$cloudzoom.data('CloudZoom').closeZoom();
			}
		})
		.on('click', '.cloudzoom-blank', function () {
			setTimeout(function() {
				var $fancy = $('.cloudzoom_active').closest('.fancybox');
				if ($fancy.length && !$fancy.hasClass('fancybox_active')) {
					$fancy.trigger('click');
				}
			}, 0);

		});


	//--

	/*pay cash text show*/
	function handlePayByCash($lookFor, $handleIt) {
		if ($lookFor.is(':checked')) {
			$handleIt.show();
		} else {
			$handleIt.hide();
		}
	}
	$.each($('.pay-del'), function(){
		var $container = $(this),
			$ecatDeliv = $container.find('.pay-del__deliver_1'),
			$cashPayment = $container.find('.pay-del__cash');

		handlePayByCash($ecatDeliv, $cashPayment);
	});
	$(document)
		.on('change', '.pay-del__deliver[name=delivery]', function() {
			var $that = $(this),
				$container = $that.closest('.pay-del'),
				$cashPayment = $container.find('.pay-del__cash'),
				$ecatDeliv = $container.find('.pay-del__deliver_1');

			handlePayByCash($ecatDeliv, $cashPayment);
		});

	/*description rows check highlight*/
	$(document)
		.on('change', '.item_tab_td_box .for-highlight input:checkbox', function () {
			var $that = $(this),
				$row = $that.closest('.item_tab_td_box');
				$row2 = $that.closest('.offer_wrap');
			console.log($that);
			if ($that.is(':checked')) {
				$row.addClass('highlight');
				$row2.addClass('highlight');
			} else {
				$row.removeClass('highlight');
				$row2.removeClass('highlight');
			}
		});





		
	global = {
			window: $(window)
	};
	
	global.window.resize(onResize);
	onResize();
	
});



function sdf_FTS(_number,_decimal,_separator)
{var decimal=(typeof(_decimal)!='undefined')?_decimal:0;var separator=(typeof(_separator)!='undefined')?_separator:'';var r=parseFloat(_number);var exp10=Math.pow(10,decimal);r=Math.round(r*exp10)/exp10;rr=Number(r).toFixed(decimal).toString().split('.');b=rr[0].replace(/(\d{1,3}(?=(\d{3})+(?:\.\d|\b)))/g,"\$1"+separator);if(_decimal!==0)
r=b+','+rr[1];else
r=b;return r;}





//tabs
(function($) {
  $(function() {
 
    $('ul.tabs').delegate('li:not(.current)', 'click', function() {
      $(this).addClass('current').siblings().removeClass('current')
        .parents('div.tabs-content').eq(0).find('>div.box')
			.removeClass('visible')
			.hide()
			.eq($(this).index())
			.addClass('visible')
			.fadeIn(500).show();
			
				// select refresh
				var params = {
				refreshEl: ".custom-select,#material_1,#material_2,#material_3,#slab_1,#slab_2,#slab_3,#base_type_1,#base_type_2,#base_type_3",
				visRows: 9
     		}
     		cuSelRefresh(params);
				//--
		//tables:		
		var material = $('.item_description_tab .box.visible .box.visible input[name=MATERIAL]').val();
		var base_type = $('.item_description_tab .box.visible .box.visible input[name=BASE_TYPE]').val();
		var size = $('.item_description_tab .box.visible .box.visible input[name=SIZE]').val();
		if(
			material !=0 &&
			base_type !=0 &&
			size !=0 &&
			material != undefined
		){
			var price = $('.size_table:not(.size_table_mob) .tab_row.base_type_'+base_type+'.material_'+material+'.size_'+size+' .tab_td_7').first().text();
			$('.size_table:not(.size_table_mob) .tab_row').removeClass('active');
			$('.size_table:not(.size_table_mob) .tab_row.base_type_'+base_type+'.material_'+material+'.size_'+size).addClass('active');
			$('.item_description_tab .box.visible .box.visible .sum_2 strong').html('от '+price+' <span class="rub">i</span>');
			$('.item_description_tab .box.visible .box.visible .sum_2 span.strong').html('от '+price+' <span class="rub">i</span>');
		}
		// lamps:
		var lamps = $('.item_description_tab .box.visible').find('input[name=LAMPSHADES]').val();
		
		if(
		
			lamps != undefined
		){
			//var price = $('.size_table:not(.size_table_mob) .tab_row.base_type_'+base_type+'.material_'+material+'.size_'+size+' .tab_td_7').first().text();
			$('.size_table:not(.size_table_mob) .tab_row').removeClass('active');
			$('.size_table:not(.size_table_mob) .tab_row.lamps_'+lamps).addClass('active');
			//$('.item_description_tab .box.visible .box.visible .sum_2 strong').html('от '+price+' <span class="rub">i</span>');
		}
		
      return false;
    })
		
		$('ul.tabs2').delegate('li:not(.current)', 'click', function() {
      $(this).addClass('current').siblings().removeClass('current')
        .parents('div.tabs-content').eq(0).find('>div.box')
				.removeClass('visible')
				.css({'opacity': '0', 'height': '0px'})
				.eq($(this).index())
				.addClass('visible')
				.css({'opacity': '1', 'height': 'auto'});
      return false;
    })
		
  })
})(jQuery)


/* mobile search */
$(document).click( function(event){
	if( $(event.target).closest(".inner_headline .form_search_mob").length ) 
	return;
	$('.inner_headline .form_search_mob')
	.animate({
		width: '36px'
	}, 500 );
	$('.inner_headline .form_search_mob .input_box').css('width', '0px');
	$('.form_layout').css('display', 'block');
	event.stopPropagation();
});
$('.form_layout').click( function() {
	$('.inner_headline .form_search_mob')
	.animate({
		width: '102px'
	}, 500 );
	$('.inner_headline .form_search_mob .input_box').css('width', '62px');
	$(this).css('display', 'none');
	return false;
});

$(document).click( function(event){
	if( $(event.target).closest(".form_search_2").length ) 
	return;
	$('.form_search_2')
	.animate({
		width: '211px',
		left: '50%',
		marginLeft: '-105px'
	}, 500 );
	event.stopPropagation();
});
$('.form_search_2 .input_box').click( function() {
	$('.form_search_2')
	.animate({
		width: '100%',
		left: '0px',
		marginLeft: '0px'
	}, 500 );
	return false;
});
/* .mobile search */ 


/* phone validation */
function validatePhone(txtPhone) {
	var a = document.getElementById(txtPhone).value;
	var filter = /^[0-9]{11}$/;
	if (!filter.test(a)) {
		return false;
	}
	else {
		$('#contact_form').submit();
		return true;
	}
}
/* /phone validation */


/* check position of the element */
function offsetPosition(element) {
	var offsetTop = 0;
	if(element){
		do {
				offsetTop  += element.offsetTop;
		} while (element = element.offsetParent);
	}
	return offsetTop;
}
/* /check position of the element */