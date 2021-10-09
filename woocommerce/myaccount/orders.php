<?php
/**
 * Orders
 *
 * Shows orders on the account page.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/orders.php.
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

		

do_action( 'woocommerce_before_account_orders', $has_orders ); ?>

<?php if ( $has_orders ) : ?>
	<h2 class="orders-page-title">
		Мої замовлення
	</h2>
	<div class="woocommerce-orders-table woocommerce-MyAccount-orders shop_table shop_table_responsive my_account_orders account-orders-table">

		<div class="orders">
			<?php
			foreach ( $customer_orders->orders as $customer_order ) {
				$order      = wc_get_order( $customer_order ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
				$item_count = $order->get_item_count() - $order->get_item_count_refunded();
				?>
				<div class="woocommerce-orders-table__row woocommerce-orders-table__row--status-<?php echo esc_attr( $order->get_status() ); ?> order">
					<div class="row closed-order">
						<div class="woocommerce-orders-table__cell woocommerce-orders-table__cell-status order-status-wrapper col-lg-3 col-12" data-title="<?php echo esc_attr( $column_name ); ?>">
							<?php 
								$completed_icon = get_field( 'completed_order_icon', 'option' );
								$order_in_progres = get_field( 'in-progres_order_icon', 'option' );
								$canceled_order = get_field( 'canceled_order_icon', 'option' );
							?>
							<div class="status">
								<?php if(!empty($completed_icon)): ?>
									<div class="completed_order status-icon">
										<?php echo file_get_contents(wp_get_original_image_path($completed_icon['id'])); ?>
									</div>
								<?php endif; ?>
								<?php if(!empty($order_in_progres)): ?>
									<div class="order_in_progres status-icon">
										<?php echo file_get_contents(wp_get_original_image_path($order_in_progres['id'])); ?>
									</div>
								<?php endif; ?>
								<?php if(!empty($canceled_order)): ?>
									<div class="canceled_order status-icon">
										<?php echo file_get_contents(wp_get_original_image_path($canceled_order['id'])); ?>
									</div>
								<?php endif; ?>
								<?php echo esc_html( wc_get_order_status_name( $order->get_status() ) ); ?>
							</div>
						</div>
						<div class="woocommerce-orders-table__cell woocommerce-orders-table__cell-order-number order-number order-date col-lg-4 col-12" data-title="<?php echo esc_attr( $column_name ); ?>">
							<span class="order_number"><?php echo '№' . $order->get_order_number(); ?></span>
							<?php if(get_locale() == 'uk'){echo 'від';}elseif(get_locale() == 'ru_RU'){echo 'от';} ?>
							<span class="order_time"><time datetime="<?php echo esc_attr( $order->get_date_created()->date( 'c' ) ); ?>"><?php echo esc_html( wc_format_datetime( $order->get_date_created() ) ); ?></time></span>
						</div>
						<div class="woocommerce-orders-table__cell woocommerce-orders-table__cell-order-total order-total col-lg-3 col-8" data-title="<?php echo esc_attr( $column_name ); ?>"> 
							<?php if(get_locale() == 'uk'){echo 'Сума замовлення ';}elseif(get_locale() == 'ru_RU'){echo 'Сумма заказа';} ?>
							<?php echo wp_kses_post( sprintf( _n( '%1$s', '%1$s', $item_count, 'woocommerce' ), $order->get_formatted_order_total(), $item_count ) ); ?>
						</div>
						<div class="col-md-2 col-4 show_delails_button_wrapper">
							<?php if(get_locale() == 'uk'){echo 'Детальніше';}elseif(get_locale() == 'ru_RU'){echo 'Подробнее';} ?>
						</div>
					</div>
					<?php 
					$order_items           = $order->get_items( apply_filters( 'woocommerce_purchase_order_item_types', 'line_item' ) );
					$show_purchase_note    = $order->has_status( apply_filters( 'woocommerce_purchase_note_order_statuses', array( 'completed', 'processing' ) ) );
					$show_customer_details = is_user_logged_in() && $order->get_user_id() === get_current_user_id();
					$downloads             = $order->get_downloadable_items();
					$show_downloads        = $order->has_downloadable_item() && $order->is_download_permitted();
					?>
					<div class="order-details opened-order">
						<div class="row">
							<?php 
								$show_shipping = ! wc_ship_to_billing_address_only() && $order->needs_shipping_address(); 
								$shipping_address = $order->get_address('billing'); 
							?>
							<div class="col-lg-3 col-12 customer-data">
								<div class="customer-order-number customer-order-date">
									<?php echo esc_html( '№' . $order->get_order_number() ); ?>
									<?php if(get_locale() == 'uk'){echo 'від';}elseif(get_locale() == 'ru_RU'){echo 'от';} ?>
									<time datetime="<?php echo esc_attr( $order->get_date_created()->date( 'c' ) ); ?>"><?php echo esc_html( wc_format_datetime( $order->get_date_created() ) ); ?></time>
								</div>
								<div class="before_customer_data_title">
									<?php if(get_locale() == 'uk'){echo 'Інформація про замовлення';}elseif(get_locale() == 'ru_RU'){echo 'Информация о заказе';} ?>
								</div>
								<div class="address">
									<?php echo $shipping_address['city'] . ' ' . $shipping_address['address_1'] . ' ' . $shipping_address['address_2']; ?>
								</div>
								<div class="name">
									<?php echo $shipping_address['first_name'] . ' ' . $shipping_address['last_name'] ?>
								</div>
								<div class="customer-phone"><?php echo $order->get_billing_phone(); ?></div>
							</div>
							<div class="col-md-9 col-12 product-details">
								<div class="order-details-head row">
									<?php 
									if(get_locale() == 'uk'){
										$imageHead = 'Товари';
										$priceHead = 'Ціна';
										$quantityHead = 'Кількість';
										$totalHead = 'Сумма';
									}
									elseif(get_locale() == "ru_RU"){
										$imageHead = 'Товары';
										$priceHead = 'Цена';
										$quantityHead = 'Количество';
										$totalHead = 'Сумма';
									} 
									?>
									<div class="col-md-5 col-12 product-image--name-head head-col"><?php echo $imageHead; ?>:</div>
									<div class="col-1 price-head head-col"><?php echo $priceHead; ?>:</div>
									<div class="col-1 quantity-head head-col"><?php echo $quantityHead; ?>:</div>
									<div class="col-1 total-head head-col"><?php echo $totalHead; ?>:</div>
									<div class="col-4 close-details-button-wrapper head-col">
										<div class="close-details-button">
											<img src="<?php echo get_template_directory_uri(  ) . '/assets/img/vector.svg'; ?>" alt="">
										</div>
									</div>
								</div>
						<?php
						do_action( 'woocommerce_order_details_before_order_table_items', $order );

						foreach ( $order_items as $item_id => $item ) {
							$product = $item->get_product();

							wc_get_template(
								'order/order-details-item.php',
								array(
									'order'              => $order,
									'item_id'            => $item_id,
									'item'               => $item,
									'show_purchase_note' => $show_purchase_note,
									'purchase_note'      => $product ? $product->get_purchase_note() : '',
									'product'            => $product,
								)
							);
						}

						do_action( 'woocommerce_order_details_after_order_table_items', $order );
						?>
						<div class="mobile_repeat_order_button">
							<div class="button"><a href="<?php echo wp_nonce_url( add_query_arg( 'order_again', $order->get_id(), wc_get_cart_url() ), 'woocommerce-order_again' ); ?>">Повторити замовлення</a></div>
						</div>
					</div>
					</div>
					</div>
				</div>
				<?php
			}
			?>
		</div>
	</div>

	<?php do_action( 'woocommerce_before_account_orders_pagination' ); ?>

	<?php if ( 1 < $customer_orders->max_num_pages ) : ?>
		<div class="woocommerce-pagination woocommerce-pagination--without-numbers woocommerce-Pagination">
			<?php if ( 1 !== $current_page ) : ?>
				<a class="woocommerce-button woocommerce-button--previous woocommerce-Button woocommerce-Button--previous button" href="<?php echo esc_url( wc_get_endpoint_url( 'orders', $current_page - 1 ) ); ?>"><?php esc_html_e( 'Previous', 'woocommerce' ); ?></a>
			<?php endif; ?>

			<?php if ( intval( $customer_orders->max_num_pages ) !== $current_page ) : ?>
				<a class="woocommerce-button woocommerce-button--next woocommerce-Button woocommerce-Button--next button" href="<?php echo esc_url( wc_get_endpoint_url( 'orders', $current_page + 1 ) ); ?>"><?php esc_html_e( 'Next', 'woocommerce' ); ?></a>
			<?php endif; ?>
		</div>
	<?php endif; ?>

<?php else : ?>
	<div class="woocommerce-message woocommerce-message--info woocommerce-Message woocommerce-Message--info woocommerce-info">
		<a class="woocommerce-Button button" href="<?php echo esc_url( apply_filters( 'woocommerce_return_to_shop_redirect', wc_get_page_permalink( 'shop' ) ) ); ?>"><?php esc_html_e( 'Browse products', 'woocommerce' ); ?></a>
		<?php esc_html_e( 'No order has been made yet.', 'woocommerce' ); ?>
	</div>
<?php endif; ?>

<?php do_action( 'woocommerce_after_account_orders', $has_orders ); ?>
