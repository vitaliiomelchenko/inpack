<?php get_header(); ?>
<div id="app-wrapper" role="main">
    
    <?php 
    /*==============================================*/ 
    /*===============CHANGABLE PART=================*/ 
    /* Dont forget to change dta-namespace */ 
    ?>   

    <div id="app" class="app-container" data-namespace="page">
        <?php /*=====WRITE YOUR CODE HERE=====*/ ?>
            
			<div id="post-<?php the_ID('default-page'); ?>" <?php post_class('best_products'); ?>>
              <?php if(have_rows('flexible_content')):
                while(have_rows('flexible_content')): the_row(); ?>
                  <?php get_template_part('/template-parts/acf-blocks/' . get_row_layout()); ?>
                <?php endwhile; ?>
              <?php endif; ?>
              <?php if(!empty(get_the_content())): ?>
                <div class="container">
                  <?php the_content(  ); ?>
                </div>
              <?php endif; ?>
			</div>
            
        <?php /*=====END OF YOUR CODE=====*/ ?>
    </div>
    <?php /*==============================================*/ ?>

</div>
<?php get_footer(); ?>