<?php
        $hero_background = get_sub_field('hero_background');
        $hero_title = get_sub_field('hero_title');
        $hero_content = get_sub_field('hero_content');
        $hero_button = get_sub_field('hero_button');
?>
<section class="hero">
    <?php if(!empty( $hero_background) ): ?>
        <img src="<?php echo esc_url($hero_background['url']);?>" alt="<?php echo esc_attr($hero_background['alt']); ?>" class="hero__background">
     <?php endif;?>
        <div class="container container--lg hero__wrapper">
            <div class="row">

                <div class="heroContent__wrapper col-lg-8 col-xl-6">
                <?php if($hero_title) : ?>
                    <div class="hero__title h1"><?php echo $hero_title;?></div>
                  <?php endif;?>

                  <?php if($hero_content) : ?>
                    <div class="hero__content"><?php echo $hero_content;?></div>
                  <?php endif;?>
                  <?php if($hero_button) : ?>
                    <a href="#" class="button hero__button"><?php echo $hero_button;?></a>
                    <?php endif;?>
                </div>
            </div>
        </div>
    </section>