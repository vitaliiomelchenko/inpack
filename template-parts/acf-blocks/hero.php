<?php
        $hero_title = get_sub_field('hero_title');
        $hero_content = get_sub_field('hero_content');
        $hero_button = get_sub_field('hero_button');
?>
<section class="heroBanner">
    <div class="heroBanner__textWrapper">
        <div class="slick-next"></div>
        <div class="slick-prev"></div>
        <div class="heroBanner__textInner">
            <h1 class="heroBanner__title">
                <?php if ($hero_title) : ?>
                    <?php echo  $hero_title ?>
                <?php endif;?>
            </h1>
            <p class="heroBanner__text">
                <?php if ($hero_content) : ?>
                    <?php echo  $hero_content ?>
                <?php endif;?>
            </p>
            <?php if( $hero_button ): ?>
                <a href="<?php echo $hero_button['url'] ?>" class="button"><?php echo $hero_button['title'] ?></a>
            <?php endif;?>
        </div>
    </div>
    <?php if( have_rows('heroSlider') ):?>
        <div class="heroBanner__sliderWrapper">
            <?php while( have_rows('heroSlider') ) : the_row();
                $hero_background = get_sub_field('hero_background');
            ?>
                <?php if(!empty( $hero_background) ): ?>
                    <img src="<?php echo $hero_background['url'] ?> " alt="">
                <?php endif; ?> 
            <?php endwhile; ?>
        </div>
    <?php endif; ?> 
</section>
