<?php 
    $shippingTitle = get_sub_field('shippingTitle'); 
    $shippingTitleBack = get_sub_field('shippingTitleBack'); 
?>

<section class="shipping shipping_section">
    <div class="shipping__content__wrapper">
        <div class="container titlePseudo--container">
            <?php if ($shippingTitle) : ?>
                <div class="shippingTitle h2 text-color-primary"><?php echo $shippingTitle;?></div>
            <?php endif;?>
            <?php if ($shippingTitleBack) : ?>
                <div class="titlePseudo shippingPseudo"><?php echo $shippingTitleBack;?></div>
            <?php endif;?>
        </div>
        <div class="container--featured">
            <?php if (have_rows('shippingItem') ): ?>
                <div class="row shipping__itemRow">
                    <?php while(have_rows('shippingItem') ) : the_row();
                        $shippingItemTitle = get_sub_field('shippingItemTitle'); 
                        $shippingItemContent = get_sub_field('shippingItemContent'); 
                        $shippingItemIcon = get_sub_field('shippingItemIcon'); 
                    ?>
                        <div class="col-md-6 shipping__item">
                            <?php if( !empty( $shippingItemIcon ) ): ?>
                                <div class="shipping__itemIcon">
                                    <?php echo file_get_contents(wp_get_original_image_path($shippingItemIcon['id'])); ?>
                                </div>
                            <?php endif;?>
                            <div class="shipping_itemInner">
                                <?php if ($shippingItemTitle) : ?>
                                    <div class="shipping__itemTitle"><?php echo $shippingItemTitle;?></div>
                                <?php endif;?>
                                <?php if ($shippingItemContent) : ?>
                                    <div class="shipping__itemContent"><?php echo $shippingItemContent;?></div>
                                <?php endif;?>
                            </div>
                        </div>
                    <?php endwhile;?>
                </div>
            <?php endif;?>
        </div>
    </div>
</section>