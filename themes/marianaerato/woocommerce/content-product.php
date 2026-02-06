<?php
defined('ABSPATH') || exit;

global $product, $post;
$product_id = get_the_ID();
// Check if the product is a valid WooCommerce product and ensure its visibility before proceeding.
if (!is_a($product, WC_Product::class) || !$product->is_visible()) {
    return;
}
$regular_price = get_post_meta($product_id, '_regular_price', true);
$sale_price = get_post_meta($product_id, '_sale_price', true);
$current_price = number_format(get_post_meta($product_id, '_price', true), 2, ',', '.');
$currency = get_woocommerce_currency();
$currency_symbol = get_woocommerce_currency_symbol($currency) ?? '';
$image = wp_get_attachment_image_src(get_post_thumbnail_id($product_id), 'single-post-thumbnail');
if(str_contains($image[0] ?? '', 'marianaerato.com')) {
	$image = str_replace('wordpress/', '', $image);
}
$text = get_field('buy_this_post_text', 'option') ?? 'Buy this post for %s';
$color = get_field('sales_text_color', $product_id);
?>
<style>.mm-background { background-image: url(<?php echo $image[0] ?? ''; ?>); }</style>
<div <?php wc_product_class('mm--product_content', $product); ?>>
  <div class='mm-background'>&nbsp;</div>
  <div class='mm-background-overlay'>&nbsp;</div>
  <h4 class='mm-buy_this'>
      <?php echo sprintf(__($text, 'marianaerato'), $currency_symbol. $current_price);
      $checkout_url = apply_filters('wpml_permalink', wc_get_checkout_url(), apply_filters('wpml_current_language', null)); ?>
  </h4>
  <a href="<?php echo $checkout_url ?>?add-to-cart=<?php echo $product_id ?>&quantity=1" class="mm-add_to_cart"><?php _e('Buy now'); ?></a>
</div>
<div class='mm-excerpt'>
  <?php echo $post->post_excerpt; ?>
</div>
<?php
$product_template = get_field('pay_per_post_product_template', 'option');
if ($product_template) {
    echo do_shortcode('[elementor-template id="' . $product_template . '"]');
}
?>
<script>
    (function ($) {
        $('body').on('click', '.mm-add_to_cart', function () {
            localStorage.setItem('mm_redirect_to', '<?php echo get_permalink($post->ID);?>');
        })
    })(jQuery)
</script>
