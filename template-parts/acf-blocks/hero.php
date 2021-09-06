<?php
        $hero_background = get_sub_field('hero_background');
        $hero_title = get_sub_field('hero_title');
        $hero_content = get_sub_field('hero_content');
        $hero_button = get_sub_field('hero_button');
?>
<section class="heroBanner">
    <div class="heroBanner__textWrapper">
        <div class="slick-next"></div>
        <div class="slick-prev"></div>
        <div class="heroBanner__textInner">
            <h1 class="heroBanner__title">
                <?php echo  $hero_title ?>
            </h1>
            <p class="heroBanner__text">
                <?php echo  $hero_content ?>
            </p>
            <a href="<?php echo $hero_button['url'] ?>" class="button"><?php echo $hero_button['title'] ?></a>
        </div>
    </div>
    <div class="heroBanner__sliderWrapper">
        <img src="<?php echo $hero_background['url'] ?> " alt="">
        <img src="<?php echo $hero_background['url'] ?> " alt="">
        <img src="<?php echo $hero_background['url'] ?> " alt="">
    </div>
</section>
<script>
    jQuery('.heroBanner__sliderWrapper').slick({
        dots: false,
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        prevArrow: jQuery('.heroBanner .slick-prev'),
        nextArrow: jQuery('.heroBanner .slick-next'),
});
</script>