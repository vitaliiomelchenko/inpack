<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

get_header( 'shop' );

/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
//do_action( 'woocommerce_before_main_content' );

?>
<?php echo get_template_part('template-parts/breadcrumbs') ?>
<section class="katalog">
    <div class="container">
		<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
			<div class="katalog-page-title">
				<div class="background-title"><?php woocommerce_page_title(); ?></div>
				<h2><?php woocommerce_page_title(); ?></h2>
			</div>
		<?php endif; ?>
	</div>
	<?php
	/**
	 * Hook: woocommerce_archive_description.
	 *
	 * @hooked woocommerce_taxonomy_archive_description - 10
	 * @hooked woocommerce_product_archive_description - 10
	 */
	do_action( 'woocommerce_archive_description' );
	?>
<?php
if ( woocommerce_product_loop() ) {

	/**
	 * Hook: woocommerce_before_shop_loop.
	 *
	 * @hooked woocommerce_output_all_notices - 10
	 * @hooked woocommerce_result_count - 20
	 * @hooked woocommerce_catalog_ordering - 30
	 */
	?>
	<div class="container" id="shop_container">
        <div class="row">
            <div class="col-3 filter-col">
				<div class="filter_wrapper category">
					<div class="filter_title">
						Категорія
					</div>
					<div class="filter">
						<?php echo do_shortcode( '[searchandfilter id="wpf_60d358e92dfeb"]' ) ?>
					</div>
				</div>
				<div class="filter_wrapper">
					<div class="filter_title">
						Фільтр
					</div>
					<div class="filter">
						<div class="price">
							<div class="price-range-title">Ціна</div>
							<?php echo do_shortcode( '[searchandfilter id="wpf_60d3292edca4b"]' ) ?>
						</div>
						<div class="product_attributes">
							<?php echo do_shortcode( '[searchandfilter id="wpf_60d466c7f358a"]' ) ?>
						</div>
					</div>
				</div>
			</div>

            <div class="col-9 katalog-items">
                <div class="top-filter-row">
					<div class="sort_by">
						<div class="filter-title">Сортування:</div>
						<ul class="filter-list">
							<?php do_action( 'woocommerce_before_shop_loop' ); //Фильтр архивной страницы ?>
						</ul>
					</div>
					<div class="count">
						<div class="filter-title">Кількість товару:</div>
						<ul class="filter-list">
							<li class="active">10</li>
							<li>20</li>
							<li>30</li>
						</ul>
					</div>
                </div>
                <div class="row">
				<?php
				$args = array(
					'orderby' => 'popularity',
					'order'   => 'ASC'
				);
				$the_query = new WP_Query( $args );
				if ( wc_get_loop_prop( 'total' ) ) {
					while ( have_posts() ):
						the_post();

						/**
						 * Hook: woocommerce_shop_loop.
						 */
						//do_action( 'woocommerce_shop_loop' );

						wc_get_template_part( 'content', 'product' );
					endwhile;

				}

				

				/**
				 * Hook: woocommerce_after_shop_loop.
				 *
				 * @hooked woocommerce_pagination - 10
				 */
				?>
				
				<div class="show-more-button"><a href="#" class="misha_loadmore">Показати більше</a></div>
				<div class="pagination">
					<?php do_action( 'woocommerce_after_shop_loop' ); ?>
				</div>
                
	<?php 
} else {
	/**
	 * Hook: woocommerce_no_products_found.
	 *
	 * @hooked wc_no_products_found - 10
	 */
	do_action( 'woocommerce_no_products_found' );
}

/**
 * Hook: woocommerce_after_main_content.
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
//do_action( 'woocommerce_after_main_content' );
?>
</div>
                
            </div>
        </div>
        
    </div>
</section>
<script>
//Sort By
var $ = jQuery;
$(document).ready(function(){
  var wLink = $(location).attr('href');
  var selectedOrder = $('.post-type-archive-product .woocommerce-ordering select').find('option[selected="selected"]');
  var selectedOrderClass = $(selectedOrder).attr('value');
  $('.' + selectedOrderClass).addClass('active');
  console.log(<?php echo "'" . get_home_url() . "'"; ?>);
  if(wLink != "<?php echo get_home_url(); ?>/shop/" && selectedOrderClass == "popularity"){ 
    if(wLink != "<?php echo get_home_url(); ?>/shop/page/<?php echo $paged; ?>/"){
      $('.post-type-archive-product').find('.filter-list-item').removeClass('active');
      $('.post-type-archive-product').find('.filter-list-item.title').addClass('active');
    }
  }
});
</script>
<?php
/**
 * Hook: woocommerce_sidebar.
 *
 * @hooked woocommerce_get_sidebar - 10
 */
//do_action( 'woocommerce_sidebar' );

get_footer(  );
