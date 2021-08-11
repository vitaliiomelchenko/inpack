<?php
/**
 * Cart totals
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart-totals.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 2.3.6
 */

defined( 'ABSPATH' ) || exit;

?>
<div class="cart_totals <?php echo ( WC()->customer->has_calculated_shipping() ) ? 'calculated_shipping' : ''; ?>">

	<?php do_action( 'woocommerce_before_cart_totals' ); ?>
	<div class="under_cart_row row">
		<?php $under_cart_button = get_field('under_cart_button', 'option') ?>
		<?php if($under_cart_button): ?>
			<a class="back_to_shop_button" href="<?php echo $under_cart_button['url'] ?>"><?php echo $under_cart_button['title'] ?></a>
		<?php endif; ?>
		<div class="total_amount h4 desktop_total"><?php esc_html_e( 'Cart totals', 'woocommerce' ); ?>:<?php wc_cart_totals_order_total_html(); ?></div>
	</div>
	<div class="wc-proceed-to-checkout">
		<div class="total_amount h4 mobile_total"><?php _e('Разом'); ?><?php wc_cart_totals_order_total_html(); ?></div>
		<?php do_action( 'woocommerce_proceed_to_checkout' ); ?>
	</div>

	
</div>
