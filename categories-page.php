<?php 
/*
Template Name: Categories Page
*/
?>
<?php get_header() ?>
<?php echo get_template_part('template-parts/breadcrumbs') ?>
<seciton class="page_title__wrapper katalog categories_page_title__wrapper">
    <div class="container">
		<div class="katalog-page-title">
			<div class="background-title"><?php the_title(); ?></div>
			<h2><?php the_title(); ?></h2>
		</div>
	</div>
</seciton>
<section class="product_categories">
    <div class="container shop-page-container">
        
        <div class="row">
        <div class="col-md-3 col-12 sidebar filter-col">
            <?php $button_title = get_field('download_button_title'); ?>
            <?php $button_file = get_field('download_button_file'); ?>
            <?php if($button_title): ?>
                <div class="above_sidebar_download_button_wrapper">
                    <a href="<?php echo $button_file; ?>" class="above_sidebar_download_button" download><?php echo $button_title; ?></a>
                </div>
            <?php endif; ?>
            <div class="filter_wrapper category">
				<div class="filter_title">
					Категорія
				</div>
				<div class="filter">
					<?php echo do_shortcode( '[searchandfilter id="wpf_60d358e92dfeb"]' ) ?>
				</div>
			</div>
        </div>
        <div class="col-md-9 col-12 product_categories_list">
            <div class="row">
            <?php 
            $args = array(
                'taxonomy' => 'product_cat',
                'orderby' => 'name',
                'order'   => 'ASC',
                'hide_empty' => false,
            );

            $cats = get_categories($args);

            foreach($cats as $cat) {?>
                <?php if($cat->count == 0){
                    $empty_class = " empty";
                }
                else{
                    $empty_class = "";
                } ?>
                
                <a <?php if($cat->count != 0){echo 'href="' . get_home_url() . '/product-category/' . $cat->slug . '/" '; } ?><?php wc_product_cat_class( 'col-lg-4 col-md-6 col-12 product_category_item__wrapper' . $empty_class, $category ); ?>>
                    <div class="product_category_item">
                        <?php 
                            $icon = get_term_meta( $cat->term_id, 'thumbnail_id', true ); 
                        ?>
                        <?php if( !empty($icon)): ?>
                        <div class="product_category_image">
                            <?php echo file_get_contents(wp_get_original_image_path($icon)); ?>
                        </div>
                        <?php else: ?>
                            <div class="product_category_image">
                                <img src="<?php echo get_home_url(  ) ?>/wp-content/uploads/woocommerce-placeholder.png">
                            </div>
                        <?php endif; ?>
                        <div class="product_category_name h5"><?php echo $cat->name ?></div>
                    </div>
                </a>
                <?php
                }
                ?>
            </div>
        </div>
        </div>

    </div>
</section>
<?php get_footer() ?>