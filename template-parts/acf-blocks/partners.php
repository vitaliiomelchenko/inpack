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
            <div class="container slider">
            <div class="slick-next"></div>
            <div class="slick-prev"></div>
                <div class="partners__row row">
                <?php if (have_rows('slider_item') ): ?>
                    <?php while(have_rows('slider_item') ) : the_row();
                        $slider_itemImg = get_sub_field('slider_itemImg'); 
                    ?>
                        <?php if(!empty( $slider_itemImg) ): ?>
                            <img src="<?php echo esc_url($slider_itemImg['url']);?>" alt="<?php echo esc_attr($slider_itemImg['alt']); ?>" class="slider_itemImg">
                        <?php endif;?>
                    <?php endwhile;?>               
                </div>
            </div>
        </div>
</section> 
<script>
      jQuery('.partners__row').slick({
  infinite: false,
  slidesToShow: 1,
  slidesToScroll: 1
});
</script>
    <?php endif;?>