<?php
    $aboutPageTitle = get_sub_field('aboutPageTitle');
    $aboutPageTitleBack = get_sub_field('aboutPageTitleBack');
    $aboutPageImg = get_sub_field('aboutPageImg');
    $aboutPageContent = get_sub_field('aboutPageContent');
 ?>
<section class="aboutPage">
    <div class="aboutPage__contentWrapper">
        <div class="container--xlg">
        <?php if ($aboutPageTitle) : ?>
                <div class="aboutPage__title h2"><?php echo $aboutPageTitle;?></div>
            <?php endif;?>
            <?php if ($aboutPageTitleBack) : ?>
                <div class="titlePseudo"><?php echo $aboutPageTitleBack;?></div>
            <?php endif;?>
            <div class="row">
                <div class="col-lg-5 aboutPage__ImageWrapper">
                <?php if(!empty( $aboutPageImg) ): ?>
                      <img src="<?php echo esc_url($aboutPageImg['url']);?>" alt="<?php echo esc_attr($aboutPageImg['alt']); ?>">
                    <?php endif;?>
                </div>
                <div class="col-lg-7 aboutPage__contentInner">
                <?php if ($aboutPageContent) : ?>
                    <?php echo $aboutPageContent;?>
                <?php endif;?>
                </div>
            </div>
        </div>
    </div>
</section>