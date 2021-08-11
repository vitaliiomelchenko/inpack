<?php 
    $paymentInfoTitle = get_sub_field('paymentInfoTitle'); 
?>

<section class="paymentInfo">
    <div class="container--featured--sm">
        <?php if ($paymentInfoTitle) : ?>
            <h2 class="paymentInfo__title "><?php echo $paymentInfoTitle;?></h2>
        <?php endif;?>
        <?php if (have_rows('paymentInfoItem') ): ?>
            <?php while(have_rows('paymentInfoItem') ) : the_row();
                $paymentInfoItemIcon = get_sub_field('paymentInfoItemIcon'); 
                $paymentInfoItemContent = get_sub_field('paymentInfoItemContent'); 
            ?>
        <div class="paymentInfo__item">
        <?php if( !empty( $paymentInfoItemIcon ) ): ?>
            <div class="paymentInfo__itemIcon"> <?php echo file_get_contents(wp_get_original_image_path($paymentInfoItemIcon['id'])); ?></div>
                <?php endif;?>
            <?php if ($paymentInfoItemContent) : ?>
                <div class="paymentInfo__itemContent"><?php echo $paymentInfoItemContent;?></div>
            <?php endif;?>
        </div> 
        <?php endwhile;?>
    </div>
</section>
<?php endif;?>