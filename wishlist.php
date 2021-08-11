<div class="breadcrumbs wishlist_breadcrumbs">
    <div class="container">
        <?php echo do_shortcode('[wpseo_breadcrumb]') ?>
        <span class="wishlist-breadcrumb">
            <?php _e('Особистий кабінет'); ?>
        </span>
    </div>
</div>
<?php $current_user_id = get_current_user_id(); ?>
<?php $customer = new WC_Customer( $current_user_id ); ?>
<section class="wishlist_wrapper">
    <div class="container">
        <div class="wishlist_row">
            <a class="above_nav_button wishlist_back_button" href="<?php echo get_home_url(  ) ?>/my-account/">
                Список бажань
            </a>
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
                            <a href="<?php echo get_home_url() ?>/wishlist">Список бажань</a>
                        </li>
                        <?php endif; ?>
                        <?php $i++; ?>
                    <?php endforeach; ?>
                    
                </ul>
            </nav>
            <div class="wishlist">
                <h2 class="page_title">
                    <?php the_title(); ?>
                </h2>
                <?php 
                if ( $wishlist && $wishlist->has_items() ) :
                    foreach ( $wishlist_items as $item ) :
                    global $product;

                    $product      = $item->get_product();
                    $availability = $product->get_availability();
                    $stock_status = isset( $availability['class'] ) ? $availability['class'] : false;
                ?>
                <div class="wishlist_item">
                    <div class="wishlist_img">
                        <?php echo $product->get_image(); ?>
                    </div>
                    <a class="mobile_remove_item_button remove_from_wishlist" href="<?php echo esc_url( add_query_arg( 'remove_from_wishlist', $item->get_product_id() ) ); ?>">
                        <div class="trash_icon"></div>
                        <?php _e('Видалити'); ?>
                    </a>
                    <div class="wishlist_item_data">
                        <div class="wishlist_item_title">
                            <?php echo wp_kses_post( apply_filters( 'woocommerce_in_cartproduct_obj_title', $product->get_title(), $product ) ); ?>
                        </div>
                        <?php if(!empty($product->get_sku())): ?>
                            <div class="wishlist_item_sku"><?php _e('Артикул:'); ?> <?php echo $product->get_sku(); ?></div>
                        <?php endif; ?>
                        <div class="wishlist_item_price"><?php _e('Ціна:'); ?> <?php echo $item->get_formatted_product_price(); ?></div>
                        <div class="stock_label">
                            <?php echo 'out-of-stock' === $stock_status ? '<span class="wishlist-out-of-stock">' . esc_html( apply_filters( 'yith_wcwl_out_of_stock_label', __( 'Немає в наявності', 'yith-woocommerce-wishlist' ) ) ) . '</span>' : '<span class="wishlist-in-stock">' . esc_html( apply_filters( 'yith_wcwl_in_stock_label', __( 'Є в наявності', 'yith-woocommerce-wishlist' ) ) ) . '</span>'; ?>
                        </div>
                        <?php if($stock_status === 'in-stock'): ?>
                            <div class="mobile_follow_the_price_button">
                                <span class="checkbox_wrapper">
                                    <input type="checkbox">
                                </span>
                                <?php _e('Слідкувати за ціною'); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="wishlist_item_buttons">
                        <div class="add_to_cart_button_wrapper">
                            <?php do_action( 'yith_wcwl_table_before_product_cart', $item, $wishlist ); ?>

                            <!-- Date added -->
                            <?php
                            if ( $show_dateadded && $item->get_date_added() ) :
                                // translators: date added label: 1 date added.
                                echo '<span class="dateadded">' . esc_html( sprintf( __( 'Added on: %s', 'yith-woocommerce-wishlist' ), $item->get_date_added_formatted() ) ) . '</span>';
                            endif;
                            ?>

                            <?php do_action( 'yith_wcwl_table_product_before_add_to_cart', $item, $wishlist ); ?>

                            <!-- Add to cart button -->
                            <?php $show_add_to_cart = apply_filters( 'yith_wcwl_table_product_show_add_to_cart', $show_add_to_cart, $item, $wishlist ); ?>
                            <?php if ( $show_add_to_cart && isset( $stock_status ) && 'out-of-stock' !== $stock_status ) : ?>
                                <?php woocommerce_template_loop_add_to_cart( array( 'quantity' => $show_quantity ? $item->get_quantity() : 1 ) ); ?>
                            <?php endif ?>

                            <?php do_action( 'yith_wcwl_table_product_after_add_to_cart', $item, $wishlist ); ?>
                        </div>
                        <?php if($stock_status === 'in-stock'): ?>
                            <div class="follow_the_price">
                                <span class="checkbox_wrapper">
                                    <input type="checkbox">
                                </span>
                                <?php _e('Слідкувати за ціною'); ?>
                            </div>
                        <?php endif; ?>
                        <?php if($stock_status === "out-of-stock"): ?>
                            <div class="out_of_stock_button button">
                                <?php _e('Повідомити про наявність'); ?>
                            </div>
                        <?php endif; ?>
                        <a href="<?php echo esc_url( add_query_arg( 'remove_from_wishlist', $item->get_product_id() ) ); ?>" class="remove_from_wishlist" title="<?php echo esc_html( apply_filters( 'yith_wcwl_remove_product_wishlist_message_title', __( 'Remove this product', 'yith-woocommerce-wishlist' ) ) ); ?>">                            
                            <!--<img src="<?php echo get_template_directory_uri(  ) ?>/assets/img/remove_cart_cion.svg" alt="" class="remove_cart_icon">-->
                            <div class="trash_icon"></div>
                            <?php _e('Видалити'); ?>
                        </a>
                        
                    </div>
                </div>
                <?php 
                endforeach;
                else :
                    ?>
                    <tr>
                        <td colspan="<?php echo esc_attr( $column_count ); ?>" class="wishlist-empty"><?php echo esc_html( apply_filters( 'yith_wcwl_no_product_to_remove_message', __( 'No products added to the wishlist', 'yith-woocommerce-wishlist' ), $wishlist ) ); ?></td>
                    </tr>
                    <?php
                endif;
                ?>
            </div>
        </div>
    </div>
</section>
