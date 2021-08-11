<?php 
    $advantagesTitle = get_sub_field('advantagesTitle'); 
?>

<section class="advantages">
        <div class="container ">
        <?php if ($advantagesTitle) : ?>
            <h2 class="advantages__title"><?php echo $advantagesTitle;?></h2>
        <?php endif;?>
            <div class="row advantages__row ">
            <div class="col-lg-auto advantages__itemWrapper">
                    <?php if (have_rows('first_repeater') ): ?>
                        <?php while(have_rows('first_repeater') ) : the_row();
                            $advantages_itemTitle = get_sub_field('advantages_itemTitle'); 
                            $advantages_itemContent = get_sub_field('advantages_itemContent'); 
                        ?>
                    <div class="advantages__item">
                        <?php if ($advantages_itemTitle) : ?>
                            <h4 class="advantages__itemTitle"><?php echo $advantages_itemTitle;?></h4>
                        <?php endif;?>
                    <?php if ($advantages_itemContent) : ?>
                        <div class="advantages__item__content"><?php echo $advantages_itemContent;?></div>
                    <?php endif;?>
                    </div>
                    <?php endwhile;?>    
                </div>
                <?php endif;?>
                




                <div class="col-lg-auto advantages__item__big__wrapper">
                    <?php if (have_rows('advantages_third') ): ?>
                        <?php while(have_rows('advantages_third') ) : the_row();
                            $advantagesBigTitle = get_sub_field('advantagesBigTitle'); 
                            $advantagesBigContent = get_sub_field('advantagesBigContent'); 
                        ?>
                    <div class="advantages__item__big">
                        <?php if ($advantagesBigTitle) : ?>
                            <h2 class="advantages__item__big__title"><?php echo $advantagesBigTitle;?></h2>
                        <?php endif;?>
                            <?php if ($advantagesBigContent) : ?>
                                <div class="advantages__item__big__content"><?php echo $advantagesBigContent;?></div>
                            <?php endif;?>
                            </div>
                        <?php endwhile;?> 
                    </div>
                    <?php endif;?> 

                <div class="col-lg-auto advantages__itemWrapper">
                    <?php if (have_rows('advantages_second') ): ?>
                        <?php while(have_rows('advantages_second') ) : the_row();
                            $advantages_itemTitle = get_sub_field('advantages_itemTitle_second'); 
                            $advantages_itemContent = get_sub_field('advantages_itemContent_second'); 
                        ?>
                    <div class="advantages__item">
                        <?php if ($advantages_itemTitle) : ?>
                            <h4 class="advantages__itemTitle"><?php echo $advantages_itemTitle;?></h4>
                        <?php endif;?>
                    <?php if ($advantages_itemContent) : ?>
                        <div class="advantages__item__content"><?php echo $advantages_itemContent;?></div>
                    <?php endif;?>
                    </div>
                    <?php endwhile;?>    
                </div>
                <?php endif;?>
                </div>
            </div>
        </div>
    </section>
    <div class="container">
        <div class=" catalog__btn">
            <a href="#">Перейти в каталог</a>
        </div>
    </div>
    </div>