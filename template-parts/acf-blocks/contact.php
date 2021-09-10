<?php 
    $contactTitle = get_sub_field('contactTitle');
    $contactTitleBack = get_sub_field('contactTitleBack');
    $contactForm= get_sub_field('contactForm');
    $contactItemIconLoc = get_sub_field('contactItemIconLoc');
    $contactItemContentLoc = get_sub_field('contactItemContentLoc');
    $contactItemContentNoIcon = get_sub_field('contactItemContentNoIcon');
?>

<section class="contact">
    <div class="contact__content__wrapper">
            <div class="contact_page_top" style="position: relative;">
                <?php if ($contactTitle) : ?>
                    <div class="contact__title h2"><?php echo $contactTitle;?></div>
                <?php endif;?>
                <?php if ($contactTitleBack) : ?>
                    <div class="titlePseudo"><?php echo $contactTitleBack;?></div>
                <?php endif;?>
            </div>
            <div class="row">
                <div class="col-md-6 contact__itemWrapper">
                    <div class="row">
                    <?php if (have_rows('contactItem') ): ?>
                    <?php while(have_rows('contactItem') ) : the_row();
                        $contactItemContent = get_sub_field('contactItemContent'); 
                        $contactItemIcon = get_sub_field('contactItemIcon'); 
                        ?>
                
                    <!-- rep -->
                    <div class="contact__item col-md-6">
                        <?php if ($contactItemIcon) : ?>
                            <div class="contact__itemIcon"> <?php echo file_get_contents(wp_get_original_image_path($contactItemIcon['id'])); ?></div>
                            <?php endif;?>
                        <?php if ($contactItemContent) : ?>
                            <div class="contact__itemContent"><?php echo $contactItemContent;?></div>
                        <?php endif;?>
                    </div>
                    <?php endwhile;?>
                    <?php endif;?>
                   <!-- rep -->
                    <!-- field -->
                    <div class="contact__item  contact__item__loc">
                    <?php if ($contactItemIconLoc) : ?>
                            <div class="contact__itemIcon location"><?php echo file_get_contents(wp_get_original_image_path($contactItemIconLoc['id'])); ?></div>
                        <?php endif;?>
                        <?php if ($contactItemContentLoc) : ?>
                            <div class="contact__itemContent_location"><?php echo $contactItemContentLoc;?></div>
                        <?php endif;?>
                    </div>
                    <!-- field -->
                    <div class="contact__item contact__itemContentNOICON__wrapper">
                    <?php if ($contactItemContentNoIcon) : ?>
                        <div class=" contact__itemContentNOICON"><?php echo $contactItemContentNoIcon;?></div>
                    <?php endif;?>
                    </div>
                    <!-- field -->
                </div>
                </div>
                <div class="col-md-6 contact__formWrapper">
                    <div class="contact__form">
                    <?php if ($contactForm) : ?>
                        <?php echo $contactForm;?>
                    <?php endif;?>
                    </div>
                </div>
            </div>
    </div>
</section>