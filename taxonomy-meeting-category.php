<?php

if ( !defined( 'ABSPATH' ) ) {
	exit;
}
?>

<?php get_header(); ?>

<main>
  <h1><?php single_term_title(); ?></h1>
  <?php if (have_posts()): ?>
    <ul>
      <?php while (have_posts()): the_post(); ?>
        <li>
          <a href="<?php the_permalink(); ?>">
            <p>
            <?php echo get_the_date('Y年n月j日（D）');?>
            </p>
            <h2><?php the_title(); ?></h2>
            <p><?php the_excerpt(); ?></p>
          </a>
        </li>
      <?php endwhile; ?>
    </ul>

    <?php the_posts_pagination(); ?>
  <?php else: ?>
    <p>記事がありません。</p>
  <?php endif; ?>
</main>

<?php get_footer(); ?>