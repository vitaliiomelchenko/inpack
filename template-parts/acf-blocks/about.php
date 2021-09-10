<?php 
    $aboutTitle = get_sub_field('aboutTitle'); 
    $aboutImg= get_sub_field('aboutImg'); 
?>

<section class="about homeAbout">
    <div class="container container--lg">
        <div class="row">
            <div class="col-lg-10">
                <?php if ($aboutTitle) : ?>
                    <div class="about__title"><?php echo $aboutTitle;?></div>
                <?php endif;?>
                <div class="row about__wrapper">
                    <?php if (have_rows('aboutWrapper') ): ?>
                        <?php while(have_rows('aboutWrapper') ) : the_row();
                            $about__ItemIcon = get_sub_field('about__ItemIcon'); 
                            $about__itemContent = get_sub_field('about__itemContent'); 
                        ?>
                    <div class="col-lg-4 about__item">
                        <?php if( !empty( $about__ItemIcon ) ): ?>
                            <div class=" about__item__icon"> 
                                <?php echo file_get_contents(wp_get_original_image_path($about__ItemIcon['id'])); ?>
                            </div>
                        <?php endif; ?>

                        <?php if ($about__itemContent) : ?>
                            <div class="about__item__content"><?php echo $about__itemContent;?></div>
                        <?php endif;?>
                    </div>
                    <?php endwhile;?>
                </div>
            </div>
                    <?php endif;?>
                    <?php if(!empty( $aboutImg) ): ?>
                      <img class="homeAbout__img" src="<?php echo esc_url($aboutImg['url']);?>" alt="<?php echo esc_attr($aboutImg['alt']); ?>">
                    <?php endif;?>

        </div>
    </div>
</section>
