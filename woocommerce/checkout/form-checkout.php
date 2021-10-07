<?php
/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}?>
<h1 class="checkout_page_title"><?php the_title(); ?></h1>
<?php
do_action( 'woocommerce_before_checkout_form', $checkout );

// If checkout registration is disabled and not logged in, the user cannot checkout.
if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() ) {
	echo esc_html( apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) ) );
	return;
}

?>

<form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">
	<div class="chechout_fields_wrapper">
		<div class="payer_type_wrapper col-5 checkboxes_wrapper">
			<?php do_action('payer_type_checkout_fields'); ?>
		</div>
		<?php if ( $checkout->get_checkout_fields() ) : ?>

			<?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>

			<div class="col2-set col-7 client_data" id="customer_details">
				<div class="col-12">
  					<div class="chekout_col_title_wrapper"><span class="col-number">2</span><div class="chekout_col_title"><?php if(get_locale() == 'uk'){echo 'Ваші контактні данні';}elseif(get_locale() == 'ru_RU'){echo 'Ваши контактные данные';} ?></div></div>
					<?php do_action( 'woocommerce_checkout_billing' ); ?>
				</div>
			</div>

			<?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>

		<?php endif; ?>
		<div class="shipping_method checkboxes_wrapper col-12">
			<?php do_action('shipping_method_extra_feilds'); ?>
		</div>
		<div class="shipping_fields_wrapper">
			<?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>

				<?php do_action( 'woocommerce_review_order_before_shipping' ); ?>

				<?php wc_cart_totals_shipping_html(); ?>

				<?php do_action( 'woocommerce_review_order_after_shipping' ); ?>

			<?php endif; ?>
			<div class="woocommerce-additional-fields">
				<?php do_action( 'woocommerce_before_order_notes', $checkout ); ?>

				<?php if ( apply_filters( 'woocommerce_enable_order_notes_field', 'yes' === get_option( 'woocommerce_enable_order_comments', 'yes' ) ) ) : ?>

					<?php if ( ! WC()->cart->needs_shipping() || wc_ship_to_billing_address_only() ) : ?>

						<h3><?php esc_html_e( 'Additional information', 'woocommerce' ); ?></h3>

					<?php endif; ?>

					<div class="woocommerce-additional-fields__field-wrapper">
						<?php foreach ( $checkout->get_checkout_fields( 'order' ) as $key => $field ) : ?>
							<?php woocommerce_form_field( $key, $field, $checkout->get_value( $key ) ); ?>
						<?php endforeach; ?>
					</div>

				<?php endif; ?>

				<?php do_action( 'woocommerce_after_order_notes', $checkout ); ?>
			</div>
			<div class="shipping_fields"><?php do_action('shipping_fields_a'); ?></div>
		</div>
		<div class="checkboxes_wrapper extra_shipping_types">
			<?php do_action('extra_shipping_types_a') ?>
			<div class="courier_shipping_fields"><?php do_action('courier_shipping_fields_a'); ?></div>
		</div>
		<div class="payment_method checkboxes_wrapper col-12">
			<?php do_action('payment_method_extra_feilds'); ?>
		</div>
		<?php do_action( 'woocommerce_checkout_before_order_review_heading' ); ?>
	</div>
	<?php do_action( 'woocommerce_checkout_before_order_review' ); ?>

	<div id="order_review" class="woocommerce-checkout-review-order">
		<?php do_action( 'woocommerce_checkout_order_review' ); ?>
	</div>

	<?php do_action( 'woocommerce_checkout_after_order_review' ); ?>
</form>

<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>

<script>
	jQuery(document).ready(function(){
		jQuery('#shipping_method li input[checked="checked"]').prop('checked', false);
		jQuery('#shipping_method li label').click(function(){
			jQuery('#shipping_method li label').removeClass('checked');
			jQuery(this).addClass('checked');
			jQuery('.woocommerce-additional-fields').detach().appendTo(jQuery(this).parent());
		});
		jQuery('.shipping_fields_wrapper').detach().appendTo('#self-pickup_field');
		jQuery('.extra_shipping_types').detach().appendTo('#Courier_field')
	});
	jQuery(document).ready(function(){
		jQuery(jQuery('.shipping_method #self-pickup_field label')).on('change', function(event){
			jQuery('.extra_shipping_types').removeClass('opened_list');
			jQuery('.courier_shipping_fields').detach().appendTo(jQuery('.extra_shipping_types > .col2-set'));
			if(jQuery(this).attr('class') == "checkbox checked"){
				jQuery(this).closest('.form-row').find('.shipping_fields_wrapper').addClass('opened_list');
			}
			else{
				jQuery(this).closest('.form-row').find('.shipping_fields_wrapper').removeClass('opened_list');
			}
		});
	});
	//Adding playholder for courier shipping fields 
	jQuery(document).ready(function(){
		jQuery('.extra_shipping_types .form-row label').not('.checkbox').remove();
		jQuery('.extra_shipping_types').find('#customer_address').attr('placeholder', 'Вулиця');
		jQuery('.extra_shipping_types').find('#house_number').attr('placeholder', 'Будинок');
		jQuery('.extra_shipping_types').find('#flat_number').attr('placeholder', 'Квартира');

	});
	jQuery(document).ready(function(){
		jQuery('.extra_shipping_types p.form-row label').click(function(){
			jQuery('.extra_shipping_types p.form-row').removeClass('active-item');
			jQuery(this).closest('.form-row').addClass('active-item');
			jQuery('.courier_shipping_fields').detach().appendTo(jQuery(this).closest('.form-row'));
		});
	});
	jQuery(document).ready(function(){
		jQuery('#Courier_field > span > label').on( 'change', function(){
			jQuery('.shipping_fields_wrapper').removeClass('opened_list');
			jQuery('#shipping_method  li input').prop('checked', false);
			jQuery('#shipping_method label').removeClass('checked');
			jQuery('#shipping_method #wcus_np_billing_fields').css('display', 'none');
			jQuery('.shipping_fields').detach().appendTo('.shipping_method .shipping_fields_wrapper');	

			if(jQuery(this).attr('class') == "checkbox checked"){
				jQuery('.extra_shipping_types').addClass('opened_list');
			}
			else{
				jQuery('.extra_shipping_types').removeClass('opened_list');
			}
		});
	});
	jQuery(document).ready(function(){
		jQuery('.shipping_fields #office').attr('placeholder', 'Місто');
		jQuery('.shipping_fields #postOffice_number').attr('placeholder', 'Оберіть відділення');
		jQuery('#shipping_method li label').not(jQuery('#shipping_method li').first().find('label')).on('click', function(){
			jQuery('.shipping_fields').detach().appendTo(jQuery(this).parent());
		});
		jQuery('#shipping_method li').first().find('label').on( 'click', function(){
			jQuery('.shipping_fields').detach().appendTo('.shipping_method .shipping_fields_wrapper');	
		});
	});
</script>