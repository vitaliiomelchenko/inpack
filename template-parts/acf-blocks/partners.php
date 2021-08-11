<?php 
    $partnersTitle = get_sub_field('partnersTitle');
    $partnersTitleBack = get_sub_field('partnersTitleBack');
?>
<section class="partners">
    <div class="partners__content__wrapper">
        <div class="container">
        <?php if ($partnersTitle) : ?>
            <div class="partners__title h1"><?php echo $partnersTitle;?></div>
        <?php endif;?>
            <?php if ($partnersTitleBack) : ?>
                <div class="titlePseudo"><?php echo $partnersTitleBack;?></div>
            <?php endif;?>
        </div>
         <div data-slick='{"slidesToShow": 6, "slidesToScroll": 4}'>
            <div class="container slider">
                <div class=" slider_wrapper">
                <?php if (have_rows('slider_item') ): ?>
                    <?php while(have_rows('slider_item') ) : the_row();
                        $slider_itemImg = get_sub_field('slider_itemImg'); 
                    ?>
                        <div class="slider_item_wrapper ">
                            <div class="slider_item">
                                <?php if(!empty( $slider_itemImg) ): ?>
                                    <img src="<?php echo esc_url($slider_itemImg['url']);?>" alt="<?php echo esc_attr($slider_itemImg['alt']); ?>" class="slider_itemImg">
                                <?php endif;?>
                            </div>
                        </div>
                    <?php endwhile;?>               
                </div>
            </div>
        </div>
    </div> 
</section> 
    <?php endif;?>