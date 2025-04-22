<?php

/** @noinspection PhpUndefinedVariableInspection */
//Sort by last purchase date
//usort($purchased, fn($a, $b) => strcmp($a->last_purchase_date, $b->last_purchase_date));

?>
<style>
    .mm-purchased {
        padding: 1rem;
    }
    .mm-purchased .mm-purchased__list {
        display: grid;
        grid-template-columns: 1fr;
        gap: 1rem;
    }
    @media screen and (min-width: 360px) {
        .mm-purchased .mm-purchased__list {
            grid-template-columns: repeat(2, 1fr);
        }
    }
    @media screen and (min-width: 760px) {
        .mm-purchased .mm-purchased__list {
            grid-template-columns: repeat(5, 1fr);
        }
    }
    .mm-purchased .mm-purchased__list .mm-purchased__list__item {
        width: 100%;
        height: 150px;
        position: relative;
    }
    .mm-purchased .mm-purchased__list .mm-purchased__list__item .thumbnail{
        width: 100%;
        height: 100%;
        background-color: lightgrey;
        background-size: cover;
    }
    .mm-purchased .mm-purchased__list .mm-purchased__list__item .info{
        position: absolute;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: rgba(0,0,0,0.7);
    }
    .mm-purchased .mm-purchased__list .mm-purchased__list__item .info a {
        width: 85%;
        height: 100%;
        text-align: center;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
    }
</style>
<div class="mm-purchased">
    <?php if (count($purchased) > 0):
        $language = apply_filters('wpml_current_language', null);
        $posts = array_values(array_filter($purchased, function (WP_Post $item) use ($language) {
            $lang_info = apply_filters('wpml_post_language_details', null, $item->ID);
            return get_post_type($item->ID) === 'post' &&
                (array_key_exists('language_code', $lang_info) && $language === $lang_info['language_code']);
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