<?php
/**
 * Show options for ordering
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/orderby.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>

<form class="woocommerce-ordering" method="get" style="display: none;">
	<select name="orderby" class="orderby" aria-label="<?php esc_attr_e( 'Shop order', 'woocommerce' ); ?>">
		<?php foreach ( $catalog_orderby_options as $id => $name ) : ?>
			<option value="<?php echo esc_attr( $id ); ?>" <?php selected( $orderby, $id ); ?>><?php echo esc_html( $name ); ?></option>
		<?php endforeach; ?>
	</select>
</form>
<?php 
if(get_locale() == 'uk'){
	$byPopularityLabel = 'за популярністю';
	$byPriceLabel = 'за зростанням ціни';
	$byPriceDescLabel = 'за зменшенням ціни';
	$byAlphabet = 'за алфавітом';
}
elseif(get_locale() == 'ru_RU'){
	$byPopularityLabel = 'по популярности';
	$byPriceLabel = 'по возрастанию цены';
	$byPriceDescLabel = 'по убыванию цены';
	$byAlphabet = 'по алфавиту';
}
?>
<style>
	.katalog .container .katalog-items .top-filter-row .filter-list .filter-list-item.price:before {
		content: "<?php echo $byPriceLabel; ?>";
	}
	.katalog .container .katalog-items .top-filter-row .filter-list .filter-list-item.price-desc:before {
		content: "<?php echo $byPriceDescLabel; ?>";
	}
</style>
<a href="<?php echo  get_home_url() . '/shop/' ?>" class="popularity first filter-list-item"><?php echo $byPopularityLabel; ?></a>
<?php foreach ( $catalog_orderby_options as $id => $name ) : ?>
	<a href="<?php echo  get_home_url() . '/shop/?orderby=' . esc_attr( $id ) . '&paged=1' ?>" class="<?php echo esc_attr( $id ); ?> filter-list-item" id="<?php esc_attr( $id ) ?>"><?php echo esc_html( $name ); ?><?php echo $paged; ?></a>
<?php endforeach; ?>
<a href="<?php echo  get_home_url() . '/shop/?orderby=title&paged=1' ?>" class="title filter-list-item"><?php echo $byAlphabet; ?></a>
<input type="hidden" name="paged" value="1" />
<?php wc_query_string_form_fields( null, array( 'orderby', 'submit', 'paged', 'product-page' ) ); ?>