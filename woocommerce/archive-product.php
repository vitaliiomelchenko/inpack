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
<a class="back_button" href="#">
	Головна
</a>
<section class="katalog">
    <div class="container">
		<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
			<div class="katalog-page-title">
				<div class="background-title"><?php woocommerce_page_title(); ?></div>
				<h2><?php woocommerce_page_title(); ?></h2>
			</div>
		<?php endif; ?>
		<div class="katalog_category_name">
			Аксесуари
		</div>
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
            <div class="col-lg-3 col-12 filter-col">
				<div class="filter_wrapper"><?php dynamic_sidebar('shop-filters');?></div>
				<div class="" style="display:;">
				<?php

				// задаем нужные нам критерии выборки данных из БД
				$args = array(
					'post_type' => 'product',
					'posts_per_page' => -1,
					'orderby' => 'comment_count'
				);

				$query = new WP_Query( $args );

				// Цикл
				if ( $query->have_posts() ) {
					$product_attributes_names = array();
					while ( $query->have_posts() ) {
						$query->the_post();
						global $product;

						//Getting product attributes
						$product_attributes = $product->get_attributes();
				
						if(!empty($product_attributes)){
				
							//Getting product attributes slugs
							$product_attribute_slugs = array_keys($product_attributes);
							$count_slug = 0;
				
							
							foreach ($product_attribute_slugs as $product_attribute_slug){
								$count_slug++;
								$attribute_name =  ucfirst( str_replace('pa_', '', $product_attribute_slug) );
								array_push($product_attributes_names, $product_attribute_slug);
								$product_attributes_names = array_unique($product_attributes_names);
							}
							
						}
						
					}
					
				}
				// Возвращаем оригинальные данные поста. Сбрасываем $post.
				wp_reset_postdata();
				?>
				<div class="filter_wrapper">
				<div class="filter_title">Фільтр</div>

					<?php
					//get_template_part( '/woocommerce/content-widget-price-filter' );
					//echo do_shortcode('[woocommerce_product_filter_price fields="no"]');
					foreach ($product_attributes_names as $product_attributes_name){ 

						/*get term name by slug */
						$product_attributes_slug = str_replace('pa_', 'filter_', $product_attributes_name);
						?>

						<div class="filter__inner filter__inner-<?php echo $product_attributes_slug; ?>">
						<div class="filter__titleWrapper">
							<div class="filter__title" data-sort="<?php echo $product_attributes_slug;?>"><?php echo wc_attribute_label($product_attributes_name);?></div>
						</div>
						<?php

						$attribute_values = get_terms($product_attributes_name);
						if( $attribute_values && ! is_wp_error($attribute_values) ){
							?>

							<ul class="filterGroup" data-sort="<?php echo $product_attributes_slug;?>">
							<?php
							foreach( $attribute_values as $attribute_values ){
								echo "<li data-slug=" .$attribute_values->slug .">". $attribute_values->name ."</li>";
						
							}
							echo "</ul>";
						}
						$count_value = 0;
						foreach($attribute_values as $attribute_value){
							$count_value++;
							$attribute_name_value = $attribute_value->name; // name value
							$attribute_slug_value = $attribute_value->slug; // slug value
							$attribute_slug_value = $attribute_value->term_id; // ID value
		
							// Displaying HERE the "names" values for an attribute
							//echo $attribute_name_value;
							//if($count_value != count($attribute_values)) echo ', ';
						}
						echo '</div>';
					}
?>
<div class="filter__inner">
	<div class="inpack_submit button">Показати</div>
</div>

<?php

if(isset($_GET['perpage'])) { ?>
	
	<script>

		jQuery(document).ready(function($){
			let perpage = '.perpage-' + <?php echo $_GET['perpage']; ?>;
			$('.perpage').removeClass('active');
			$(perpage).addClass('active');
		});

	</script>

    <?php
} else { ?>
	<script>

		jQuery(document).ready(function($){
			$('.perpage-9').addClass('active');
		});

	</script>
<?php } ?>

<?php

foreach($_GET as $key => $value) {
	?>
	<script>
		jQuery(document).ready(function($){
			let key = '<?php echo $key; ?>';
			let value = '<?php echo $value; ?>';

			$('ul[data-sort="' + key + '"] li[data-slug="' + value + '"]').addClass('active');
			$('ul[data-sort="' + key + '"]').slideToggle();
			
		});
	</script>
	<?php
}

?>

<script>
jQuery(document).ready(function($){
	let loadedQueryString = window.location.href;
	console.log(loadedQueryString);
	console.log(window.location.search);
	let newQueryString = '';
	$('li').on("click",function(){
		$(this).toggleClass('active');
	});
	
	$('.inpack_submit').on("click",function(){
		newQueryString = '';

		$( ".filter-col li.active" ).each(function() {
			$(this).parent().addClass('active');
		});

		let filtersSize = $('.filter-col ul.active').size() - 1;

		$( ".filter-col ul.active" ).each(function(index) {
			filterQuery = $(this).data('sort') + '=';
			let childrenSize = $(this).find('li.active').size() - 1;
			$(this).find('li.active').each(function(index) {

				if ( index == childrenSize) {
					itemQuery =  $(this).data('slug');
				}
				else {
					itemQuery = $(this).data('slug') + ',';
				}
				filterQuery = filterQuery + itemQuery;
			});

			if ( index == filtersSize) {
				filterQuery = filterQuery;
			} else {
				filterQuery = filterQuery + '&';
			}
			newQueryString = newQueryString + filterQuery;
			console.log(index + filterQuery);
		});

		newQueryString = '?' + newQueryString;
		$(location).prop('href', newQueryString);
	});

	// $(".filterby").on("click", function(e){
	// 	e.preventDefault();
	// 	let orderby = $(this).attr('href');
	// 	orderby = text.replace("lollypops", "marshmellows");
    // 	//$(this).text(text);
		
	// 	//let loadedQueryString = window.location.href;
	// 	//let newOrderQueryString = '';
	// 	if( loadedQueryString.includes("?orderby='*'")) {
	// 		text = text.replace("lollypops", "marshmellows");
    // 		// $(this).text(text);
	// 		// newOrderQueryString = loadedQueryString + '&' + orderby;
	// 	} 
	// 	// else if(loadedQueryString.includes("?")){

	// 	// } else {
	// 	// 	newOrderQueryString = loadedQueryString + '?' + orderby;
	// 	// }

	// 	$(location).prop('href', newOrderQueryString);
	// });
});
</script>

<style>
 li.active {
	color: green;
}
.filter-wrapper-artykul {
	display: none;
}
</style>
					
				</div>
				</div>
				<!-- <div class="filter_wrapper category">
					<div class="filter_title">
						Категорія
					</div>
					<div class="filter">
						<?php echo do_shortcode( '[searchandfilter id="wpf_60d358e92dfeb"]' ) ?>
					</div>
				</div>
				<div class="filter_wrapper filters">
					<div class="filter_title">
						Фільтр
					</div>
					<div class="filter">
						<div class="price">
							<div class="price-range-title wpf_item_name">Ціна</div>
							<?php echo do_shortcode( '[searchandfilter id="wpf_60d3292edca4b"]' ) ?>
						</div>
						<div class="product_attributes">
							<?php echo do_shortcode( '[searchandfilter id="wpf_60d466c7f358a"]' ) ?>
						</div>
					</div>
				</div> -->
			</div>

            <div class="col-lg-9 col-12 katalog-items">
                <div class="top-filter-row">
					<div class="mobile_open_filter_button">
						Фільтри
					</div>
					<div class="sort_by">
						<div class="filter-title">Сортування:</div>
						<ul class="filter-list">
							<?php do_action( 'woocommerce_before_shop_loop' ); //Фильтр архивной страницы ?>
						</ul>
					</div>
					<!-- <div class="count">
						<div class="filter-title">Кількість товару:</div>
						<ul class="filter-list">
							<li class="active">10</li>
							<li>20</li>
							<li>30</li>
						</ul>
					</div> -->
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
  //console.log(<?php echo "'" . get_home_url() . "'"; ?>);
  if(wLink != "<?php echo get_home_url(); ?>/shop/" && selectedOrderClass == "popularity"){ 
    if(wLink != "<?php echo get_home_url(); ?>/shop/page/<?php echo $paged; ?>/"){
      $('.post-type-archive-product').find('.filter-list-item').removeClass('active');
      $('.post-type-archive-product').find('.filter-list-item.title').addClass('active');
    }
  }
});
</script>
<script>
	$(document).ready(function(){
		$('.katalog-items a').each(function(){
			if((this).hasAttribute('href')){
				
			}
			else{
				$(this).remove();
			}
		});
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
