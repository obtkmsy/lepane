<?php
/**
 * パンくずの取得関数
 *
 * @type string  $container          パンくずリスト囲むタグを指定。デフォルトは 'div' 。
 * @type string  $container_class    パンくずリストを囲むタグの class を指定。デフォルトは 'breadcrumb-section' 。
 * @type string  $container_id       パンくずリストを囲むタグの id を指定。デフォルトは無し。
 * @type string  $crumb_tag          パンくずリスト自体のタグを指定。デフォルトは 'ul' で、他に指定できるのは 'ol' のみ。
 * @type string  $crumb_class        パンくずリスト自体のタグに class を指定。デフォルトは 'crumb-list' 。
 * @type string  $crumb_id           パンくずリスト自体のタグに id を指定。デフォルトは無し。
 * @type bool    $echo               パンくずリストのHTMLを変数に格納する場合は 'false' を指定。デフォルトは 'true' なので直接出力する。
 * @type string  $home_class         パンくずリストのホームの階層を示すタグに class を指定。デフォルトは 'crumb-home' 。
 * @type string  $home_text          パンくずリストのホームの階層を示すタグのテキストを指定。デフォルトは 'ホーム' 。
 * @type string  $delimiter          パンくずリストの区切り文字を指定。デフォルトは '<li>&nbsp;&gt;&nbsp;</li>' 。
 * @type string  $crumb_microdata    パンくずリストタグ [ 'ul' または 'ol' ] に指定するリッチスニペット。デフォルトは ' itemprop="breadcrumb"' 。
 * @type string  $li_microdata       パンくずリストのliタグに指定するリッチスニペット。デフォルトは ' itemscope itemtype="http://data-vocabulary.org/Breadcrumb"' 。
 * @type string  $url_microdata      パンくずリストのaタグに指定するリッチスニペット。デフォルトは ' itemprop="url"' 。
 * @type string  $title_microdata    パンくずリストのspanタグに指定するリッチスニペット。デフォルトは ' itemprop="title"' 。
 */

if ( !defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'custom_breadcrumb' ) ) {
	function custom_breadcrumb( $args = array() ) {
		$defaults = array(
			'container'         => 'div',
			'container_class'   => 'breadcrumb',
			'container_id'      => '',
			'crumb_tag'         => 'ul',
			'crumb_class'       => 'breadcrumb-lists',
			'crumb_id'          => '',
			'echo'              => true,
			'home_class'        => 'is-home',
			'home_text'         => 'ホーム',
			'delimiter'         => '',
			'crumb_microdata'   => ' itemscope itemtype="http://schema.org/BreadcrumbList"',
			'li_microdata'      => ' itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"',
			'url_microdata'     => ' itemprop="item"',
			'title_microdata'   => ' itemprop="name"'
		);

		$args = wp_parse_args( $args, $defaults );
		$args = (object) $args;
		$breadcrumb_html      = '';

		//region Rich Snippets (microdata) Setting
		$crumb_microdata    = $args->crumb_microdata ? $args->crumb_microdata : '';
		$li_microdata       = $args->li_microdata ? $args->li_microdata : '';
		$url_microdata      = $args->url_microdata ? $args->url_microdata : '';
		$title_microdata    = $args->title_microdata ? $args->title_microdata : '';
		//endregion

		//region Nested Function
		/**
		 * 現在のページのパンくずリスト用タグ
		 *
		 * @param $current_permalink : current crumb permalink
		 * @param string $current_text : current crumb text
		 * @param string $current_class : class name
		 * @param array $args : microdata settings
		 *
		 * @return string
		 */
		/*
		 * Nest Function [current_crumb_tag()] Argument
		 */
		$current_microdata = array(
			'li_microdata'      => $li_microdata,
			'url_microdata'     => $url_microdata,
			'title_microdata'   => $title_microdata
		);

		if ( ! function_exists( 'current_crumb_tag' ) ) {
			function current_crumb_tag( $current_permalink, $current_text = '', $args = array(), $current_class = 'current-crumb' ) {
				$defaults = array(
					'li_microdata'      => ' itemscope="itemscope" itemtype="http://data-vocabulary.org/Breadcrumb"',
					'url_microdata'     => ' itemprop="url"',
					'title_microdata'   => ' itemprop="title"'
				);
				$args = wp_parse_args( $args, $defaults );
				$args = (object) $args;
				$current_class      = $current_class ? ' class="' . esc_attr( $current_class ) . '"' : '';
				$start_anchor_tag   = $current_permalink ? '<a href="' . $current_permalink . '"' . $args->url_microdata . '>' : '<span class="crumb-no-link">';
				$end_anchor_tag     = $current_permalink ? '</a>' : '</span>';
				$current_before     = '<li' . $current_class . $args->li_microdata . '>' . $start_anchor_tag . '<span' . $args->title_microdata . '><strong>';
				$current_crumb_tag  = $current_text;
				$current_after      = '</strong></span>' . $end_anchor_tag . '</li>';
				if ( get_query_var( 'paged' ) ) {
					if ( is_paged() || is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) {
						$current_after = ' (' . get_query_var( 'paged' ) . 'ページ目)' . $current_after;
					}

				} elseif ( ( is_page() || is_single() ) && get_query_var( 'page' ) ) {
					$current_after = ' (' . get_query_var( 'page' ) . 'ページ目)' . $current_after;
				}

				return $current_before . $current_crumb_tag . $current_after;
			}
		}
		//endregion

		if (
			( ! is_home() && ! is_front_page() )
			|| ( is_home() && ! is_front_page() )
			|| is_paged()
		) {
			// Breadcrumb Container Start Tag
			if ( $args->container ) {
				$class = $args->container_class ? ' class="' . esc_attr( $args->container_class ) . '"' : ' class="' . $defaults['container_class'] . '"';
				$id = $args->container_id ? ' id="' . esc_attr( $args->container_id ) . '"' : '';
				$breadcrumb_html .= '<'. $args->container . $id . $class . '>';
			}

			// Breadcrumb Start Tag
			if ( $args->crumb_tag ) {
				$crumb_tag_allowed_tags = apply_filters( 'crumb_tag_allowed_tags', array( 'ul', 'ol' ) );
				if ( in_array( $args->crumb_tag, $crumb_tag_allowed_tags ) ) {
					$id = $args->crumb_id ? ' id="' . esc_attr( $args->crumb_id ) . '"' : '';
					$class = $args->crumb_class ? ' class="' . esc_attr( $args->crumb_class ) . '"' : '';
					$breadcrumb_html .= '<' . $args->crumb_tag . $id . $class . $crumb_microdata . '>';
				}

			} else {
				$breadcrumb_html .= '<' . $defaults['crumb_tag'] .  $crumb_microdata . '>';
			}

			global $post;

			// Home Crumb Item
			$home_class = $args->home_class ? ' class="'. esc_attr( $args->home_class ) . '"' : '';

			$breadcrumb_html .= '<li'. $home_class . $li_microdata . '><a href="' . home_url() . '"' . $url_microdata . '><span ' . $title_microdata . '>' . $args->home_text . '</span></a></li>' . $args->delimiter;

			if ( is_home() && ! is_front_page() ) {
				$home_ID = get_option('page_for_posts');
				$breadcrumb_html .= current_crumb_tag( get_the_permalink( $home_ID ), get_the_title( $home_ID ), $current_microdata );

			} else if ( is_paged() ) {
				if ( 'post' == get_post_type() ) {
					$breadcrumb_html .= current_crumb_tag( get_pagenum_link( get_query_var( 'paged' ) ), '投稿一覧', $current_microdata );

				} elseif ( 'page' == get_post_type() ) {
					$breadcrumb_html .= current_crumb_tag( get_pagenum_link( get_query_var( 'paged' ) ), get_the_title(), $current_microdata );
				}

			} elseif ( is_category() ) {
				$cat = get_queried_object();

				if ( $cat->parent != 0 ) {
					$ancestors = array_reverse( get_ancestors( $cat->cat_ID, 'category' ) );
					foreach ( $ancestors as $ancestor ) {
						$breadcrumb_html .= '<li' . $li_microdata . '><a href="' . get_category_link( $ancestor ) . '"' . $url_microdata . '><span' . $title_microdata . '>' . get_cat_name( $ancestor ) . '</span></a></li>' . $args->delimiter;
					}
				}

				$breadcrumb_html .= current_crumb_tag( get_category_link( $cat->term_id ), single_cat_title( '', false ), $current_microdata );

			} elseif ( is_day() ) {
				$breadcrumb_html .= '<li' . $li_microdata . '><a href="' . get_year_link( get_the_time( 'Y' ) ) . '"' . $url_microdata . '><span' . $title_microdata . '>' . get_the_time( 'Y' ) . '年</span></a></li>' . $args->delimiter;
				$breadcrumb_html .= '<li' . $li_microdata . '><a href="' . get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) ) . '"' . $url_microdata . '><span' . $title_microdata . '>' . get_the_time( 'F' ) . '</span></a></li>' . $args->delimiter;
				$breadcrumb_html .= current_crumb_tag( get_day_link( get_the_time( 'Y' ), get_the_time( 'm' ), get_the_time( 'd' ) ), get_the_time( 'd' ) . '日', $current_microdata );

			} elseif ( is_month() ) {
				$breadcrumb_html .= '<li' . $li_microdata . '><a href="' . get_year_link( get_the_time( 'Y' ) ) . '"' . $url_microdata . '><span' . $title_microdata . '>' . get_the_time( 'Y' ) . '年</span></a></li>' . $args->delimiter;
				$breadcrumb_html .= current_crumb_tag( get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) ), get_the_time( 'F' ), $current_microdata );

			} elseif ( is_year() ) {
				$breadcrumb_html .= current_crumb_tag( get_year_link( get_the_time( 'Y' ) ), get_the_time( 'Y' ) . '年', $current_microdata );

			} elseif ( is_single() && ! is_attachment() ) {
				$single = get_queried_object();

				if ( get_post_type() == 'post' ) {
					if ( get_option( 'page_for_posts' ) ) {
						$breadcrumb_html .= '<li' . $li_microdata . '><a href="' . get_page_link( get_option( 'page_for_posts' ) ) . '"' . $url_microdata . '><span' . $title_microdata . '>' . get_the_title( get_option( 'page_for_posts' ) ) . '</span></a></li>' . $args->delimiter;
					}

					$categories = get_the_category( $post->ID );
					$cat        = $categories[0];

					if ( $cat->parent != 0 ) {
						$ancestors = array_reverse( get_ancestors( $cat->cat_ID, 'category' ) );
						foreach ( $ancestors as $ancestor ) {
							$breadcrumb_html .= '<li' . $li_microdata . '><a href="' . get_category_link( $ancestor ) . '"' . $url_microdata . '><span' . $title_microdata . '>' . get_cat_name( $ancestor ) . '</span></a></li>' . $args->delimiter;
						}
					}

					$breadcrumb_html .= '<li' . $li_microdata . '><a href="' . get_category_link( $cat->cat_ID ) . '"' . $url_microdata . '><span' . $title_microdata . '>' . get_cat_name( $cat->cat_ID ) . '</span></a></li>' . $args->delimiter;
					$breadcrumb_html .= current_crumb_tag( get_the_permalink( $single->ID ), get_the_title( $single->ID ), $current_microdata );

				} else {

					$post_type_object = get_post_type_object( get_post_type() );

					if ( custom_post_array() ) {
						if ( is_singular( custom_post_array() ) ) {
							$id = get_page_id();
						}
					}
					$page_title_sub  = get_field('page_title_sub', $id);
					if ( $page_title_sub ) {
						$title = $page_title_sub;
					} else {
						$title = $post_type_object->label;
					}

					$breadcrumb_html .= '<li' . $li_microdata . '><a href="' . get_post_type_archive_link( get_post_type() ) . '"' . $url_microdata . '><span' . $title_microdata . '>' . $title . '</span></a></li>' . $args->delimiter;
					$taxonomies =  get_object_taxonomies( get_post_type() );
					$category_term = '';

					foreach ( $taxonomies as $taxonomy ) {
						$taxonomy_obj = get_taxonomy( $taxonomy );
						if ( true == $taxonomy_obj->hierarchical ) {
							$category_term = $taxonomy_obj;
							break;
						}
					}

					if ( $category_term ) {
						$terms = get_the_terms( $post->ID, $category_term->name );

						if ( $terms ) {
							if ( ! $terms || is_wp_error( $terms ) )
								$terms = array();

							$terms = array_values( $terms );
							$term = $terms[0];

							if ( $term->parent != 0 ) {
								$ancestors = array_reverse( get_ancestors( $term->term_id, $term->taxonomy ) );
								foreach ( $ancestors as $ancestor ) {
									$breadcrumb_html .= '<li' . $li_microdata . '><a href="' . get_term_link( $ancestor, $term->taxonomy ) . '"' . $url_microdata . '><span' . $title_microdata . '>' . get_term( $ancestor, $term->taxonomy )->name . '</span></a></li>' . $args->delimiter;
								}
							}

							$breadcrumb_html .= '<li' . $li_microdata . '><a href="' . get_term_link( $term, $term->taxonomy ) . '"' . $url_microdata . '><span' . $title_microdata . '>' . $term->name . '</span></a></li>' . $args->delimiter;
						}
					}

					$breadcrumb_html .= current_crumb_tag( get_the_permalink( $single->ID ), get_the_title( $single->ID ), $current_microdata );
				}

			} elseif ( is_attachment() ) {
				$attachment = get_queried_object();

				if ( ! empty( $post->post_parent ) ) {
					$breadcrumb_html .= '<li' . $li_microdata . '><a href="' . get_permalink( $post->post_parent ) . '"' . $url_microdata . '><span' . $title_microdata . '>' . get_the_title( $post->post_parent ) . '</span></a></li>' . $args->delimiter;
				}

				$breadcrumb_html .= current_crumb_tag( get_the_permalink( $attachment->ID ), get_the_title( $attachment->ID ), $current_microdata );

			} elseif ( is_page() ) {
				$page = get_queried_object();

				if ( $post->post_parent ) {
					$ancestors = array_reverse( get_post_ancestors( $post->ID ) );
					foreach ( $ancestors as $ancestor ) {
						$breadcrumb_html .= '<li' . $li_microdata . '><a href="' . get_permalink( $ancestor ) . '"' . $url_microdata . '><span' . $title_microdata . '>' . get_the_title( $ancestor ) . '</span></a></li>' . $args->delimiter;
					}
				}

				$breadcrumb_html .= current_crumb_tag( get_the_permalink( $page->ID ), get_the_title( $page->ID ), $current_microdata );

			} elseif ( is_search() ) {
				$breadcrumb_html .= current_crumb_tag( get_search_link(), 'Search Results for "' . get_search_query() . '"', $current_microdata );

			} elseif ( is_tag() ) {
				$tag = get_queried_object();
				$breadcrumb_html .= current_crumb_tag( get_term_link( $tag->term_id, $tag->taxonomy ), single_tag_title( '', false ), $current_microdata );

			} elseif ( is_tax() ) {
				$taxonomy_name  = get_query_var( 'taxonomy' );
				$post_types = get_taxonomy( $taxonomy_name )->object_type;
				$breadcrumb_html .= '<li' . $li_microdata . '><a href="' . get_post_type_archive_link( $post_types[0] ) . '"' . $url_microdata . '><span' . $title_microdata . '>' . get_post_type_object( $post_types[0] )->label . '</span></a></li>' . $args->delimiter;
				$tax = get_queried_object();

				if ( $tax->parent != 0 ) {
					$ancestors = array_reverse( get_ancestors( $tax->term_id, $tax->taxonomy ) );
					foreach ( $ancestors as $ancestor ) {
						$breadcrumb_html .= '<li' . $li_microdata . '><a href="' . get_term_link( $ancestor, $tax->taxonomy ) . '"' . $url_microdata . '><span' . $title_microdata . '>' . get_term( $ancestor, $tax->taxonomy )->name . '</span></a></li>' . $args->delimiter;
					}
				}

				$breadcrumb_html .= current_crumb_tag( get_term_link( $tax->term_id, $tax->taxonomy ), single_tag_title( '', false ), $current_microdata );

			} elseif ( is_author() ) {
				$author = get_queried_object();
				$author_name = get_field('author_name', 'user_' . $author->ID);
				$page_title = $author_name . 'の記事一覧';
				$breadcrumb_html .= current_crumb_tag( get_author_posts_url( $author->ID ), $page_title, $current_microdata );

			} elseif ( is_404() ) {
				$breadcrumb_html .= current_crumb_tag( null, '404 Not found' );

			} elseif ( is_post_type_archive( get_post_type() ) ) {
				// カスタム投稿アーカイブ
				if ( false == get_post_type() ) {
					$post_type_obj = get_queried_object();
					$id = get_page_id();
					$page_title_sub  = get_field('page_title_sub', $id);
					if ( $page_title_sub ) {
						$title = $page_title_sub;
					} else {
						$title = $post_type_obj->label;
					}
					$breadcrumb_html .= current_crumb_tag( $post_type_obj->name, $title, $current_microdata );
				} else {
					$post_type_obj = get_post_type_object( get_post_type() );
					$id = get_page_id();
					$page_title_sub  = get_field('page_title_sub', $id);
					if ( $page_title_sub ) {
						$title = $page_title_sub;
					} else {
						$title = $post_type_obj->label;
					}

					$breadcrumb_html .= current_crumb_tag( get_post_type_archive_link( get_post_type() ), $title, $current_microdata );
				}

			} else {
				$breadcrumb_html .= current_crumb_tag( site_url(), wp_title( '', false ), $current_microdata );
			}
			// Breadcrumb End Tag
			if ( $args->crumb_tag ) {
				$crumb_tag_allowed_tags = apply_filters( 'crumb_tag_allowed_tags', array( 'ul', 'ol' ) );

				if ( in_array( $args->crumb_tag, $crumb_tag_allowed_tags ) ) {
					$breadcrumb_html .= '</' . $args->crumb_tag . '>';
				}

			} else {
				$breadcrumb_html .= '</' . $defaults['crumb_tag'] . '>';
			}

			// Breadcrumb Container End Tag
			if ( $args->container ) {
				$breadcrumb_html .= '</' . $args->container . '>';
			}


			// insert shema.org position
			$num = 1;
			$breadcrumb_html = preg_replace_callback (
				'/<\/a>/',
				function($matches) use(&$num) {
					return $matches[0] . '<meta itemprop="position" content="' . $num++ . '">';
				},
				$breadcrumb_html
			);

			if ( $args->echo ) {
				echo $breadcrumb_html;

			} else {
				return $breadcrumb_html;
			}
		}
	}
}
