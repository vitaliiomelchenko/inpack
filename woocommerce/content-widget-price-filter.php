<?php
/**
 * The template for displaying product price filter widget.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-widget-price-filter.php
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.7.1
 */

defined( 'ABSPATH' ) || exit;

?>
<?php do_action( 'woocommerce_widget_price_filter_start', $args ); ?>

<form method="get" action="<?php echo esc_url( $form_action ); ?>">
	<div class="price_slider_wrapper">
		<div class="price_slider" style="display:none;"></div>
		<div class="price_slider_amount" data-step="<?php echo esc_attr( $step ); ?>">
			<?php 
				$args = array(
					'post_type' => 'product',
					'posts_per_page' => 1,
					'orderby'   => 'meta_value_num',
					'meta_key'  => '_price',
					'order' => 'ASC'
				);
				$query = new WP_Query( $args );
			?>
			<?php if($query->have_posts()): while($query->have_posts()): $query->the_post(); $product_id = get_the_ID(  ); $_product = wc_get_product( $product_id ); $min_price = $_product->get_price(); endwhile; endif; ?>
			<?php 
				$args = array(
					'post_type' => 'product',
					'posts_per_page' => 1,
					'orderby'   => 'meta_value_num',
					'meta_key'  => '_price',
					'order' => 'DESC'
				);
				$query = new WP_Query( $args );
			?>
			<?php if($query->have_posts()): while($query->have_posts()): $query->the_post(); $product_id = get_the_ID(  ); $_product = wc_get_product( $product_id ); $max_price = $_product->get_price(); endwhile; endif; ?>
					
			<input type="text" id="min_price" name="min_price" value="<?php echo esc_attr( $min_price ); ?>" data-min="<?php echo esc_attr( $min_price ); ?>" />
			<input type="text" id="max_price" name="max_price" value="<?php echo esc_attr( $max_price ); ?>" data-max="<?php echo esc_attr( $max_price ); ?>" />
			<?php /* translators: Filter: verb "to filter" */ ?>
			<button type="submit" class="button"><?php echo esc_html__( 'Ок', 'woocommerce' ); ?></button>
			<div class="price_label" style="display:none;">
				<?php echo esc_html__( 'Price:', 'woocommerce' ); ?> <span class="from"></span> &mdash; <span class="to"></span>
			</div>
			<?php echo wc_query_string_form_fields( null, array( 'min_price', 'max_price', 'paged' ), '', true ); ?>
			<div class="clear"></div>
		</div>
	</div>
	<div class="price-slider-wrapper" style="position: relative;">
		<div class="slider-track"></div>
		<input type="range" min="<?php echo $min_price ?>" max="<?php echo $max_price ?>" value="<?php echo $min_price; ?>" id="slider-1" oninput="slideOne()">
		<input type="range" min="<?php echo $min_price ?>" max="<?php echo $max_price ?>" value="<?php echo $max_price; ?>" id="slider-2" oninput="slideTwo()">
	</div>

</form>

<?php do_action( 'woocommerce_widget_price_filter_end', $args ); ?>
