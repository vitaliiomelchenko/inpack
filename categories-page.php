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
        <div class="col-md-3 col-12 sidebar">
            
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
                <div class="col-lg-4 col-md-6 col-12 product_category_item__wrapper">
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
                </div>
                <?php
                }
                ?>
            </div>
        </div>
        </div>

    </div>
</section>
<?php get_footer() ?>