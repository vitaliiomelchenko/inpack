<?php 
    $orderRulesTitle = get_sub_field('orderRulesTitle'); 
?>
<section class="orderRules">
    <div class="container">
        <?php if ($orderRulesTitle) : ?>
            <div class="orderRules__title h2"><?php echo $orderRulesTitle;?></div>
        <?php endif;?>
        <?php if (have_rows('orderRulesItem') ): ?>
            <ol class="row">
                <?php $i = 1; ?>
                <?php while(have_rows('orderRulesItem') ) : the_row();
                    $orderRulesItemTitle = get_sub_field('orderRulesItemTitle'); 
                    $orderRulesItemContent = get_sub_field('orderRulesItemContent');  ?>
                    <li class=" col-lg-4 orderRules__item">
                        <div class="item_number">
                            <?php echo $i; ?>
                        </div>
                        <div class="orderRules__itemInner" >
                            <?php if ($orderRulesItemTitle) : ?>
                                <div class="orderRules__itemTitle"><?php echo $orderRulesItemTitle;?></div>
                            <?php endif;?>
                            <?php if ($orderRulesItemContent) : ?>
                                <div class="orderRules__itemContent"><?php echo $orderRulesItemContent;?></div>
                            <?php endif;?>
                        </div>
                    </li>
                    <?php $i++; ?>
                <?php endwhile;?>
            </ol>
        <?php endif;?>
    </div>
</section>