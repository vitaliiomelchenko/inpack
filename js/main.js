var $ = jQuery;

//nav
$('#nav-toggle').on('click',function(){
	$('header').toggleClass('header-active');
});
$('.nav-close').on('click',function(){
	$('header').removeClass('header-active');
});

$('.menu-item__parent').each(function(){
  let btn = $(this).find('.menu-item__icon');
  let btnLink = btn.prev();
  let subNav = $(this).find('.sub-menu');
  btn.on('click',function(e){
    if($(window).width()<992){
      e.preventDefault();
      subNav.slideToggle();
    }
  });
  btnLink.on('click',function(e){
    if($(window).width()<992){
      e.preventDefault();
      subNav.slideToggle();
    }
  });
})

//header white
if($(".header__white").length){
  $(function() {
    $(window).on("scroll", function() {
        if($(window).scrollTop() > 50) {
            $("#header").addClass("scrolled");
        } else {
            //remove the background property so it comes transparent again (defined in your css)
          $("#header").removeClass("scrolled");
        }
    });
  });
}


//lazy loading
function lazyInit(){
    $('.lazy-img').Lazy({
        afterLoad: function(element){
            imagesLoaded(element,function(){
                element.parent().addClass('loaded');
            });
        }
    });
}
lazyInit();
//smooth scroll to anchor
$(document).on('click', 'a[href^="#"]', function (event) {
    event.preventDefault();

    $('html, body').animate({
        scrollTop: $($.attr(this, 'href')).offset()
    }, 500);
});

//animations

//appearence animation on scroll
$('.appear').each(function() {
    let el = $(this);
    let inview = el.waypoint(function(direction) {
        el.addClass('visible');
    }, {
        offset: '95%'
    });
});

$('.katalog-items .product').each(function(){
  var newLabel = $(this).find('.new-label').length;
  if(newLabel > 0 ){
    $(this).addClass('new-product');
    var aditionalOffset = 10;
  }
});

jQuery(window).on('load', function(){
  if(jQuery('.page-numbers li a').hasClass('next')){
    jQuery('.show-more-button').css('display', 'block');  
  }
});

/*Product Slider */
$('.product-slider').slick({
  slidesToShow: 4,
  slidesToScroll: 1,
  responsive: [
    {
      breakpoint: 992,
      settings: {
        slidesToShow: 2,
      }
    },
    {
      breakpoint: 768,
      settings: {
        arrows: false,
        slidesToShow: 2,
        dots: true,
        slidesToScroll: 2,
      }
    },
  ]
});


/*Price Range Script*/
$(function() {
  var maxPrice = $('.wpf_slider').attr('data-max');
  var minPrice = $('.wpf_slider').attr('data-min');
  var firstItemValue = $('.wpf_price_from').attr('value');
  var secondItemValue = $('.wpf_price_to').attr('value');
  $('.wpf_price_from').attr("type", "number");
  $('.wpf_price_to').attr("type", "number");
  if(firstItemValue == ""){
    $('.wpf_price_from').attr("value", minPrice); 
  }
  if(secondItemValue == ""){
    $('.wpf_price_to').attr("value", maxPrice); 
  }
});


/*Filter Sidebar */
$(window).on('load', function() {
  $('.wpf_hierachy li').has('ul').addClass('has_child');
  $('.wpf_hierachy li.has_child label').click(function(event){
    event.preventDefault();
    $(this).toggleClass('open');
    $(this).parent().find('.wpf_submenu').slideToggle();
  });
  $('.product_attributes .wpf_items_wrapper ul li input[checked="checked"]').addClass('checked');
  $('.product_attributes .wpf_items_wrapper ul li label').click(function(){
    $(this).parent().find('input').toggleClass('checked');
  });
});
$(window).on('load', function() {
  var w = $(window).width();
  $('.filters .wpf_item_name').click(function(){
    $(this).toggleClass('open');
    if( w > 992 ){
      $(this).parent().find('.wpf_column_horizontal').slideToggle();
    }
    else{
      var openedAttributeItemTitle = $('.filters .wpf_item_name.open').html();
      var filterTitle = $('.filter_title');
      $(filterTitle).html(openedAttributeItemTitle);
    }
  });
  if(w <= 992 ){
    var filterTitle = $('.filter_title');
    $(filterTitle).click(function(){
      var openedElement = $('.wpf_item_name.open').size();
      if(openedElement == 1){
        $(this).parent().find('.wpf_item_name.open').removeClass('open');
        $(this).html('Фільтр');
      }
      if( openedElement == 0 ){
        $('body').removeClass('opened_filter_menu');
        $('.filter_wrapper.filters').removeClass('opened');
      }
    });
  }
});

/*Log-in and register popup */
$(document).ready(function(){
  var link = $('.kabinet').attr('href');
  var w = $(window).width();
  if(link == "#"){
    $('.kabinet').click(function(){
      $('body').addClass('open-popup');
      $('body').addClass('log-in-popup');
      if(w <= 768){
        $('.header .mobile_menu').slideUp();
      }
    });
  };
  $('.close-icon').click(function(){
    $('body').removeClass('open-popup');
    $('body').removeClass('log-in-popup');
    $('body').removeClass('register');
  });

});

$('.not-registered a').click(function(){
  $('body').addClass('register-popup');
  $('body').removeClass('log-in-popup');
});
$('.registered a').click(function(){
  $('body').addClass('log-in-popup');
  $('body').removeClass('register-popup');
});

$('.form-checkbox').click(function(){
  if($('.form-checkbox input').is(':checked')){
    $('.woocommerce-form-register__submit').removeAttr('disabled');
    $('.form-checkbox').addClass('active-checkbox');
  }
  else{
    $('.woocommerce-form-register__submit').attr('disabled', '');
    $('.form-checkbox').removeClass('active-checkbox');
  }
});

/*Product add to cart popup */
$(document).ready(function(){
  var popup = $('.add_to_cart_popup_wrapper').length;
  if(popup > 0){
    $('body').addClass('open-popup');
  };
  $('.overlay').click(function(){
    $('body').removeClass('open-popup');
    $('.add_to_cart_popup_wrapper').css('z-index', '-1');
  });
});


//Orders page 
$(document).ready(function(){
  var orderTotal = $('.woocommerce-orders').find('.order-total');
  var orderTotalHeight = orderTotal.height();
  var w = $(window).width();
  if(orderTotalHeight > 28){
    $(orderTotal).css('text-align', 'center');
  }
  $('.woocommerce-orders .show_delails_button_wrapper').click(function(){
    $('.woocommerce-orders .opened-order').not($(this).closest('.woocommerce-orders-table__row').find('.opened-order')).slideUp();
    $('.woocommerce-orders .closed-order').not($(this).closest('.woocommerce-orders-table__row').find('.closed-order')).slideDown(function(){
      $(this).animate({
        opacity: 1,
      }, 500, function() {
        // Animation complete.
      }); 
    });
    $(this).addClass('opened');
    if(w > 992){
      $('.woocommerce-MyAccount-content').addClass('opened-details');
      $(this).closest('.woocommerce-orders-table__row').find('.closed-order').slideUp(function(){
        $(this).animate({
          opacity: 0,
        }, 500, function(){
          
        });
      });
    }
    if( w > 992 ){
      $(this).closest('.woocommerce-orders-table__row').find('.opened-order').slideDown();
    }
    else{
      $(this).closest('.woocommerce-orders-table__row').find('.opened-order').slideToggle();
    }
  });
  $('.woocommerce-orders .close-details-button img').click(function(){
    $(this).closest('.woocommerce-orders-table__row').find('.closed-order').slideDown(function(){
      $(this).animate({
        opacity: 1,
      }, 500, function() {
        // Animation complete.
      });
    });
    $(this).closest('.woocommerce-orders-table__row').find('.opened-order').slideUp();
    $('.woocommerce-MyAccount-content').removeClass('opened-details');
  });
});


//Checkout Aditional Fields 
$(document).ready(function(){
  $('.woocommerce-checkout .checkboxes_wrapper').each(function(){
    var checkboxWrapper = $(this);
    $(checkboxWrapper).find('.input-checkbox').each(function(){
      var fieldId = $(this).attr('id');
      $(this).parent().attr('for', fieldId);
    });
    $(this).find('label.checkbox').click(function(){
      $(checkboxWrapper).find('label.checkbox').not(this).find('.input-checkbox').prop('checked', false);
      $(checkboxWrapper).find('.input-checkbox').parent().removeClass('checked');
      if($(this).find('.input-checkbox').is(':checked')){
        $(this).addClass('checked');
      };
      $('.required-checkbox').each(function(){
        if($(this).hasClass('checked')){
          $('body').addClass('delete-disable-class');
        }
      });
      var payerType = $('.payer_type_wrapper .checkbox .input-checkbox');
      var shipping_method = $('.shipping_method .checkbox .input-checkbox');
      var payment_method = $('.payment_method .checkbox .input-checkbox');
      if($(payerType).is(':checked') && $(shipping_method).is(':checked') && $(payment_method).is(':checked')){
        $('#place_order').removeAttr('disabled');
      }
    });
  });
});

//Header 
$(document).ready(function(){
  var headerKatalogButton = $('header').find('.katalog');
  var katalogMenuWrapper = $('header').find('.katalog-menu-wrapper');
  var headerCloseIcon = $('header').find('.close-menu-icon');
  $(headerKatalogButton).click(function(){
    $(katalogMenuWrapper).slideToggle();
  });
  $(headerCloseIcon).click(function(){
    $(katalogMenuWrapper).slideUp();
  });
  var headerMobileOpenButton = $('header').find('.mobile_menu_open_button');
  var headerMobileMenu = $('header').find('.mobile_menu');
  var headerMobileCloseButton = $(headerMobileMenu).find('.mobile_menu_close_button');
  $(headerMobileOpenButton).click(function(){
    $(headerMobileMenu).slideDown();
  });
  $(headerMobileCloseButton).click(function(){
    $(headerMobileMenu).slideUp();
  });
});


//Mobile sort by list 
$(document).ready(function(){
  var w = $(window).width();
  if(w <= 992) {
    $('.woocommerce-shop .sort_by').click(function(event){
      $(this).find('.filter-list').slideToggle();
      $(this).find('.filter-title').toggleClass('opened_list');
    });
    $('.woocommerce-shop .top-filter-row .mobile_open_filter_button').click(function(){
      $('body').addClass('opened_filter_menu');
      $('body .filter-col .filter_wrapper.filters').addClass('opened');
      $('.opened_filter_menu .overlay').click(function(){
        $('body .filter-col .filter_wrapper.filters').removeClass('opened');
        $('body').removeClass('opened_filter_menu');
      });
    });
  }
});

$(document).ready(function(){
  $('.clear-search-field').click(function(){
    $('.is-search-input').val('');
  });
  $('.search-arrow').click(function(){
    $('body').removeClass('active-search');
    $('.is-search-input').val('');
  });
})

//Contact form popup
$(document).ready(function(){
  $('.header .header-bottom .icons .list').click(function(){
    $('body').addClass('opened_contactForm_popup');
    $('body.opened_contactForm_popup .overlay').click(function(){
      $('body').removeClass('opened_contactForm_popup');
    });
    $('body.opened_contactForm_popup .contact_form_wrapper .close_popup_cross').click(function(){
      $('body').removeClass('opened_contactForm_popup');
    });
  });
}); 