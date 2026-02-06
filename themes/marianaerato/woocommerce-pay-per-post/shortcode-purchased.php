<?php

/** @noinspection PhpUndefinedVariableInspection */
//Sort by last purchase date
//usort($purchased, fn($a, $b) => strcmp($a->last_purchase_date, $b->last_purchase_date));

?>
<div class="mm-purchased">
    <?php if (count($purchased) > 0):
        $language = apply_filters('wpml_current_language', null);
        $posts = array_values(array_filter($purchased, function (WP_Post $item) use ($language) {
            $lang_info = apply_filters('wpml_post_language_details', null, $item->ID);
            return get_post_type($item->ID) === 'post' &&
                (array_key_exists('language_code', $lang_info ?? array()) && $language === $lang_info['language_code']);
        }));
        unset($item);
        ?>
      <h3><?php _e('Purchased Content');?></h3>
      <div class='mm-purchased__list'>
          <?php foreach ($posts as $post):
              $permalink = get_permalink($post->ID); ?>
                <div class='mm-purchased__list__item <?php echo get_post_type($post->ID);?>'>
                    <?php $post_thumbnail = get_the_post_thumbnail_url($post->ID);?>
                  <div class='thumbnail' style='background-image: url(<?php echo $post_thumbnail?>);'>
                  </div>
                  <div class='info'>
                    <a href="<?php echo $permalink; ?>">
                        <?php echo esc_html($post->post_title); ?>
                    </a>
                  </div>
                </div>
              <?php
          endforeach; ?>
      </div>
    <?php else: ?>
      <p><?php
          /** @noinspection PhpVoidFunctionResultUsedInspection */
          apply_filters(
              'wc_pay_per_post_shortcode_purchased_no_posts',
              _e('You have not purchased any protected posts.', 'wc_pay_per_post'),
          );
        ?></p>
    <?php
    endif;
?>
</div>