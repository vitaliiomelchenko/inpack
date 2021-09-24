<?php get_header() ?>
    <section class="page_not_found">
        <div class="left_ribbons"><img src="<?php echo get_template_directory_uri(  ) . '/assets/img/left_ribbons.svg' ?>" alt=""></div>
        <div class="right_ribbons"><img src="<?php echo get_template_directory_uri(  ) . '/assets/img/right_ribbons.svg' ?>" alt=""></div>
        <div class="main_image"><img src="<?php echo get_template_directory_uri(  ) . '/assets/img/main image.svg' ?>" alt=""></div>
        <div class="button_wrapper">
            <a href="<?php echo get_home_url() ?>" class="button"><?php if(get_locale() == 'uk'){echo 'Повернутись до каталогу';}elseif(get_locale() == 'ru_RU'){echo 'Вернуться в каталог';} ?></a>
        </div>
    </section>
<?php get_footer(); ?>