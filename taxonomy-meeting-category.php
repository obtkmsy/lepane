<?php

if ( !defined( 'ABSPATH' ) ) {
	exit;
}
?>

<?php get_header(); ?>

<main>
  <h1><?php post_type_archive_title(); ?></h1>

  <?php if (have_posts()): ?>
    <ul>
      <?php while (have_posts()): the_post(); ?>
        <li>
          <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </li>
      <?php endwhile; ?>
    </ul>

    <?php the_posts_pagination(); ?>
  <?php else: ?>
    <p>記事がありません。</p>
  <?php endif; ?>
</main>

<?php get_footer(); ?>