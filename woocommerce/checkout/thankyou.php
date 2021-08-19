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
	<a href="<?php echo get_home_url() ?>" class="close_popup_cross">
		<svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
			<path d="M15 1.93376L13.0481 0L7.49963 5.50193L1.95094 0L0 1.93469L5.54813 7.43662L0 12.9389L1.95094 14.8732L7.49963 9.37187L13.0481 14.8732L15 12.9389L9.45094 7.43662L15 1.93376Z" fill="white"/>
		</svg>
	</a>
</div>