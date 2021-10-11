<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width" />
	<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_uri(); ?>" />
	<?php wp_head(); ?>

</head>
<?php global $woocommerce; ?>
<style>
	.header .header-bottom .icons-wrapper .icons li.cart:after{
		content: "<?php echo $woocommerce->cart->cart_contents_count; ?>";
	}
	.error404 header,
	.error404 footer {
		display: none;
	}
</style> 

<?php if(is_404()): ?>
	<?php $classes = 'hide-footer hide-header'; ?>
<?php else: ?>
	<?php $classes = ""; ?>
<?php endif; ?>
<body <?php body_class($classes); ?>>
	<?php if(!is_checkout()): ?>
	<header id="header" class="header">
		<div class="top-header">
			<div class="container">
				<div class="left-column">
					<?php $city = get_field( 'city', 'option' ); ?>
					<?php if($city): ?>
						<div class="place-wrapper">
							<div class="chosen-place text-m"><?php echo $city; ?></div>
						</div>
					<?php endif; ?>
				</div>
				<?php $logo = get_field('header_logo', 'option') ?>
				<?php if($logo) : ?>
					<div class="logo-wrapper">
						<a href="<?php echo get_home_url() ?>"><img src="<?php echo $logo; ?>" alt="" class="logo"></a>
					</div>
				<?php endif; ?>
				<div class="right-column">	
					<?php 
					$first_col = get_field('phone_numbers_first_col', 'option');
					$second_col = get_field('phone_numbers_second_col', 'option');
					?>	
					<div class="phone_numbers_wrapper">
						<?php if($first_col): ?>
							<div class="phone_numbers">
								<?php echo $first_col; ?>
							</div>
						<?php endif; ?>
						<?php if($second_col) : ?>
							<div class="phone_numbers">
								<?php echo $second_col; ?>
							</div>
						<?php endif; ?>
					</div>
					<div class="lang-wrapper">
						<?php 	
							wp_nav_menu( [
								'theme_location'  => 'lang-switcher',
								'menu'            => '',
								'container'       => '',
								'container_class' => '',
								'container_id'    => '',
								'menu_class'      => '',
								'menu_id'         => '',
								'echo'            => true,
								'fallback_cb'     => 'wp_page_menu',
								'before'          => '',
								'after'           => '',
								'link_before'     => '',
								'link_after'      => '',
								'items_wrap'      => '<ul id="menu-header-menu" class="%2$s">%3$s</ul>',
							] );
						?>
					</div>
				</div>
			</div>
		</div>
		<div class="header-menu">
			<div class="container">
				<?php 	
					wp_nav_menu( [
						'theme_location'  => 'header-menu',
						'menu'            => '',
						'container'       => '',
						'container_class' => '',
						'container_id'    => '',
						'menu_class'      => 'menu',
						'menu_id'         => '',
						'echo'            => true,
						'fallback_cb'     => 'wp_page_menu',
						'before'          => '',
						'after'           => '',
						'link_before'     => '',
						'link_after'      => '',
						'items_wrap'      => '<ul id="menu-header-menu" class="%2$s">%3$s</ul>',
					] );
				?>
			</div>
		</div>
		<div class="header-bottom">
			<div class="container">
				<?php 
				if(get_locale() == "uk"){
					$catalogButtonLabel = 'Каталог';
					$accountButtonLabel = 'Особистий кабінет';
					$mobileCatalogButton = 'Каталог товарів';
				}
				elseif(get_locale() == "ru_RU"){
					$catalogButtonLabel = 'Каталог';
					$accountButtonLabel = 'Личный кабинет';
					$mobileCatalogButton = 'Каталог товаров';
				}
				?>
				<div class="katalog"><?php echo $catalogButtonLabel ?></div>
				<div class="mobile_menu_open_button">
					<img src="<?php echo get_template_directory_uri(  ) ?>/assets/img/open_menu_button.svg" alt="">
				</div>
				<div class="search-form">
					<div class="search-arrow">
					</div>
					<?php echo do_shortcode('[ivory-search id="391" title="Default Search Form"]'); ?>
					<div class="clear-search-field">
					</div>
				</div>
				<?php if(is_user_logged_in()): ?>
				<?php $link = get_home_url() . '/my-account'; ?>
				<?php else: ?>
				<?php $link = "#"; ?>
				<?php endif; ?>
				<a class="kabinet" href="<?php echo $link ?>">
					<?php echo $accountButtonLabel; ?>
				</a>
				
				<div class="icons-wrapper">
					<ul class="icons">
						<li class="icon list"><a href="#"><img src="<?php echo get_template_directory_uri() ?>/assets/img/list.svg" alt=""></a></li>
						<li class="icon heart"><a href="<?php echo get_home_url() ?>/wishlist"><img src="<?php echo get_template_directory_uri() ?>/assets/img/heart.svg" alt=""></a></li>
						<li class="icon cart"><a href="<?php echo get_home_url() ?>/cart"><img src="<?php echo get_template_directory_uri() ?>/assets/img/cart.svg" alt=""></a></li>
					</ul>
				</div>
			</div>
		</div>
		<div class="katalog-menu-wrapper">
			<div class="katalog-menu">
				<ul class="katalog-categories-list">
					<?php 
					$args = array(
						'taxonomy' 		=> 'product_cat',
						'orderby' 		=> 'name',
						'parent' 		=> '0',
						'order'   		=> 'ASC',
						'number'		=>	9,
						'exclude' 		=> '57',
						'hide_empty' 	=> false,
					);
		
					$cats = get_categories($args);
		
					foreach($cats as $cat) {?>
					
						<li class="katalog-category">
							<a href="<?php echo get_category_link( $cat->term_id );?>" class="">
								<?php 
									$icon = get_term_meta( $cat->term_id, 'thumbnail_id', true ); 
								?>
								<?php if(!empty($icon)): ?>
									<div class="category-image">
										<?php echo file_get_contents(wp_get_original_image_path($icon)); ?>
									</div>
								<?php endif; ?>
								<div class="category-name"><?php echo $cat->name; ?></div>
							</a>
						</li>
					<?php 
					};
					?>
				</ul>
				<div class="katalog-menu-button-wrapper">
					<a href="<?php echo get_home_url() ?>/categories-page/" class="button">Всі товари</a>
				</div>
				<div class="close-menu-icon">
					<img src="<?php echo get_template_directory_uri() ?>/assets/img/close_header_icon.svg" alt="">
				</div>
			</div>
			
		</div>
		<a class="mobile_katalog_button" href="<?php echo get_home_url() ?>/categories-page">
			<?php echo $mobileCatalogButton; ?>
		</a>
		<div class="mobile_menu">
			<div class="mobile_menu_close_button">
			</div>
			<?php $logo = get_field('header_logo', 'option') ?>
			<?php if($logo) : ?>
				<div class="mobile_menu_logo">
					<img src="<?php echo $logo; ?>" alt="">
				</div>
			<?php endif; ?>
			<div class="menu">
				<div class="account_menu_item">
					<?php if(!is_user_logged_in(  )){
						$link = "#";
					}
					else{
						$link = get_home_url() . '/my-account/';
					} 
					?>
					<a href="<?php echo $link; ?>" class="kabinet"><?php echo $accountButtonLabel; ?></a>
				</div>
				<?php 	
					wp_nav_menu( [
						'theme_location'  => 'header-menu',
						'menu'            => '',
						'container'       => '',
						'container_class' => '',
						'container_id'    => '',
						'menu_class'      => 'menu',
						'menu_id'         => '',
						'echo'            => true,
						'fallback_cb'     => 'wp_page_menu',
						'before'          => '',
						'after'           => '',
						'link_before'     => '',
						'link_after'      => '',
						'items_wrap'      => '<ul id="menu-header-menu" class="%2$s">%3$s</ul>',
					] );
				?>
				<a href="<?php echo get_home_url(  ) ?>/wishlist" class="wishlist_menu_link"><?php _e('Список бажань'); ?></a>
			</div>
			<div class="languages_wrapper">
				<div class="language_title">
					<?php if(get_locale() == 'uk'){ echo 'Мова'; }elseif(get_locale() == 'ru_RU'){ echo 'Язык'; } ?>
				</div>
				<?php 	
					wp_nav_menu( [
						'theme_location'  => 'lang-switcher',
						'menu'            => '',
						'container'       => '',
						'container_class' => '',
						'container_id'    => '',
						'menu_class'      => '',
						'menu_id'         => '',
						'echo'            => true,
						'fallback_cb'     => 'wp_page_menu',
						'before'          => '',
						'after'           => '',
						'link_before'     => '',
						'link_after'      => '',
						'items_wrap'      => '<ul id="menu-header-menu" class="%2$s">%3$s</ul>',
					] );
				?>
			</div>
			<?php if(have_rows('mobile_menu_social_media', 'option')): ?>
			<div class="mobile_social_network_list">
				<?php while(have_rows('mobile_menu_social_media', 'option')): the_row(); ?>
					<?php $link = get_sub_field('link'); ?>
					<?php $icon = get_sub_field('icon'); ?>
					<a href="<?php echo $link; ?>" class="mobile_social_network_list_item"><img src="<?php echo $icon; ?>" alt=""></a>
				<?php endwhile; ?>
			</div>
			<?php endif; ?>
		</div>
	</header>
	<?php if(is_shop()){
		get_template_part('/template-parts/add_to_cart_message');
	}; ?>
	<div class="overlay"></div>
	<div class="wrong_account_data woocommerce_message"><?php do_action( 'woocommerce_before_customer_login_form' ); ?></div>
	<div class="contact_form_wrapper">
		<?php 
		if(get_locale() == "uk"){echo do_shortcode('[contact-form-7 id="472" title="Contact header form"]');}
		elseif(get_locale() == 'ru_RU'){echo do_shortcode('[contact-form-7 id="607" title="Contact header form(ru)"]'); }
		?>
		<div class="close_popup_cross">
			<svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M15 1.93376L13.0481 0L7.49963 5.50193L1.95094 0L0 1.93469L5.54813 7.43662L0 12.9389L1.95094 14.8732L7.49963 9.37187L13.0481 14.8732L15 12.9389L9.45094 7.43662L15 1.93376Z" fill="white"/>
			</svg>
		</div>
	</div>
	<?php if(!is_user_logged_in()): ?>
		<?php 
		if(get_locale() == 'uk'){
			$formTitle = 'Вхід';
			$notRegisteredLabel = 'Не зареєстровані?';
			$notRegisteredButton = 'Зареєструватися';
			$registerFormTitle = 'Реєстрація';
		}
		if(get_locale() == 'ru_RU'){
			$formTitle = 'Вход';
			$notRegisteredLabel = 'Не зарегистрированы?';
			$notRegisteredButton = 'Зарегистрироваться';
			$registerFormTitle = 'Регистрация';
		}
		?>
		<div class="log-in_popup-wrapper">
			<div class="log-in_popup">
				<div class="popup-title"><?php echo $formTitle; ?></div>
				<div class="close-icon"></div>
				<form class="woocommerce-form woocommerce-form-login login" method="post">

					<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
						<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="username" autocomplete="username" placeholder="Email" value="" /><?php // @codingStandardsIgnoreLine ?>
					</p>
					<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide password_field">
						<input class="woocommerce-Input woocommerce-Input--text input-text" type="password" name="password" id="password" autocomplete="current-password" placeholder="Пароль" />
					</p>

					<div class="not-registered">
						<?php echo $notRegisteredLabel; ?>
						<a href="#"><?php echo $notRegisteredButton; ?></a>
					</div>

					<p class="form-row submit-button-wrapper">
						<label class="woocommerce-form__label woocommerce-form__label-for-checkbox woocommerce-form-login__rememberme">
							<input class="woocommerce-form__input woocommerce-form__input-checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever" /> <span><?php esc_html_e( 'Remember me', 'woocommerce' ); ?></span>
						</label>
						<?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
						<button type="submit" class="woocommerce-button button woocommerce-form-login__submit" name="login" value="<?php esc_attr_e( 'Log in', 'woocommerce' ); ?>"><?php if(get_locale() == 'uk'){ echo 'Вхід'; }elseif(get_locale() == 'ru_RU'){ echo 'Войти'; } ?></button>
					</p>

				</form>
			</div>
		</div>
		<div class="register_popup-wrapper">
			<div class="register_popup">
				<div class="popup-title"><?php echo $registerFormTitle; ?></div>
				<div class="close-icon"></div>
				
				<?php if ( 'yes' === get_option( 'woocommerce_enable_myaccount_registration' ) ) : ?>

				

				<div class="u-column2 col-12">


					<form method="post" class="woocommerce-form woocommerce-form-register register" <?php do_action( 'woocommerce_register_form_tag' ); ?> >

						<?php do_action( 'woocommerce_register_form_start' ); ?>

						<?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>

							<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
								<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="reg_username" autocomplete="username" value="" /><?php // @codingStandardsIgnoreLine ?>
							</p>

						<?php endif; ?>

						<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
							<input type="email" class="woocommerce-Input woocommerce-Input--text input-text" name="email" id="reg_email" autocomplete="email" placeholder="Email" value="" /><?php // @codingStandardsIgnoreLine ?>
						</p>

						<?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>

							<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
								<input type="password" class="woocommerce-Input woocommerce-Input--text input-text" name="password" id="reg_password" placeholder="Пароль" autocomplete="new-password" />
							</p>

						<?php else : ?>

							<p><?php esc_html_e( 'A password will be sent to your email address.', 'woocommerce' ); ?></p>

						<?php endif; ?>

						<?php do_action( 'woocommerce_register_form' ); ?>

						<div class="form-checkbox">
							<input type="checkbox" id="rules">
							<label for="rules">
								<?php if(get_locale() == 'uk'){ echo 'Я приймаю умови <a href="">Угоди користувача</a> та згоден на обрабку персональних даних'; }elseif(get_locale() == 'ru_RU'){ echo 'Я принимаю условия <a href=""> Пользовательского соглашения </a> и согласен на обрабку персональных данных'; } ?>
							</label>
						</div>

						<div class="registered">
							<?php if(get_locale() == 'uk'){ echo 'Вже зареєстровані? '; }elseif(get_locale() == 'ru_RU'){ echo 'Уже зарегистрированы?'; } ?>
							<a href="#"><?php if(get_locale() == 'uk'){ echo 'Увійти'; }elseif(get_locale() == 'ru_RU'){ echo 'Войти'; } ?></a>
						</div>
						<p class="woocommerce-form-row form-row submit-button-wrapper">
							<?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
							<button type="submit" class="woocommerce-Button woocommerce-button button woocommerce-form-register__submit" name="register" value="<?php esc_attr_e( 'Register', 'woocommerce' ); ?>" disabled><?php esc_html_e( 'Register', 'woocommerce' ); ?></button>
						</p>

						<?php do_action( 'woocommerce_register_form_end' ); ?>

					</form>

				</div>

				</div>
				<?php endif; ?>
			</div>
		</div>
	<?php endif; ?>
	<?php else: ?>
		<header class="checkout_header">
			<div class="container">
				<div class="checkout_header_content">
					<?php $logo = get_field('header_logo', 'option'); ?>
					<?php if($logo): ?>
						<div class="logo">
							<a href="<?php echo get_home_url() ?>">
								<img src="<?php echo $logo ?>" alt="">
							</a>
						</div>
					<?php endif; ?>
					<?php 
					$first_col = get_field('phone_numbers_first_col', 'option');
					$second_col = get_field('phone_numbers_second_col', 'option');
					?>	
					<div class="phone_numbers row">
						<?php if($first_col): ?>
							<div class="col-6 phone_numbers_col">
								<?php echo $first_col; ?>
							</div>
						<?php endif; ?>
						<?php if($second_col) : ?>
							<div class="col-6 phone_numbers_col">
								<?php echo $second_col; ?>
							</div>
						<?php endif; ?>
					</div>
					
				</div>
			</div>
			
		</header>
	<?php endif; ?>
	<?php if(get_locale() == 'ru_RU'): ?>
		<script>
			jQuery(document).ready(function(){
				jQuery('.header .is-search-form input[type="search"]').attr('placeholder', 'Я ищу...');
				jQuery('.header .is-search-form input[type="submit"]').attr('value', 'Поиск');
			});
			console.log('123');
		</script>
	<?php endif; ?>
	<div id="main">
