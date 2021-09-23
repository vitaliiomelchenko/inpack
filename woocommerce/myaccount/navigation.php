<?php
/**
 * My Account navigation
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/navigation.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

do_action( 'woocommerce_before_account_navigation' );
?>
<a class="account_top_button above_nav_button" href="#">
    <?php _e('Особистий кабінет'); ?>
</a>
<div class="orders_top_button above_nav_button">
    <?php _e('Мої замовлення'); ?>
</div>
<?php $current_user_id = get_current_user_id(); ?>
<?php $customer = new WC_Customer( $current_user_id ); ?>
<nav class="woocommerce-MyAccount-navigation">
	<div class="above_nav_block">
		<div class="user_avatar"><img src="<?php echo get_template_directory_uri(  ) ?>/assets/img/user_avatar.svg" alt=""></div>
		<div class="user_name">
            <?php if($customer->first_name != "" or $customer->last_name != ""): ?>
                <?php echo $customer->last_name . " " . $customer->first_name; ?>
            <?php else: ?>
                <?php echo $customer->display_name; ?>
            <?php endif; ?>
        </div>
	</div>
	<ul>
		<?php $i = 1; ?>
        <?php foreach ( wc_get_account_menu_items() as $endpoint => $label ) : ?>
            <li class="<?php echo wc_get_account_menu_item_classes( $endpoint ); ?>">
                <a href="<?php echo esc_url( wc_get_account_endpoint_url( $endpoint ) ); ?>"><?php echo esc_html( $label ); ?></a>
            </li>
            <?php if($i == 1 ): ?>
            <li class="<?php echo wc_get_account_menu_item_classes( $endpoint ); ?>">
                <a href="<?php echo get_home_url() ?>/wishlist"><?php if(get_locale() == 'uk'){echo 'Список бажань';}elseif(get_locale() == 'ru_RU'){echo 'Список желаний';} ?></a>
            </li>
            <?php endif; ?>
            <?php $i++; ?>
        <?php endforeach; ?>
	</ul>
</nav>

<?php do_action( 'woocommerce_after_account_navigation' ); ?>
