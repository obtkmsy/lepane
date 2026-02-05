<?php

if ( !defined( 'ABSPATH' ) ) {
	exit;
}
?>

<?php get_header(); ?>

<main>
<div class="category__wrapper">
  <h1 class="category__title"><?php post_type_archive_title(); ?></h1>

  <?php if (have_posts()): ?>
      <ul class="category__list">
        <?php while (have_posts()): the_post(); ?>
          <li class="category__item">
            <a href="<?php the_permalink(); ?>" class="category__link">
              <p>
              <?php
                $event_date = function_exists('get_field') ? get_field('event_date') : '';

                if (!empty($event_date)) {
                  echo esc_html($event_date);
                } else {
                  echo '開催日未定';
                }
              ?>
              </p>
              <h2 class="category__ttl"><?php the_title(); ?></h2>
              <p class="category__text"><?php the_excerpt(); ?></p>
            </a>
          </li>
        <?php endwhile; ?>
      </ul>
      <?php get_template_part('template', 'parts/component/pager'); ?>
    <?php else: ?>
      <p>記事がありません。</p>
  <?php endif; ?>

    </div>
</main>

<?php get_footer(); ?>