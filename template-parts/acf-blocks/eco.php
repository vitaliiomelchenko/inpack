<?php 
    $ecoTitle = get_sub_field('ecoTitle'); 
    $ecoContent = get_sub_field('ecoContent'); 
    $ecoImage = get_sub_field('ecoImage'); 
?>
<section class="eco">
    <div class="container">
        <div class="row">
            <div class="col-md-7 eco__content__wrapper">
                <?php if ($ecoTitle) : ?>
                <h1 class="eco__title"><?php echo $ecoTitle;?></h1>
                <?php endif;?>
                <?php if ($ecoContent) : ?>
                <div class="eco__content"><?php echo $ecoContent;?></div>
                <?php endif;?>
            </div>
            <div class="col-md-5">

                <div class="eco__img__wrapper">
                    <?php if(!empty( $ecoImage) ): ?>
                    <img src="<?php echo esc_url($ecoImage['url']);?>" alt="">
                    <?php endif;?>
                </div>
            </div>
        </div>
    </div>
</section>