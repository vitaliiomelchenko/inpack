<?php 
    $title = get_field('add_to_cart_popup_title', 'option');
    $catalogButton = get_field('add_to_cart_popup_button_1', 'option');
    $cartButton = get_field('add_to_cart_popup_button_2', 'option');
?>
<div class="add_to_cart_popup_wrapper" style="opacity: 0">
    <div class="add_to_cart_popup">
        <?php if($title): ?><h2><?php echo $title; ?></h2><?php endif; ?>
        <div class="buttons">
            <?php if($catalogButton): ?><a href="<?php echo $catalogButton['url'] ?>"><?php echo $catalogButton['title']; ?></a><?php endif; ?>
            <?php if($cartButton): ?><a href="<?php echo $cartButton['url'] ?>"><?php echo $cartButton['title']; ?></a><?php endif; ?>
        </div>
    </div>
</div>