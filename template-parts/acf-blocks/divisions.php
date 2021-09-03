<?php 
    $divisionsTitle = get_sub_field('divisionsTitle'); 
?>
<section class="divisions">
    <div class="divisions_wrapper">
        <?php if ($divisionsTitle) : ?>
            <div class="divisions__title h2"><?php echo $divisionsTitle;?></div>
            <?php endif;?>
            <div class="col-lg-10">
                <div class="row">
                        <div class="col-md-5 divisions__ItemWrapper">
                    <?php if (have_rows('divisionsItem') ): ?>
                    <?php while(have_rows('divisionsItem') ) : the_row();
                        $divisionsItemContent = get_sub_field('divisionsItemContent'); 
                    ?>
                    
                            <div class="divisions__item">
                            <?php if ($divisionsTitle) : ?>
                                <div class="divisionsItemContent"><?php echo $divisionsItemContent;?></div>
                            <?php endif;?>
                            </div>
                        
                        <?php endwhile;?>
                        </div>
                        <?php endif;?>
                        <div class="col-md-6 divisions__ItemWrapper">
                        <?php if (have_rows('divisionsItemSecond') ): ?>
                            <?php while(have_rows('divisionsItemSecond') ) : the_row();
                        $divisionsItemContentSecond = get_sub_field('divisionsItemContentSecond'); 
                    ?>
                            <div class="divisions__item">
                            <?php if ($divisionsItemContentSecond) : ?>
                                <div class="divisionsItemContent"><?php echo $divisionsItemContentSecond;?></div>
                            <?php endif;?>
                            </div>
                        
                        <?php endwhile;?>
                        <?php endif;?>
                    </div>
                </div>
            </div>
        </div>
    </section>