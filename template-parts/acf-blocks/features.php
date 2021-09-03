<?php 
    $featuresTitle = get_sub_field('featuresTitle'); 
?>
<section class="features">
    <div class="container container--lg ">
        <div class="features__wrapper">
            <?php if ($featuresTitle) : ?>
                <div class="features__title"><?php echo $featuresTitle;?></div>
            <?php endif;?>
            <div class="row featuresItem__wrapper">
    <?php if (have_rows('featuresItem__wrapper') ): ?>
        <?php while(have_rows('featuresItem__wrapper') ) : the_row();
             $featuresIcon = get_sub_field('featuresIcon'); 
             $featuresContent = get_sub_field('featuresContent'); 
        ?>
               <div class="col-md-6 col-xl-4 features__item">
                    <div class="features__itemInner">
                        <?php if( !empty( $featuresIcon ) ): ?>
                            <div class="features__icon">
                                <?php echo file_get_contents(wp_get_original_image_path($featuresIcon['id'])); ?>
                            </div>
                        <?php endif; ?>
                        <?php if ($featuresContent) : ?>
                            <div class="features__content"><?php echo $featuresContent;?></div>
                        <?php endif;?>
                    </div>
                </div>
            <?php endwhile;?>
        </div>
    </div>
</section>
<?php endif;?>