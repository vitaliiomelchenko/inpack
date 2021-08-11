<?php
/**
 * Thankyou page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/thankyou.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.7.0
 */

defined( 'ABSPATH' ) || exit;
?>
<h1 class="checkout_page_title"><?php the_title(); ?></h1>
<div class="overlay">

</div>
<div class="thankyou_banner_wrapper">
	<?php $image = get_field('banner_image', 'option'); ?>
	<?php $banner_text = get_field('banner_title', 'option'); ?>
	<?php if($image): ?>
	<div class="thankyou_banner_image_col">
		<img src="<?php echo $image; ?>" alt="">
	</div>
	<?php endif; ?>

	<div class="thankyou_banner_text_col">
		<?php if($banner_text): ?>
		<h2 class="banner_title"><?php echo $banner_text; ?></h2>
		<?php endif; ?>
		<div class="order_number">
			<?php _e('Ваше замовлення:') ?> <?php echo $order->get_order_number(); ?>
		</div>
		<div class="order_date">
			<?php _e('Дата замовлення:') ?> <?php echo wc_format_datetime( $order->get_date_created() ); ?>
		</div>
	</div>
</div>