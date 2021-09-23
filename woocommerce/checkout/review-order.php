<?php
/**
 * Review order table
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/review-order.php.
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

defined( 'ABSPATH' ) || exit;
?>
<?php 
if(get_locale() == 'uk'){
	$subtotalLabel = 'Товарів на сумму:';
	$totalLabel = 'До сплати:';
	$shippingPrice = 'За тарифами перевізника';
	$shippingPriceLabel = 'Вартість доставки:';
}
elseif(get_locale() == 'ru_RU'){
	$subtotalLabel = 'Товаров на сумму:';
	$totalLabel = 'К оплате:';
	$shippingPrice = 'По тарифам перевозчика';
	$shippingPriceLabel = 'Стоимость доставки:';
} 
?>
<div class="shop_table woocommerce-checkout-review-order-table">
	<div class="cart-subtotal review_order_row">
		<div class="review_order_row_title"><?php echo $subtotalLabel; ?> </div>
		<div class="review_order_row_data"><?php wc_cart_totals_subtotal_html(); ?></div>
	</div>
	<?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>
		<div class=" review_order_rowcart-discount coupon-<?php echo esc_attr( sanitize_title( $code ) ); ?>">
			<div class="review_order_row_title"><?php wc_cart_totals_coupon_label( $coupon ); ?></div>
			<div class="review_order_row_data"><?php wc_cart_totals_coupon_html( $coupon ); ?></div>
		</div>
	<?php endforeach; ?>
	<?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>
		<?php /*do_action( 'woocommerce_review_order_before_shipping' ); ?>
		<?php wc_cart_totals_shipping_html(); ?>
		<?php do_action( 'woocommerce_review_order_after_shipping' );*/ ?>
		<div class="shipping review_order_row">
			<div class="review_order_row_title"><?php echo $shippingPriceLabel; ?></div>
			<div class="review_order_row_data"><?php echo $shippingPrice; ?></div>
		</div>
	<?php endif; ?>
	<?php foreach ( WC()->cart->get_fees() as $fee ) : ?>
		<div class="fee">
			<div class="review_order_row_title"><?php echo esc_html( $fee->name ); ?></div>
			<div class="review_order_row_data"><?php wc_cart_totals_fee_html( $fee ); ?></div>
		</div>
	<?php endforeach; ?>
	<?php if ( wc_tax_enabled() && ! WC()->cart->display_prices_including_tax() ) : ?>
		<?php if ( 'itemized' === get_option( 'woocommerce_tax_total_display' ) ) : ?>
			<?php foreach ( WC()->cart->get_tax_totals() as $code => $tax ) : // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited ?>
				<div class="tax-rate review_order_row tax-rate-<?php echo esc_attr( sanitize_title( $code ) ); ?>">
					<div class="review_order_row_title"><?php echo esc_html( $tax->label ); ?></div>
					<div class="review_order_row_data"><?php echo wp_kses_post( $tax->formatted_amount ); ?></div>
				</div>
			<?php endforeach; ?>
		<?php else : ?>
			<div class="tax-total review_order_row">
				<div class="review_order_row_title"><?php echo esc_html( WC()->countries->tax_or_vat() ); ?></div>
				<div class="review_order_row_data"><?php wc_cart_totals_taxes_total_html(); ?></div>
			</div>
		<?php endif; ?>
	<?php endif; ?>
	<?php do_action( 'woocommerce_review_order_before_order_total' ); ?>
	<div class="order-total review_order_row">
		<div class="review_order_row_title"><?php echo $totalLabel; ?></div>
		<div class="review_order_row_data"><?php wc_cart_totals_order_total_html(); ?></div>
	</div>
	<?php do_action( 'woocommerce_review_order_after_order_total' ); ?>
	<?php 
		if(get_locale() == 'uk'){
			$buttonLabel = 'Оформити замовлення';
		}
		elseif(get_locale() == 'ru_RU'){
			$buttonLabel = 'Оформить заказ';
		}
	?>
	<?php echo apply_filters( 'woocommerce_order_button_html', '<button type="submit" class="button alt" name="woocommerce_checkout_place_order" id="place_order" value="' . $buttonLabel . '" data-value="' . $buttonLabel . '">' . $buttonLabel . '</button>' ); // @codingStandardsIgnoreLine ?>


</div>

