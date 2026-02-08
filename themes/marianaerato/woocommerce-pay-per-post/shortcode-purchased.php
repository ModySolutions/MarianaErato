<?php

/** @noinspection PhpUndefinedVariableInspection */
//Sort by last purchase date
//usort($purchased, fn($a, $b) => strcmp($a->last_purchase_date, $b->last_purchase_date));


// Purchased
use Elementor\Core\Files\CSS\Post;
use Elementor\Plugin;

$private_gallery_post_tag = get_field('private_gallery_post_tag', 'option');
$bts_post_tag = get_field('bts_post_tag', 'option');
$field_purchased_page = get_field('field_purchased_page', 'option', false);
$field_exclusive_content_page = get_field('field_exclusive_content_page', 'option', false);
?>
<div class="mm-purchased">
    <?php
    if (count($purchased) > 0):
        $page_id = get_the_ID();
        $posts = array_filter($purchased, function ($post) use ($private_gallery_post_tag, $bts_post_tag, $page_id,
            $field_purchased_page, $field_exclusive_content_page) {
            $id = (is_int($post)) ? $post : $post->ID;
            if($page_id === (int)$field_purchased_page) {
                if ( has_term($private_gallery_post_tag, 'post_tag', $id) ||
                    has_term($bts_post_tag, 'post_tag', $id) ) {
                    return false;
                }
            } else if($page_id === (int)$field_exclusive_content_page) {
              return false;
//                if ( !has_term($private_gallery_post_tag, 'post_tag', $id) &&
//                    !has_term($bts_post_tag, 'post_tag', $id) ) {
//                    return false;
//                }
            }
            return true;
        });
      $classname = $posts ? 'mm-purchased__list' : ''; ?>
      <h3><?php
          _e('Purchased Exclusive Content'); ?></h3>
      <div class='<?php echo $classname;?>'>
          <?php
          if ($posts):
              foreach ($posts as $post):
                  $permalink = get_permalink($post->ID); ?>
                <div class='mm-purchased__list__item <?php
                echo get_post_type($post->ID); ?>'>
                    <?php
                    $post_thumbnail = get_the_post_thumbnail_url($post->ID); ?>
                  <div class='thumbnail' style='background-image: url(<?php
                  echo $post_thumbnail ?>);'>
                  </div>
                  <div class='info'>
                    <a href="<?php
                    echo $permalink; ?>">
                        <?php
                        echo esc_html($post->post_title); ?>
                    </a>
                  </div>
                </div>
              <?php
              endforeach;
          else:
              $product_template = get_field('pay_per_post_product_template', 'option');
              if ($product_template) {
                  echo do_shortcode('[elementor-template id="' . $product_template . '"]');
              }?>
          <?php endif; ?>
      </div>
    <?php
    else:
        $pay_per_post_product_template = get_field('pay_per_post_product_template', 'option', false);
        echo Plugin::instance()->frontend->get_builder_content_for_display($template_id, true); ?>
    <?php
    endif;
    ?>
</div>