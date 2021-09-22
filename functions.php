<?php
add_action( 'after_setup_theme', 'starter_setup' );
add_theme_support( 'custom-logo' );

function starter_setup(){
	load_theme_textdomain( 'starter', get_template_directory() . '/languages' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );
	global $content_width;
	if ( ! isset( $content_width ) ) $content_width = 640;

	//main menu
	register_nav_menus(
		array( 
			'header-menu'           => __( 'Меню в шапці' ),
			'lang-switcher'           => __( 'Перемикач мов' ),
      'footer-menu'           => __( 'Меню в підвалі'),
		)
	);
}

//load scripts and css for scripts
add_action( 'wp_enqueue_scripts', 'starter_load_scripts' );
function starter_load_scripts(){
	
	wp_enqueue_script( 'jquery' );

	/*theme external libraries*/
    wp_enqueue_script( 'lazy', get_template_directory_uri() . '/js/libs/jquery.lazy.min.js', false , false , true);
    wp_enqueue_script( 'imagesloaded', get_template_directory_uri() . '/js/libs/imagesloaded.pkgd.min.js', array('jquery') , false , true);
    wp_enqueue_script( 'waypoints', get_template_directory_uri() . '/js/libs/waypoints/jquery.waypoints.min.js',false , false , true);
    wp_enqueue_script( 'niceNumber', get_template_directory_uri() . '/js/jquery.nice-number.js');
    

	/*theme scripts*/
	wp_enqueue_script( 'main', get_template_directory_uri() . '/js/main.js', false , false , true);
  wp_localize_script( 'main', 'customjs_ajax_object',
    array( 
        'ajaxurl' => admin_url( 'admin-ajax.php' )
    )
  );
  //Slick JS
  wp_enqueue_script( 'slick-cdn', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js' );

	/*theme css*/
	wp_enqueue_style( 'main',get_template_directory_uri() . '/dist/main.min.css');

  /*additional css*/
    
}


//limit excerpt length
function excerpt($limit,$post_id=-1) {
  if($post_id==-1):
    $excerpt = explode(' ', get_the_excerpt(), $limit);
  else:
    $excerpt = explode(' ', get_the_excerpt($post_id), $limit);
  endif;
  if (count($excerpt)>=$limit) {
    array_pop($excerpt);
    $excerpt = implode(" ",$excerpt).'...';
  } else {
    $excerpt = implode(" ",$excerpt);
  } 
  $excerpt = preg_replace('`[[^]]*]`','',$excerpt);
  return $excerpt;
}


//ACF options page

if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page(array(
		'page_title' 	=> 'Поля для сторінок',
		'menu_title'	=> 'Поля для сторінок',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));
	
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Хедер',
		'menu_title'	=> 'Хедер',
		'menu_slug' 	=> 'header',
		'parent_slug'	=> 'theme-general-settings',
	));
	
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Футер',
		'menu_title'	=> 'Футер',
		'menu_slug' 	=> 'foter',
		'parent_slug'	=> 'theme-general-settings',
	));
  acf_add_options_page(array(
    'page_title'  => __('Scripts'),
    'menu_title'  => __('Scripts'),
    'parent_slug' => 'theme-general-settings',
  ));
}

function the_acf_loop(){
  get_template_part('template-parts/loop/acf-blocks','loop');
}

add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
  add_theme_support( 'woocommerce' );
}

if ( ! function_exists( 'woocommerce_template_loop_product_title' ) ) {

  /**
  * Show the product title in the product loop. By default this is an H2.
  */
  function woocommerce_template_loop_product_title() {
    echo '<div class="product-title h5 woocommerce-loop-product__title">' . get_the_title() . '</div>';
  }
}
if ( ! function_exists( 'woocommerce_template_single_title' ) ) {

  /**
  * Show the product title in the product loop. By default this is an H2.
  */
  function woocommerce_template_single_title() {
    echo '<div class="product-title h4 woocommerce-loop-product__title">' . get_the_title() . '</div>';
  }
}

add_action( 'widgets_init', 'register_my_widgets' );
function register_my_widgets(){

	register_sidebar( array(
		'name'          => "Ціна",
		'id'            => "price",
		'description'   => '',
		'class'         => '',
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget'  => "</li>\n",
		'before_title'  => '<h2 class="widgettitle">',
		'after_title'   => "</h2>\n",
		'before_sidebar' => '', // WP 5.6
		'after_sidebar'  => '', // WP 5.6
  ) );
  register_sidebar( array(
		'name'          => "Боковая панель магазина",
		'id'            => "shop-filters",
		'description'   => '',
		'class'         => '',
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget'  => "</li>\n",
		'before_title'  => '<h2 class="widgettitle">',
		'after_title'   => "</h2>\n",
		'before_sidebar' => '', // WP 5.6
		'after_sidebar'  => '', // WP 5.6
	) );
}
add_action( 'product_image' ,'woocommerce_show_product_images' );
add_action( 'product_title', 'woocommerce_template_single_title' );
add_action( 'product_price', 'woocommerce_template_single_price' );
add_action( 'product_add_to_cart', 'woocommerce_template_single_add_to_cart' );
add_action( 'related_products', 'woocommerce_output_related_products' );


add_filter( 'woocommerce_currency_symbol', 'change_currency_symbol', 10, 2 );

function change_currency_symbol( $symbols, $currency ) {
  if(is_account_page()){
    if ( 'UAH' === $currency ) {
      return '₴';
    }
  }
  else{
    if ( 'UAH' === $currency ) {
      return 'грн';
    }
  }


  return $symbols;
}



add_filter( 'loop_shop_per_page', 'lw_loop_shop_per_page', 30 );

function lw_loop_shop_per_page( $products ) {
 $products = 9;
 return $products;
}

add_action('woocommerce_before_add_to_cart_button','show_stock_single');
function show_stock_single() {
  global $product;
  if ( ! $product->managing_stock() && ! $product->is_in_stock() ){
    echo '<div class="stock out-of-stock">Немає в наявності</div>';
  }
  else{
    echo '<div class="stock in-stock">Є в наявності</div>';
  }
}

add_filter('woocommerce_get_availability_text', 'themeprefix_change_soldout', 10, 2 );

/**
* Change Sold Out Text to Something Else
*/
function themeprefix_change_soldout ( $text, $product) {
if ( !$product->is_in_stock() ) {
$text = '<a class="out-of-stock-button" href="#">Повідомити про наявність</a>';
}
return $text;
}


/*Katalog load more button*/
function misha_my_load_more_scripts() {
 
	global $wp_query; 
 
	// In most cases it is already included on the page and this line can be removed
	wp_enqueue_script('jquery');
 
	// register our main script but do not enqueue it yet
	wp_register_script( 'my_loadmore', get_stylesheet_directory_uri() . '/js/myloadmore.js', array('jquery') );
 
	// now the most interesting part
	// we have to pass parameters to myloadmore.js script but we can get the parameters values only in PHP
	// you can define variables directly in your HTML but I decided that the most proper way is wp_localize_script()
	wp_localize_script( 'my_loadmore', 'misha_loadmore_params', array(
		'ajaxurl' => site_url() . '/wp-admin/admin-ajax.php', // WordPress AJAX
		'posts' => json_encode( $wp_query->query_vars ), // everything about your loop is here
		'current_page' => get_query_var( 'paged' ) ? get_query_var('paged') : 1,
		'max_page' => $wp_query->max_num_pages,
	) );
 
 	wp_enqueue_script( 'my_loadmore' );
}
 
add_action( 'wp_enqueue_scripts', 'misha_my_load_more_scripts' );


function misha_loadmore_ajax_handler(){
 
	// prepare our arguments for the query
	$args = json_decode( stripslashes( $_POST['query'] ), true );
	$args['paged'] = $_POST['page'] + 1; // we need next page to be loaded
 
	// it is always better to use WP_Query but not here
	query_posts( $args );
 
	if( have_posts() ) :
 
		// run the loop
		while( have_posts() ): the_post();
 
			// look into your theme code how the posts are inserted, but you can use your own HTML of course
			// do you remember? - my example is adapted for Twenty Seventeen theme
			wc_get_template_part( 'content', 'product' );
			// for the test purposes comment the line above and uncomment the below one
			// the_title();
 
 
		endwhile;
	endif;
	die; // here we exit the script and even no wp_reset_query() required!
}
 
 
 
add_action('wp_ajax_loadmore', 'misha_loadmore_ajax_handler'); // wp_ajax_{action}
add_action('wp_ajax_nopriv_loadmore', 'misha_loadmore_ajax_handler'); // wp_ajax_nopriv_{action}



// ----- validate password match on the registration page
function registration_errors_validation($reg_errors, $sanitized_user_login, $user_email) {
	global $woocommerce;
	extract( $_POST );
	if ( strcmp( $password, $password2 ) !== 0 ) {
		return new WP_Error( 'registration-error', __( 'Passwords do not match.', 'woocommerce' ) );
	}
	return $reg_errors;
}
add_filter('woocommerce_registration_errors', 'registration_errors_validation', 10,3);

// ----- add a confirm password fields match on the registration page
function wc_register_form_password_repeat() {
	?>
	<p class="woocommerce-form-row form-row form-row-wide">
		<input type="password" class="input-text" name="password2" id="reg_password2" placeholder="Повторити пароль" value="" />
	</p>
	<?php
}
add_action( 'woocommerce_register_form', 'wc_register_form_password_repeat' );

// ----- Validate confirm password field match to the checkout page
function lit_woocommerce_confirm_password_validation( $posted ) {
    $checkout = WC()->checkout;
    if ( ! is_user_logged_in() && ( $checkout->must_create_account || ! empty( $posted['createaccount'] ) ) ) {
        if ( strcmp( $posted['account_password'], $posted['account_confirm_password'] ) !== 0 ) {
            wc_add_notice( __( 'Passwords do not match.', 'woocommerce' ), 'error' ); 
        }
    }
}
add_action( 'woocommerce_after_checkout_validation', 'lit_woocommerce_confirm_password_validation', 10, 2 );

// ----- Add a confirm password field to the checkout page
function lit_woocommerce_confirm_password_checkout( $checkout ) {
    if ( get_option( 'woocommerce_registration_generate_password' ) == 'no' ) {

        $fields = $checkout->get_checkout_fields();

        $fields['account']['account_confirm_password'] = array(
            'type'              => 'password',
            'label'             => __( 'Confirm password', 'woocommerce' ),
            'required'          => true,
            'placeholder'       => _x( 'Confirm Password', 'placeholder', 'woocommerce' )
        );

        $checkout->__set( 'checkout_fields', $fields );
    }
}
add_action( 'woocommerce_checkout_init', 'lit_woocommerce_confirm_password_checkout', 10, 1 );


add_filter( 'wc_add_to_cart_message_html', 'njengah_custom_added_to_cart_message' );
 
function njengah_custom_added_to_cart_message() {
	
	$message = get_template_part('template-parts/add_to_cart_message');
	
	return $message;
	
}


add_filter ( 'woocommerce_account_menu_items', 'misha_remove_my_account_links' );
function misha_remove_my_account_links( $menu_links ){
	
	unset( $menu_links['edit-address'] ); // Addresses
	unset( $menu_links['dashboard'] ); // Remove Dashboard
	unset( $menu_links['payment-methods'] ); // Remove Payment Methods
	unset( $menu_links['downloads'] ); // Disable Downloads
	unset( $menu_links['customer-logout'] ); // Remove Logout link
	
	return $menu_links;
	
}
//Adding New Label to product
add_action( 'woocommerce_before_shop_loop_item_title', 'bbloomer_new_badge_shop_page', 3 );
          
function bbloomer_new_badge_shop_page() {
   global $product;
   $label = get_field('new_label', 'option');
   $days_count = get_field('days_count', 'option');
   $newness_days = $days_count;
   $created = strtotime( $product->get_date_created() );
   if ( ( time() - ( 60 * 60 * 24 * $newness_days ) ) < $created ) {
      echo '<span class="itsnew new-label">' . esc_html__( $label, 'woocommerce' ) . '</span>';
   }
}

add_filter('woocommerce_sale_flash', 'woocommerce_custom_sale_text', 10, 3);
function woocommerce_custom_sale_text($text, $post, $_product)
{
    return '<span class="onsale">Акції</span>';
}


if ( ! function_exists( 'yith_wcwl_change_remove_from_list_label' ) ) {
	function yith_wcwl_change_remove_from_list_label() {
		return 'Видалити';
	}
	add_filter( 'yith_wcwl_remove_from_wishlist_label', 'yith_wcwl_change_remove_from_list_label' );
}

add_filter( 'woocommerce_order_item_name', 'display_product_image_in_order_item', 20, 3 );
function display_product_image_in_order_item( $item_name, $item, $is_visible ) {
    // Targeting view order pages only
    if( is_wc_endpoint_url( 'view-order' ) ) {
        $product   = $item->get_product(); // Get the WC_Product object (from order item)
        $thumbnail = $product->get_image(array( 150, 150)); // Get the product thumbnail (from product object)
        if( $product->get_image_id() > 0 )
            $item_name = '<div class="item-thumbnail" style="float:left;display:block;width:150px; margin-right:10px;" >' . $thumbnail . '</div>' . $item_name;
    }
    return $item_name;
}


add_filter('woocommerce_default_catalog_orderby', 'custom_catalog_ordering_args', 10, 1);
function custom_catalog_ordering_args( $orderby ) {
    // HERE define your product category slug
    $product_category = 'specials';  

    // Only for the defined product category archive page
    $orderby = 'popularity'; 
    return $orderby; 
}

//Checkout Aditional Fields 
function custom_checkout_fields($fields){
  $fields['payer_type'] = array(
    'type_1'          => array(
      'type'          => 'checkbox',
      'required'      => false,
      'label'         => __( 'Фізична особа' ),
    ),
    'type_2'          => array(
      'type'          => 'checkbox',
      'required'      => false,
      'label'         => __( 'Юридична особа' ),
    )
  );
  $fields['payment_method'] = array(
    'after_getting' => array(
      'type'      => 'checkbox',
      'required'  => false,
      'label'     => __( 'Оплата при отриманні' ),
    ),
    'by_cash_after_getting' => array(
      'type'      => 'checkbox',
      'required'  => false,
      'label'     => __( 'Оплата готівкою при отриманні' ),
    ),
    'by_card' => array(
      'type'      => 'checkbox',
      'required'  => false,
      'label'     => __( 'Оплата карткою' ),
    ),
    'transaction_on_company_account' => array(
      'type'      => 'checkbox',
      'required'  => false,
      'label'     => __( 'Оплата на рахунок компанії' ),
    ),
  );
  $fields['shipping_method'] = array(
    'self-pickup' => array(
      'label'     => 'Самовивіз',
      'type'      => 'checkbox',
      'required'  => false
    ),
    'Courier' => array(
      'label'     => 'Кур’єр',
      'type'      => 'checkbox',
      'required'  => false
    ),
  );
  $fields['courier_shipping_types'] = array(
    'nova_poshta' => array(
      'label'     => 'Доставка Нова Пошта',
      'type'      => 'checkbox',
      'required'  => false,
    ),
    'delivery' => array(
      'label'     => 'Доставка Делівері',
      'type'      => 'checkbox',
      'required'  => false,
    ),
    'meest_express' => array(
      'label'     => 'Доставка Meest express',
      'type'      => 'checkbox',
      'required'  => false,
    ),
    'justin' => array(
      'label'     => 'Доставка Justin',
      'type'      => 'checkbox',
      'required'  => false,
    ),
    'ukr_poshta' => array(
      'label'     => 'Доставка УКРПОШТА',
      'type'      => 'checkbox',
      'required'  => false,
    ),
    'by_courier' => array(
      'label'     => 'Кур’єр за вашою адресою',
      'type'      => 'checkbox',
      'required'  => false,
    ),
    'customer_address' => array(
      'label'     => 'Вулиця',
      'type'      => 'text',
      'required'  => false,
    ),
    'house_number' => array(
      'label'     => 'Будинок',
      'type'      => 'text',
      'required'  => false,
    ),
    'flat_number' => array(
      'label'     => 'Квартира',
      'type'      => 'text',
      'required'  => false,
    ),
  );
  return $fields;
}
add_filter( 'woocommerce_checkout_fields', 'custom_checkout_fields' );
function extra_shipping_types(){
  $checkout = WC()->checkout(); ?>
  <div class="col2-set">
    <?php foreach ( $checkout->checkout_fields['courier_shipping_types'] as $key => $field ) : ?>
        <?php woocommerce_form_field( $key, $field, $checkout->get_value( $key ) ); ?>
    <?php endforeach; ?>
  </div>
<?php }
add_action( 'extra_shipping_types_a' , 'extra_shipping_types' );

function payer_type_extra_checkout_fields(){
  $checkout = WC()->checkout(); ?>
  <div class="col2-set">
  <div class="chekout_col_title_wrapper"><span class="col-number">1</span><div class="chekout_col_title"><?php _e( 'Тип платника' ); ?></div></div>
  <?php
     foreach ( $checkout->checkout_fields['payer_type'] as $key => $field ) : ?>
          <?php woocommerce_form_field( $key, $field, $checkout->get_value( $key ) ); ?>
      <?php endforeach; ?>
  </div>
<?php }
add_action( 'payer_type_checkout_fields' , 'payer_type_extra_checkout_fields' );

function payment_method_fields() {
  $checkout = WC()->checkout(); ?>
  <div class="col2-set">
  <div class="chekout_col_title_wrapper"><span class="col-number">4</span><div class="chekout_col_title"><?php _e( 'Оберіть спосіб оплати' ); ?></div></div>
  <?php
    foreach ( $checkout->checkout_fields['payment_method'] as $key => $field ) : ?>
          <?php woocommerce_form_field( $key, $field, $checkout->get_value( $key ) ); ?>
      <?php endforeach; ?>
  </div>
<?php 
}
add_action( 'payment_method_extra_feilds', 'payment_method_fields');

function shipping_method_feilds() {
  $checkout = WC()->checkout(); ?>
  <div class="col2-set">
  <div class="chekout_col_title_wrapper"><span class="col-number">3</span><div class="chekout_col_title"><?php _e( 'Оберіть тип доставки' ); ?></div></div>
  <?php
    foreach ( $checkout->checkout_fields['shipping_method'] as $key => $field ) : ?>
          <?php woocommerce_form_field( $key, $field, $checkout->get_value( $key ) ); ?>
      <?php endforeach; ?>
  </div>
<?php 
}
add_action( 'shipping_method_extra_feilds', 'shipping_method_feilds');

// saving data
function vicodemedia_save_extra_checkout_fields( $order_id, $posted ){
  // don't forget appropriate sanitization
  if( isset( $posted['type_1'] ) ) {
    update_post_meta( $order_id, '_type_1', sanitize_text_field( $posted['type_1'] ) );
  }
  if( isset( $posted['type_2'] ) ) {
    update_post_meta( $order_id, '_type_2', sanitize_text_field( $posted['type_2'] ) );
  }
  if( isset( $posted['after_getting'] ) ) {
    update_post_meta( $order_id, '_after_getting', sanitize_text_field( $posted['after_getting'] ) );
  }
  if( isset( $posted['by_cash_after_getting'] ) ) {
    update_post_meta( $order_id, '_by_cash_after_getting', sanitize_text_field( $posted['by_cash_after_getting'] ) );
  }
  if( isset( $posted['by_card'] ) ) {
    update_post_meta( $order_id, '_by_card', sanitize_text_field( $posted['by_card'] ) );
  }
  if( isset( $posted['transaction_on_company_account'] ) ) {
    update_post_meta( $order_id, '_transaction_on_company_account', sanitize_text_field( $posted['transaction_on_company_account'] ) );
  }
  if( isset( $posted['nova_poshta'] ) ) {
    update_post_meta( $order_id, '_nova_poshta', sanitize_text_field( $posted['nova_poshta'] ) );
  }
  if( isset( $posted['delivery'] ) ) {
    update_post_meta( $order_id, '_delivery', sanitize_text_field( $posted['delivery'] ) );
  }
  if( isset( $posted['meest_express'] ) ) {
    update_post_meta( $order_id, '_meest_express', sanitize_text_field( $posted['meest_express'] ) );
  }
  if( isset( $posted['justin'] ) ) {
    update_post_meta( $order_id, '_justin', sanitize_text_field( $posted['justin'] ) );
  }
  if( isset( $posted['ukr_poshta'] ) ) {
    update_post_meta( $order_id, '_ukr_poshta', sanitize_text_field( $posted['ukr_poshta'] ) );
  }
  if( isset( $posted['by_courier'] ) ) {
    update_post_meta( $order_id, '_by_courier', sanitize_text_field( $posted['by_courier'] ) );
  }
  if( isset( $posted['customer_address'] ) ) {
    update_post_meta( $order_id, '_customer_address', sanitize_text_field( $posted['customer_address'] ) );
  }
  if( isset( $posted['house_number'] ) ) {
    update_post_meta( $order_id, '_house_number', sanitize_text_field( $posted['house_number'] ) );
  }
  if( isset( $posted['flat_number'] ) ) {
    update_post_meta( $order_id, '_flat_number', sanitize_text_field( $posted['flat_number'] ) );
  }
  if( isset( $posted['self-pickup'] ) ) {
    update_post_meta( $order_id, '_self-pickup', sanitize_text_field( $posted['self-pickup'] ) );
  }
  if( isset( $posted['Courier'] ) ) {
    update_post_meta( $order_id, '_Courier', sanitize_text_field( $posted['Courier'] ) );
  }
}
add_action( 'woocommerce_checkout_update_order_meta', 'vicodemedia_save_extra_checkout_fields', 10, 2 );

// display data on the Dashboard WC order details page
function vicodemedia_display_order_data_in_admin( $order ){  ?>
  <div class="order_data_column" style="display: flex; width: 100%;">
      <h4 style="margin-top: 20px;"><?php _e( 'Тип платника:', 'woocommerce' ); ?></h4>
      <div class="address" style="margin-left: 5px;">
      <?php if(!empty(get_post_meta( $order->id, '_type_1', true ))): ?>
        <?php
            echo '<p style="margin-top: 20px; margin-bottom: 0;"><strong>' . __( 'Фізична особа' ) . '</strong></p>'; ?>
        </div>
        <div class="edit_address">
            <?php woocommerce_wp_text_input( array( 'id' => '_type_1', 'label' => __( 'Фізична особа' ), 'wrapper_class' => '_billing_company_field' ) ); ?>
        </div>
      <?php elseif(!empty(get_post_meta( $order->id, '_type_2', true ))): ?>
        <?php
          echo '<p style="margin-top: 20px; margin-bottom: 0;"><strong>' . __( 'Юридична особа' ) . '</strong></p>'; ?>
        </div>
        <div class="edit_address">
          <?php woocommerce_wp_text_input( array( 'id' => '_type_2', 'label' => __( 'Юридична особа' ), 'wrapper_class' => '_billing_company_field' ) ); ?>
        </div>
      <?php endif; ?>
      <a href="#" class="edit_address" style="display: block; margin-top: 22px; margin-left: 2px;"><?php _e( 'Edit', 'woocommerce' ); ?></a>
  </div>
  <div class="order_data_column" style="display: flex; width: 100%;">
      <h4 style="margin-top: 20px;"><?php _e( 'Тип доставки:', 'woocommerce' ); ?></h4>
      <div class="address" style="margin-left: 5px;">
      <?php if(!empty(get_post_meta( $order->id, '_self-pickup', true ))): ?>
        <?php
            echo '<p style="margin-top: 20px; margin-bottom: 0;"><strong>' . __( ' Самовивіз' ) . '</strong></p>'; ?>
        </div>
        <div class="edit_address">
            <?php woocommerce_wp_text_input( array( 'id' => '_self-pickup', 'label' => __( ' Самовивіз' ), 'wrapper_class' => '_billing_company_field' ) ); ?>
        </div>
      <?php elseif(!empty(get_post_meta( $order->id, '_Courier', true ))): ?>
        <?php
          echo '<p style="margin-top: 20px; margin-bottom: 0;"><strong>' . __( "Кур`єр" ) . '</strong></p>'; ?>
        </div>
        <div class="edit_address">
          <?php woocommerce_wp_text_input( array( 'id' => '_Courier', 'label' => __( "Кур`єр" ), 'wrapper_class' => '_billing_company_field' ) ); ?>
        </div>
      <?php else: ?>
        </div>
      <?php endif; ?>
      <a href="#" class="edit_address" style="display: block; margin-top: 22px; margin-left: 2px;"><?php _e( 'Edit', 'woocommerce' ); ?></a>
  </div>
  <div class="order_data_column" style="display: flex; width: 100%;flex-wrap:wrap;">
      <div class="address" style="margin-left: 5px; width: 100%; margin-top: 5px;">
      <?php if(!empty(get_post_meta( $order->id, '_nova_poshta', true ))): ?>
        <?php
            echo '<p style="margin-top: 20px; margin-bottom: 0;"><strong>' . __( ' Доставка Нова Пошта' ) . '</strong></p>'; ?>
        </div>
        <div class="edit_address">
            <?php woocommerce_wp_text_input( array( 'id' => '_nova_poshta', 'label' => __( ' Доставка Нова Пошта' ), 'wrapper_class' => '_billing_company_field' ) ); ?>
        </div>
      <?php elseif(!empty(get_post_meta( $order->id, '_delivery', true ))): ?>
        <?php
          echo '<p style="margin-top: 20px; margin-bottom: 0;"><strong>' . __( "Доставка Делівері" ) . '</strong></p>'; ?>
        </div>
        <div class="edit_address">
          <?php woocommerce_wp_text_input( array( 'id' => '_delivery', 'label' => __( "Доставка Делівері" ), 'wrapper_class' => '_billing_company_field' ) ); ?>
        </div>
      <?php elseif(!empty(get_post_meta( $order->id, '_meest_express', true ))): ?>
        <?php
          echo '<p style="margin-top: 20px; margin-bottom: 0;"><strong>' . __( "Доставка Meest express" ) . '</strong></p>'; ?>
        </div>
        <div class="edit_address">
          <?php woocommerce_wp_text_input( array( 'id' => '_meest_express', 'label' => __( "Доставка Meest express" ), 'wrapper_class' => '_billing_company_field' ) ); ?>
        </div>
      <?php elseif(!empty(get_post_meta( $order->id, '_justin', true ))): ?>
        <?php
          echo '<p style="margin-top: 20px; margin-bottom: 0;"><strong>' . __( "Доставка Justin" ) . '</strong></p>'; ?>
        </div>
        <div class="edit_address">
          <?php woocommerce_wp_text_input( array( 'id' => '_justin', 'label' => __( "Доставка Justin" ), 'wrapper_class' => '_billing_company_field' ) ); ?>
        </div>
      <?php elseif(!empty(get_post_meta( $order->id, '_ukr_poshta', true ))): ?>
        <?php
          echo '<p style="margin-top: 20px; margin-bottom: 0;"><strong>' . __( "Доставка УКРПОШТА" ) . '</strong></p>'; ?>
        </div>
        <div class="edit_address">
          <?php woocommerce_wp_text_input( array( 'id' => '_ukr_poshta', 'label' => __( "Доставка УКРПОШТА" ), 'wrapper_class' => '_billing_company_field' ) ); ?>
        </div>
      <?php elseif(!empty(get_post_meta( $order->id, '_by_courier', true ))): ?>
        <?php
          echo '<p style="margin-top: 20px; margin-bottom: 0;"><strong>' . __( "Кур’єр за адресою" ) . '</strong></p>'; ?>
        </div>
        <div class="edit_address">
          <?php woocommerce_wp_text_input( array( 'id' => '_by_courier', 'label' => __( "Кур’єр за адресою" ), 'wrapper_class' => '_billing_company_field' ) ); ?>
        </div>
      <?php endif; ?>
      <div class="address" style="margin-left: 5px;">
        <div style="display:flex;"><strong>Вулиця:</strong><p style="margin: 0;margin-left: 5px"><?php echo get_post_meta($order->id, '_customer_address', true) . '<br>'; ?></p></div>
        <div style="display:flex;"><strong>Будинок:</strong><p style="margin: 0;margin-left: 5px"><?php echo get_post_meta($order->id, '_house_number', true) . '<br>'; ?></p></div>
        <div style="display:flex;"><strong>Квартира:</strong><p style="margin: 0;margin-left: 5px"><?php echo get_post_meta($order->id, '_flat_number', true) . '<br>'; ?></p></div>
      </div>
      <a href="#" class="edit_address" style="display: block; margin-top: 22px; margin-left: 2px;"><?php _e( 'Edit', 'woocommerce' ); ?></a>
  </div>
  <div class="order_data_column payment_method_data" style="display: flex; width: 100%;">
      <h4 style="margin-top: 20px;"><?php _e( 'Cпосіб оплати:', 'woocommerce' ); ?></h4>
      <div class="address" style="margin-left: 5px;">
      <?php if(!empty(get_post_meta( $order->id, '_after_getting', true ))): ?>
        <?php
            echo '<p style="margin-top: 20px; margin-bottom: 0;"><strong>' . __( 'Оплата при отриманні' ) . '</strong></p>'; ?>
        </div>
        <div class="edit_address">
            <?php woocommerce_wp_text_input( array( 'id' => '_after_getting', 'label' => __( 'Оплата при отриманні' ), 'wrapper_class' => '_billing_company_field' ) ); ?>
        </div>
      <?php elseif(!empty(get_post_meta( $order->id, '_by_cash_after_getting', true ))): ?>
        <?php
          echo '<p style="margin-top: 20px; margin-bottom: 0;"><strong>' . __( 'Оплата готівкою при отриманні' ) . '</strong></p>'; ?>
        </div>
        <div class="edit_address">
          <?php woocommerce_wp_text_input( array( 'id' => '_by_cash_after_getting', 'label' => __( 'Оплата готівкою при отриманні' ), 'wrapper_class' => '_billing_company_field' ) ); ?>
        </div>
      <?php elseif(!empty(get_post_meta( $order->id, '_by_card', true ))): ?>
        <?php
          echo '<p style="margin-top: 20px; margin-bottom: 0;"><strong>' . __( 'Оплата карткою' ) . '</strong></p>'; ?>
        </div>
        <div class="edit_address">
          <?php woocommerce_wp_text_input( array( 'id' => '_by_card', 'label' => __( 'Оплата карткою' ), 'wrapper_class' => '_billing_company_field' ) ); ?>
        </div>
      <?php elseif(!empty(get_post_meta( $order->id, '_transaction_on_company_account', true ))): ?>
        <?php
          echo '<p style="margin-top: 20px; margin-bottom: 0;"><strong>' . __( 'Оплата на рахунок компанії' ) . '</strong></p>'; ?>
        </div>
        <div class="edit_address">
          <?php woocommerce_wp_text_input( array( 'id' => '_transaction_on_company_account', 'label' => __( 'Оплата на рахунок компанії' ), 'wrapper_class' => '_billing_company_field' ) ); ?>
        </div>
      <?php endif; ?>
      <a href="#" class="edit_address" style="display: block; margin-top: 22px; margin-left: 2px;"><?php _e( 'Edit', 'woocommerce' ); ?></a>
  </div>
<?php }
add_action( 'woocommerce_admin_order_data_after_order_details', 'vicodemedia_display_order_data_in_admin' );

function vicodemedia_save_extra_details( $post_id, $post ){
  update_post_meta( $post_id, '_vicodemedia_add_field', wc_clean( $_POST[ '_vicodemedia_add_field' ] ) );
}
// save data from admin
add_action( 'woocommerce_process_shop_order_meta', 'vicodemedia_save_extra_details', 45, 2 );

add_filter( 'woocommerce_checkout_fields' , 'override_billing_checkout_fields', 20, 1 );
function override_billing_checkout_fields( $fields ) {
    $fields['billing']['billing_first_name']['placeholder'] = 'Ім’я';
    $fields['billing']['billing_last_name']['placeholder'] = 'Прізвище';
    $fields['billing']['billing_phone']['placeholder'] = 'Номер телефона';
    return $fields;
}

add_filter( 'woocommerce_checkout_fields' , 'custom_override_checkout_fields' );
add_filter( 'woocommerce_billing_fields' , 'custom_override_billing_fields' );
add_filter( 'woocommerce_shipping_fields' , 'custom_override_shipping_fields' );

function custom_override_checkout_fields( $fields ) {
    unset($fields['billing']['billing_company']);
    unset($fields['billing']['billing_address_1']);
    unset($fields['billing']['billing_address_2']);
    unset($fields['billing']['billing_city']);
    unset($fields['billing']['billing_postcode']);
    unset($fields['billing']['billing_country']);
    unset($fields['billing']['billing_state']);
    unset($fields['order']['order_comments']);
    unset($fields['billing']['billing_email']);
    unset($fields['account']['account_username']);
    unset($fields['account']['account_password']);
    unset($fields['account']['account_password-2']);
    
    return $fields;
}

function custom_override_billing_fields( $fields ) {
    unset($fields['billing_company']);
    unset($fields['billing_country']);
    unset($fields['billing_address_2']);
    unset($fields['billing_postcode']);
    unset($fields['billing_city']);
    unset($fields['billing_state']);
    
    return $fields;
}

function custom_override_shipping_fields( $fields ) {
    unset($fields['shipping_company']);
    unset($fields['shipping_country']);
    return $fields;
}


 /** Product per page woocommerce */

add_action( 'woocommerce_count_filter', 'ps_selectbox', 45 );
function ps_selectbox() {
    $per_page = filter_input(INPUT_GET, 'perpage', FILTER_SANITIZE_NUMBER_INT);     
    echo '<ul class="filter-list">';   
    $orderby_options = array(
        '9' => '9',
        '15' => '15',
        '30' => '30'
    );
    foreach( $orderby_options as $value => $label ) {
        echo "<li class='perpage perpage-$value'><a href='?perpage=$value'>$label<a></li>";
    }
    echo '</ul>';
}

add_action( 'pre_get_posts', 'ps_pre_get_products_query' );
function ps_pre_get_products_query( $query ) {
   $per_page = filter_input(INPUT_GET, 'perpage', FILTER_SANITIZE_NUMBER_INT);
   if( $query->is_main_query() && !is_admin() && is_post_type_archive( 'product' ) ){
        $query->set( 'posts_per_page', $per_page );
    }
}