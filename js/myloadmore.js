jQuery(function($){ // use jQuery code inside this to avoid "$ is not defined" error
	$('.misha_loadmore').click(function(){
 
		var button = $(this),
		    data = {
			'action': 'loadmore',
			'query': misha_loadmore_params.posts, // that's how we get params from wp_localize_script() function
			'page' : misha_loadmore_params.current_page,
		};
 
		$.ajax({ // you can also use $.post here
			url : misha_loadmore_params.ajaxurl, // AJAX handler
			data : data,
			type : 'POST',
			beforeSend : function ( xhr ) {
				button.text('Загрузка...'); // change the button text, you can also add a preloader image
			},
			success : function( data ){
				if( data ) { 
					button.text( 'Показати більше' ); // insert new posts
					jQuery('.katalog-items .row .product').last().after(data);
					misha_loadmore_params.current_page++;
					var w = $(window).width();
					if( w > 992 ){
						$('.katalog-items .product').each(function(){
							var newLabel = $(this).find('.new-label').length;
							if(newLabel > 0 ){
							  $(this).addClass('new-product');
							  var aditionalOffset = 10;
							}
							else{
							  var aditionalOffset = 0;
							}
							var productTitleHeigt = $(this).find('.woocommerce-loop-product__title').height();
							var productDataHeight = $(this).find('.product-data').height();
							var outOfStockElements = $(this).find('.out-of-stock-label-wrapper').height() + $(this).find('.out-of-stock-button-wrapper').height();
							$(this).find('.cart-icon').css('bottom', productTitleHeigt + productDataHeight + outOfStockElements + aditionalOffset + 24);
						});
					}
					if ( misha_loadmore_params.current_page == misha_loadmore_params.max_page ) 
						button.remove(); // if last page, remove the button
 
					// you can also fire the "post-load" event here if you use a plugin that requires it
					// $( document.body ).trigger( 'post-load' );
					window.history.pushState('', '', '/inpack/shop/page/' + misha_loadmore_params.current_page);
				} else {
					button.remove(); // if no data, remove the button as well
				}
			}
		});
	});
});