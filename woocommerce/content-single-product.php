<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked woocommerce_output_all_notices - 10
 */
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}
?>
<?php echo get_template_part('template-parts/breadcrumbs') ?>

<section id="product-<?php the_ID(); ?>" <?php wc_product_class( 'product-page', $product ); ?>>
    <div class="container">
        <div class="row">
			<div class="col-4 product-page-left-col">
				<?php do_action( 'product_image' ); ?>
			</div>
			<div class="col-md-8 col-12 product-page-right-col">
                <div class="product-page-data-wrapper">
                    <div class="product-page-data">
                        <?php do_action('product_title'); ?>
						<?php 
							do_action('woocommerce_before_add_to_cart_button');
						?>
                        <div class="like-button"><?php echo do_shortcode( '[yith_wcwl_add_to_wishlist]' ) ?></div>
						<div class="mobile_product_image mobile">
							<?php do_action( 'product_image' ); ?>
						</div>
                        <div class="description">
                            <div class="description-title">Опис:</div>
                            <ul class="product-attributes">
								<?php do_action( 'woocommerce_product_additional_information', $product ); ?>
                            </ul>
                            <div class="description-text"><?php the_content() ?></div>
                        </div>
                        <div class="price h4">
                            Ціна: <?php do_action('product_price'); ?>
                        </div>
                        <div class="add-to-cart-button"><?php do_action('product_add_to_cart'); ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $id = get_the_ID() ?>
<section class="product-slider-section">
    <div class="container">
        <div class="h2">З цим товаром купують</div>
        <div class="product-slider">
			<?php 
			// параметры по умолчанию
			$posts = get_posts( array(
				'numberposts' => 6,
				'category'    => 0,
				'orderby'     => 'date',
				'order'       => 'DESC',
				'include'     => array(),
				'exclude'     => $id,
				'meta_key'    => '',
				'meta_value'  =>'',
				'post_type'   => 'product',
				'suppress_filters' => true, // подавление работы фильтров изменения SQL запроса
			) );

			foreach( $posts as $post ){
				setup_postdata($post);?>
					<?php
					global $product;

					// Ensure visibility.
					if ( empty( $product ) || ! $product->is_visible() ) {
						return;
					}
					?>
					<div <?php wc_product_class( 'product-slider-item', $product ); ?> style="display: block;">
						<a href="<?php the_permalink(); ?>" style="position: relative;">
							<div class="slider-item-image">
								<?php do_action( 'woocommerce_before_shop_loop_item_title' ); ?>
							</div>
							<div class="slider-item-body">
								<div class="product-title-wrapper"><?php do_action('product_title'); ?></div>
								<div class="price h4"><?php do_action( 'woocommerce_after_shop_loop_item_title' ) ?></div>
							</div>
							
							<div class="like-icon">
								<?php echo do_shortcode('[yith_wcwl_add_to_wishlist]') ?>
							</div>
							<div class="cart-icon">
								<?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
							</div>
						</a>
					</div>
					
				<?php
				}

			wp_reset_postdata(); // сброс
			?>
        </div>
    </div>

</section>
<?php //do_action( 'related_products' ); ?>
<?php //do_action( 'woocommerce_after_single_product' ); ?>

<script>
	jQuery(function(){

		jQuery('.quantity input[type="number"]').niceNumber();

	});
	jQuery('.quantity input[type="number"]').each(function(){
		var itemAttr = this.getAttribute('max');
		if(itemAttr == ""){
			this.removeAttribute('max');
		}
	});
	jQuery('.single_add_to_cart_button').click(function(){
		jQuery('.add_to_cart_popup').addClass('active');
	});
</script>
<?php 
/*
?><section class="add_to_cart_popup">
	<div class="popup_content">
		<div class="h2">Ваш товар додано у кошик!</div>
		<div class="popup_button">
			<a href="<?php echo get_home_uri() ?>/shop" class="back_to_shop">До каталогу товарів</a>
			<a href="<?php echo get_home_uri() ?>/cart" class="to_cart">Перейти у кошик</a>
		</div>
	</div>
</section>
<?php */ ?>