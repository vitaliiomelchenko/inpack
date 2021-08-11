<?php 
    $promoTitle = get_sub_field('promoTitle');
    $promoItemContent_1 = get_sub_field('promoItemContent_1');
    $promoItemContent_2 = get_sub_field('promoItemContent_2');
    $promoItemContent_3 = get_sub_field('promoItemContent_3');
    $promoButton = get_sub_field('promoButton');
    $promoTitleBack = get_sub_field('promoTitleBack');
?>
<section class="promo">
    <div class="promo__content__wrapper">
        <div class="container container--md ">
            <?php if ($promoTitle) : ?>
                <div class="promo__title h2"><?php echo $promoTitle;?></div>
            <?php endif;?>
            <?php if ($promoTitleBack) : ?>
                <div class="titlePseudo"><?php echo $promoTitleBack;?></div>
            <?php endif;?>
            <div class="row">
                <div class="col-lg-7 promo__item__wrapper">
                    <div class="promo__item">
                        <?php if ($promoItemContent_1) : ?>
                            <div class="promo__item__content"><?php echo $promoItemContent_1;?></div>
                        <?php endif;?>
                        <?php if ($promoButton) : ?>
                            <a href="#" class="promo__btn"><?php echo $promoButton;?></a>
                        <?php endif;?>
                    </div>
                    <div class=" promo__item promo__item__second">
                    <?php if ($promoItemContent_2) : ?>
                            <div class="promo__item__content"><?php echo $promoItemContent_2;?></div>
                        <?php endif;?>
                        <?php if ($promoButton) : ?>
                            <a href="#" class="promo__btn"><?php echo $promoButton;?></a>
                        <?php endif;?>
                    </div>
                </div>
                <div class="col-lg-5 promo__item__wrapper">
                    <div class="promo__item__big">
                    <?php if ($promoItemContent_3) : ?>
                            <div class="promo__item__content"><?php echo $promoItemContent_3;?></div>
                        <?php endif;?>
                        <?php if ($promoButton) : ?>
                            <a href="#" class="promo__btn"><?php echo $promoButton;?></a>
                        <?php endif;?>
                    </div>
                </div>
            </div>
            <div class=" catalog__btn">
                <a href="#">Перейти в каталог</a>
            </div>
        </div>
    </div>
</section>