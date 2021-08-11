<?php
/**
 * My Account Dashboard
 *
 * Shows the first intro screen on the account dashboard.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/dashboard.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 4.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$allowed_html = array(
	'a' => array(
		'href' => array(),
	),
);
?>

<?php $user_id = $current_user->id; ?>
<?php $customer = new WC_Customer( $user_id ); ?>
<div class="account-info">
	<div class="info-type">
		Ім’я
	</div>
	<div class="info">
		<?php if(!empty($current_user->user_lastname) or !empty($current_user->user_lastname)) : ?>
			<?php echo $current_user->user_lastname . " " . $current_user->user_firstname ?>
		<?php else: ?>
			<?php echo $current_user->display_name; ?>
		<?php endif; ?>
	</div>
</div>
<div class="account-info">
	<div class="info-type">
		Email
	</div>
	<div class="info">
		<?php echo $current_user->user_email; ?>
	</div>
</div>
<div class="account-info">
	<div class="info-type">
		Адреса доставки
	</div>
	<div class="info">
		<?php if(!empty($customer->get_shipping_city())): ?>
			<?php echo $customer->get_shipping_city() . ' ' . $customer->get_shipping_address_1() . ' ' . $customer->get_shipping_address_2() ; ?>
		<?php else: ?>
			<?php echo $customer->get_billing_city() . ' ' . $customer->get_billing_address_1() . ' ' . $customer->get_billing_address_2(); ?>
		<?php endif; ?>
	</div>
</div>


<?php
	/**
	 * My Account dashboard.
	 *
	 * @since 2.6.0
	 */
	do_action( 'woocommerce_account_dashboard' );

	/**
	 * Deprecated woocommerce_before_my_account action.
	 *
	 * @deprecated 2.6.0
	 */
	do_action( 'woocommerce_before_my_account' );

	/**
	 * Deprecated woocommerce_after_my_account action.
	 *
	 * @deprecated 2.6.0
	 */
	do_action( 'woocommerce_after_my_account' );

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */
