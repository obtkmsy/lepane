<?php
add_filter('render_block', function ($block_content, $block) {

	static $inserted = false;
	if ($inserted) {
		return $block_content;
	}

	$attrs = $block['attrs'] ?? [];
	$class = $attrs['className'] ?? '';

	if (strpos($class, 'front-column__main') === false) {
		return $block_content;
	}

	$acf_scope = 0;
	if (is_front_page()) {
		$acf_scope = (int) get_option('page_on_front');
	} else {
		$acf_scope = (int) get_queried_object_id();
	}
	if ($acf_scope === 0) {
		$acf_scope = 'option';
	}

	if (!function_exists('have_rows')) {
		return $block_content;
	}

	$has_archive = have_rows('archive-list', $acf_scope);
	$has_banner  = have_rows('side-banner',  $acf_scope);
	$has_text  = have_rows('text-link',  $acf_scope);

	if (!$has_archive && !$has_banner && !$has_text) {
		return $block_content;
	}

	ob_start();
	?>
	<div class="front-column__sub">

		<?php if ($has_archive): ?>
			<div class="archive-list">
				<?php while (have_rows('archive-list', $acf_scope)): the_row(); ?>
					<?php $date = get_sub_field('archive-list__date'); ?>

					<div class="archive-list__group">
						<?php if (!empty($date)): ?>
							<div class="archive-list__date"><?php echo esc_html($date); ?></div>
						<?php endif; ?>

						<?php if (have_rows('archive-list__item')): ?>
							<div class="archive-list__items">
								<?php while (have_rows('archive-list__item')): the_row(); ?>
									<?php
									$title  = get_sub_field('archive-list__title');
									$link   = get_sub_field('archive-list__url');
									$url    = is_array($link) ? ($link['url'] ?? '') : (string) $link;
									$target = is_array($link) ? ($link['target'] ?? '') : '';
									?>

									<?php if (!empty($url)): ?>
										<a class="archive-list__item" href="<?php echo esc_url($url); ?>"<?php echo $target ? ' target="' . esc_attr($target) . '" rel="noopener"' : ''; ?>>
											<?php if (!empty($title)): ?>
												<span class="archive-list__title"><?php echo esc_html($title); ?></span>
											<?php endif; ?>
										</a>
									<?php elseif (!empty($title)): ?>
										<div class="archive-list__item">
											<span class="archive-list__title"><?php echo esc_html($title); ?></span>
										</div>
									<?php endif; ?>
								<?php endwhile; ?>
							</div>
						<?php endif; ?>
					</div>
				<?php endwhile; ?>
			</div>
		<?php endif; ?>

		<?php if ($has_banner): ?>
			<div class="side-banner">
				<?php while (have_rows('side-banner', $acf_scope)): the_row(); ?>
					<?php
					$img    = get_sub_field('side-banner__img');
					$link   = get_sub_field('side-banner__url');
					$text   = get_sub_field('side-banner__text');
					$url    = is_array($link) ? ($link['url'] ?? '') : (string) $link;
					$target = is_array($link) ? ($link['target'] ?? '') : '';

					$img_html = '';
					if (is_array($img) && !empty($img['ID'])) {
						$img_html = wp_get_attachment_image((int) $img['ID'], 'full');
					} elseif (is_numeric($img)) {
						$img_html = wp_get_attachment_image((int) $img, 'full');
					} elseif (is_string($img) && $img !== '') {
						$img_html = '<img src="' . esc_url($img) . '" alt="">';
					}
					?>

					<?php if (!empty($url)): ?>
						<a class="side-banner__item" href="<?php echo esc_url($url); ?>"<?php echo $target ? ' target="' . esc_attr($target) . '" rel="noopener"' : ''; ?>>
							<?php echo $img_html; ?>
							<?php if (!empty($text)): ?>
								<p class="side-banner__text"><?php echo esc_html($text); ?></p>
							<?php endif; ?>
						</a>
					<?php elseif ($img_html || $text): ?>
						<div class="side-banner__item">
							<?php echo $img_html; ?>
							<?php if (!empty($text)): ?>
								<p class="side-banner__text"><?php echo esc_html($text); ?></p>
							<?php endif; ?>
						</div>
					<?php endif; ?>
				<?php endwhile; ?>
			</div>
		<?php endif; ?>


	</div>
	<?php
	$sub_html = ob_get_clean();

	$inserted = true;

	return $block_content . $sub_html;

}, 10, 2);
