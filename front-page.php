<?php get_header(); ?>
<div id="app-wrapper" role="main">

    <div id="app" class="app-container" data-namespace="home">
    	<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  		<?php /*=====WRITE YOUR CODE HERE=====*/ ?>
		<?php 
		if(get_field('enable_banner')):
			get_template_part('template-parts/acf-blocks/banner');
		endif;
		?>
		
		<?php the_acf_loop(); ?>
        <div class="breadcrumbs">
            <div class="container">
                <?php echo do_shortcode('[wpseo_breadcrumb]') ?>
            </div>
        </div>
		
		<?php if(have_rows('flexible_content')):
    		while(have_rows('flexible_content')): the_row(); ?>
				<?php get_template_part('template-parts/acf-blocks/' . get_row_layout()); ?>
    		<?php endwhile;
		endif; ?>
        


		<?php /*=====END OF YOUR CODE=====*/ ?>
		</div>
    </div>
    <?php /*==============================================*/ ?>
</div>
<?php get_footer(); ?>