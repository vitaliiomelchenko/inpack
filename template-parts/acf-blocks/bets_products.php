<section class="best_products">
    <?php $block_title = get_sub_field('block_title'); ?>
    <?php if($block_title): ?>
        <div class="container block_title_container">
            <div class="background_block_title"><?php echo $block_title; ?></div>
            <h2 class="block_title"><?php echo $block_title; ?></h2>
        </div>
    <?php endif; ?>
    <div class="container">
        <?php 
            echo do_shortcode('[products limit="6"]');
        ?>
        <?php $button = get_sub_field('button'); ?>
        <?php if($button): ?>
            <div class="button_wrapper"><a href="<?php echo $button['url'] ?>" class="button"><?php echo $button['title'] ?></a></div>
        <?php endif; ?>
    </div>
</section>