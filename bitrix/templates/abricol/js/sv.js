$(document).ready(function(){


    $(".add-to-cart").on('click',function(){
      var form=$(this).closest("form");
      var ser=form.serialize();
      var action=form.attr("action");
	 // alert(ser);
      $.ajax({
        url: action,
        type: 'POST',
        data: ser,
        timeout: 60000,
        dataType: 'html',
        error: function(){
          /* error */
          console.log("AJAX error (add-to-cart)");
        },
        success: function(data){
		//alert(data);
          $("#ajax-container").html(data);
          refreshBasket();
        },

      });
      return false;
    });
	
	$(".add-to-cart2").on('click',function(){
      var form=$(this).closest(".offers_wrap").find('.offer_wrap.highlight');
      var ser=form.serialize();
	  if(ser==''){
		alert('Выберите товар');
	  }else{
	  
		$.each( $(this).closest(".offers_wrap").find('.offer_wrap.highlight'), function( key, value ) {
			form=$(this);
			ser=form.serialize();
			var action=form.attr("action");
			$.ajax({
				url: action,
				type: 'POST',
				data: ser,
				timeout: 60000,
				dataType: 'html',
				error: function(){
				  
				  console.log("AJAX error (add-to-cart)");
				},
				success: function(data){
				
				  $("#ajax-container").html(data);
				  refreshBasket();
				},
			  });
		});
		var action=form.attr("action");
		 
	  }
      return false;
    });
	$(".add_to_fav3").on('click',function(){
		$this = $(this);
	
		var form=$(this).closest(".offers_wrap").find('.offer_wrap.highlight');
		var ser=form.serialize();
		if(ser==''){
			alert('Выберите товар');
		}else{
			$.each( $(this).closest(".offers_wrap").find('.offer_wrap.highlight'), function( key, value ) {
				form=$(this);
				$this.toggleClass("added");
				ser=form.serialize()+'&added='+$this.hasClass("added");
				alert(ser);
				$.ajax({
					url: '/bitrix/templates/abricol/ajax/add-favorites.php',
					type: 'POST',
					data: ser,
					timeout: 60000,
					dataType: 'html',
					error: function(){
						console.log("AJAX error (add-to-fav)");
					},
					success: function(data){
						$("#ajax-container").html(data);
							
					},
				});
			});
			var action=form.attr("action");

		}
		return false;
    });
    $(".add_to_fav:not(.add_to_fav3)").on('click',function(){
      $(this).toggleClass("added");
      var form=$(this).closest("form");
      var ser=form.serialize()+'&added='+$(this).hasClass("added");
      var action=form.attr("action");
      $.ajax({
        url: '/bitrix/templates/abricol/ajax/add-favorites.php',
        type: 'POST',
        data: ser,
        timeout: 60000,
        dataType: 'html',
        error: function(){
          /* error */
          console.log("AJAX error (add-to-fav)");
        },
        success: function(data){
          $("#ajax-container").html(data);
        },

      });
      return false;
    });
	
	$(".custom-select").on('change',function(){
		var material = $('.item_description_tab .box.visible .box.visible input[name=MATERIAL]').val();
		var base_type = $('.item_description_tab .box.visible .box.visible input[name=BASE_TYPE]').val();
		var size = $('.item_description_tab .box.visible .box.visible input[name=SIZE]').val();
		
		if(
			material !=0 &&
			base_type !=0 &&
			size !=0
		){
			var price = $('.size_table:not(.size_table_mob) .tab_row.base_type_'+base_type+'.material_'+material+'.size_'+size+' .tab_td_7').first().text();
			$('.size_table:not(.size_table_mob) .tab_row').removeClass('active');
			$('.size_table:not(.size_table_mob) .tab_row.base_type_'+base_type+'.material_'+material+'.size_'+size).addClass('active');
			$('.item_description_tab .box.visible .box.visible .sum_2 strong').html('от '+price+' <span class="rub">i</span>');
			$('.item_description_tab .box.visible .box.visible .sum_2 span.strong').html('от '+price+' <span class="rub">i</span>');
		}else{
			
		}
    });
	$('.tables_table:not(.size_table_mob) .tab_row').on('click',function(){
		$('.size_table:not(.size_table_mob) .tab_row').removeClass('active');
		$('.size_table:not(.size_table_mob) .'+$(this).attr('class').replace(/\s+/g,'.')).addClass('active');
		
		var size = $(this).children('form').children('input[name=SIZE]').val();
		var material = $(this).children('form').children('input[name=MATERIAL]').val();
		var base_type = $(this).children('form').children('input[name=BASE_TYPE]').val();
		
		$('ul.tabs3 li').removeClass('current');
		$('ul.tabs3 li[rel='+size+']').addClass('current');
		$('.item_description_tab .box-table-buy').removeClass('visible');
		$('.item_description_tab .box-table-buy[rel='+size+']').addClass('visible');
		
		cuselSetValue("#base_type_"+size, base_type);
		cuselSetValue("#material_"+size, material);
		
		
		
	});
	$('.lamps_table:not(.size_table_mob) .tab_row').on('click',function(){
		$('.size_table:not(.size_table_mob) .tab_row').removeClass('active');
		$('.size_table:not(.size_table_mob) .'+$(this).attr('class').replace(/\s+/g,'.')).addClass('active');
		
		var lamp = $(this).children('form').children('input[name=LAMPSHADES]').val();
	
		
		$('ul.tabs li').removeClass('current');
		$('ul.tabs li[rel='+lamp+']').addClass('current');
		$('.item_description_tab .box-table-buy').removeClass('visible');
		$('.item_description_tab .box-table-buy').css('display','none');
		$('.item_description_tab .box-table-buy[rel='+lamp+']').addClass('visible');
		$('.item_description_tab .box-table-buy[rel='+lamp+']').css('display','block');
		
	
		
		
		
	});
	$('.cat_menu_box.slick-slide.slick-active').mouseenter(function() {
	
		var heightR = parseInt($(this).css('height'));
		if(heightR>550){
			heightR=550;
			$(this).css('height','550px')
		}
		
		if($(this).attr("data-slick-index")==0){
			if($(window).scrollTop()>120){
				heightR = (heightR-265-($(window).scrollTop()-120))*(-1);
			}else{
				heightR = (heightR-265)*(-1);
				
			}
			$(this).css({'margin-top':heightR}); 
			
		}
		if($(this).attr("data-slick-index")==1 || $(this).attr("data-slick-index")==2){
		//221  //292
		//alert($(this).css('height'));
		//alert($(window).scrollTop());
		
			//if($(window).scrollTop()>385){
			if($(window).scrollTop()>(605-parseInt($(this).css('height')))){
			
				heightR = (heightR-(parseInt($(this).css('height')))-($(window).scrollTop()-405))*(-1);
			}else{
				heightR = (heightR-200)*(-1);
			}
			$(this).css({'margin-top':heightR}); 
		
		}

		if($(this).attr("data-slick-index")==5 || $(this).attr("data-slick-index")==6){
		//320
			//if($(window).scrollTop()>435){
			if($(window).scrollTop()>(605-parseInt($(this).css('height')))){
				heightR = (heightR-(parseInt($(this).css('height')))-($(window).scrollTop()-405))*(-1);
				$(this).css({'margin-top':heightR}); 
			}else{
				$(this).css({'margin-top':28}); 
			}
			
		
		}
		
		if($(this).attr("data-slick-index")==3 || $(this).attr("data-slick-index")==4){
		//172
			//if($(window).scrollTop()>300){
			if($(window).scrollTop()>(605-parseInt($(this).css('height')))){
				heightR = (heightR-(parseInt($(this).css('height')))-($(window).scrollTop()-405))*(-1);
				$('.cat_menu_box.slick-slide.slick-active.hovered').css({'margin-top':heightR}); 
			}else{
				$('.cat_menu_box.slick-slide.slick-active.hovered').css({'margin-top':-120}); 
			}
			
		
		}
		
		
		
		/*if($(this).attr("data-slick-index")==3 || $(this).attr("data-slick-index")==4){
			
			$(this).css({'margin-top':'-200'});
		
		
		}else{
			if(heightR>172){
				if(heightR>500){
				
					if($(window).scrollTop()>120){
						heightR = (heightR-265-($(window).scrollTop()-120))*(-1);
					}else{
						heightR = (heightR-265)*(-1);
					}
				
					
				}else{
			
					if($(window).scrollTop()>360){
						heightR = (heightR-215-($(window).scrollTop()-360))*(-1);
					}else{
						heightR = (heightR-215)*(-1);
					}
				
					
				}
				$(this).css({'margin-top':heightR}); 
			}else{
				$(this).css({'margin-top':28});
			}
		}*/
	});
	$('.cat_menu_box.slick-slide.slick-active').mouseleave(function() {
		if($(this).attr("data-slick-index")!=3 && $(this).attr("data-slick-index")!=4){
		$(this).css('height','auto');
		$(this).css({'margin-top':'28px'}); 
		}else{
			$('.cat_menu_box.slick-slide.slick-active').css({'margin-top':28}); 
		}
	});
	
	
	$('#order_submit').on('click',function(){
		var err1 = 0;
		if($('#ORDER_PROP_1').val()==''){
	
			$('#ORDER_PROP_1').attr('placeholder','Заполните поле!');
			$('#ORDER_PROP_1').parent('.input2').addClass('error');
			err1=1;
		}
		if($('#ORDER_PROP_2').val()==''){
			$('#ORDER_PROP_2').attr('placeholder','Заполните поле!');
			$('#ORDER_PROP_2').parent('.input2').addClass('error');
			err=1;
		}
		if($('#ORDER_PROP_3').val()==''){
			$('#ORDER_PROP_3').attr('placeholder','Заполните поле!');
			$('#ORDER_PROP_3').parent('.input2').addClass('error');
			err=1;
		}
		if($('#ORDER_PROP_5').val()==''){
			$('#ORDER_PROP_5').attr('placeholder','Заполните поле!');
			$('#ORDER_PROP_5').parent('.input2').addClass('error');
			err=1;
		}
		
		if(err1 == 1)		
			return false;
		else
		submitForm('Y');	

	});


});
function refreshFavorites(){
  $("#favoriteModal .cart_content").load("/bitrix/templates/abricol/ajax/get-favorites.php");
}



function number_format( number, decimals, dec_point, thousands_sep ) {  // Format a number with grouped thousands
  var i, j, kw, kd, km;
  // input sanitation & defaults
  if( isNaN(decimals = Math.abs(decimals)) ){
    decimals = 2;
  }
  if( dec_point == undefined ){
    dec_point = ",";
  }
  if( thousands_sep == undefined ){
    thousands_sep = ".";
  }
  i = parseInt(number = (+number || 0).toFixed(decimals)) + "";
  if( (j = i.length) > 3 ){
    j = j % 3;
  } else{
    j = 0;
  }
  km = (j ? i.substr(0, j) + thousands_sep : "");
  kw = i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + thousands_sep);
  //kd = (decimals ? dec_point + Math.abs(number - i).toFixed(decimals).slice(2) : "");
  kd = (decimals ? dec_point + Math.abs(number - i).toFixed(decimals).replace(/-/, 0).slice(2) : "");
  return km + kw + kd;
}
