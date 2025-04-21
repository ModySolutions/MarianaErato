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
$text = get_field('buy_this_post_text', 'option') ?? 'Buy this post for %s';
$color = get_field('sales_text_color', $product_id);
?>
<style>.mm--product_content {
        width: 100%;
        height: 450px;
        overflow: hidden;
        position: relative;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
    }.mm--featured_image {
        width: 100% !important;
        height: 100% !important;
        object-fit: cover;
        object-position: center center;
        filter: brightness(100%) contrast(100%) saturate(100%) blur(25px) hue-rotate(0deg);
    }.mm-add_to_cart {
        color: var(--e-global-color-primary) !important;
        background-color: var(--e-global-color-text);
        transition: all 0.2s;
        text-align: center;
        font-size: 100%;
        margin: 0;
        line-height: 1;
        cursor: pointer;
        text-decoration: none;
        overflow: visible;
        padding: 1rem 2rem;
        font-weight: 700;
        border-radius: 3px;
        border: 0;
        display: inline-block;
        background-image: none;
        box-shadow: none;
        text-shadow: none;
        z-index: 99999;
        position:relative;
    }.mm-add_to_cart:hover {
        color: var(--e-global-color-primary) !important;
    }.mm-buy_this {
        color: var(--e-global-color-accent) !important;
        max-width: 350px;
        text-align: center;
        z-index: 99999;
    }.mm-background {
        position: absolute;
        height: 100%;
        width: 100%;
        background-image: url(<?php  echo $image[0]; ?>);
        background-repeat: no-repeat;
        background-position: center center;
        background-size: cover;
        filter: brightness(100%) contrast(100%) saturate(100%) blur(.75rem) hue-rotate(0deg);
        z-index: -1;
    }.mm-background-overlay {
         background-color: black;
         position: absolute;
         height: 100%;
         width: 100%;
        opacity: .25;
                                     }.mm-excerpt {margin-top: 1rem;}</style>
<div <?php
wc_product_class('mm--product_content', $product); ?>>
  <div class='mm-background'>&nbsp;</div>
  <div class='mm-background-overlay'>&nbsp;</div>
  <h4 class='mm-buy_this'><?php
      echo sprintf(__($text, 'marianaerato'), $currency_symbol
          . $current_price);
$checkout_url = apply_filters('wpml_permalink', wc_get_checkout_url(), apply_filters('wpml_current_language', null));
?></h4><a href="<?php echo $checkout_url ?>?add-to-cart=<?php echo $product_id ?>&quantity=1" class="mm-add_to_cart"><?php _e('Buy now'); ?></a>
</div>
<div class='mm-excerpt'>
  <?php echo $post->post_excerpt; ?>
</div>
<script>
    (function ($) {
        $('body').on('click', '.mm-add_to_cart', function () {
            localStorage.setItem('mm_redirect_to', '<?php echo get_permalink($post->ID);?>');
        })
    })(jQuery)
</script>