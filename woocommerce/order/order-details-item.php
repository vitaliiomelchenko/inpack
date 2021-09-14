<?php
/**
 * Order Item Details
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/order/order-details-item.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 5.2.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! apply_filters( 'woocommerce_order_item_visible', true, $item ) ) {
	return;
}
?>
<div class="<?php echo esc_attr( apply_filters( 'woocommerce_order_item_class', 'woocommerce-table__line-item order_item row', $item, $order ) ); ?>">

		<?php
		$is_visible        = $product && $product->is_visible();
		$product_permalink = apply_filters( 'woocommerce_order_item_permalink', $is_visible ? $product->get_permalink( $item ) : '', $item, $order );

		//echo wp_kses_post( apply_filters( 'woocommerce_order_item_name', $product_permalink ? sprintf( '<a href="%s">%s</a>', $product_permalink, $item->get_name() ) : $item->get_name(), $item, $is_visible ) );
		
		
		

		?>
		<div class="col-md-5 col-12 product-name--image-wrapper">
			<div class="product-image">
				<?php echo $product->get_image(); ?>
			</div>
			<div class="product-name">
				<?php echo $item->get_name(); ?>
			</div>
		</div>
		<div class="col-1 item_prce">
			<?php echo $product->get_price_html(); ?>
		</div>
		<div class="col-1 quantity">
			<?php echo $item->get_quantity() . ' шт'; ?>
		</div>
		<div class="col-1 subtotal">
			<?php echo $order->get_formatted_line_subtotal( $item );; ?>
		</div>
		<div class="col-4 product-details-button-wrapper">
			<div class="button"><a href="<?php echo wp_nonce_url( add_query_arg( 'order_again', $order->get_id(), wc_get_cart_url() ), 'woocommerce-order_again' ); ?>">Повторити замовлення</a></div>
		</div>
</div>

<div class="mobile_product_data_wrapper row">
	<div class="col-4 mobile_product_data">
		<div class="mobile_product_data_title">
			<?php _e('Ціна:') ?>
		</div>
		<div class="mobile_product_data_content">
			<?php echo $product->get_price_html(); ?>
		</div>
	</div>
	<div class="col-4 mobile_product_data">
		<div class="mobile_product_data_title">
			<?php _e('Кількість:') ?>
		</div>
		<div class="mobile_product_data_content">
			<?php echo $item->get_quantity() . ' шт'; ?>
		</div>
	</div>
	<div class="col-4 mobile_product_data">
		<div class="mobile_product_data_title">
			<?php _e('Сумма:') ?>
		</div>
		<div class="mobile_product_data_content">
			<?php echo $order->get_formatted_line_subtotal( $item );; ?>
		</div>
	</div>
</div>
