<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package News Event Pro
 */
use NewsEvent\CustomizerDefault as NEV;
get_header();
$args['archive_post_element_order'] = json_decode( NEV\news_event_get_customizer_option( 'archive_post_element_order' ), true );
$newListWrapClass = 'post-inner-wrapper news-list-wrap ' . implode( '-', array_keys( $args['archive_post_element_order'] ) );
	?>
		<div id="theme-content">
			<?php
				/**
				 * hook - news_event_before_main_content
				 * 
				 */
				do_action( 'news_event_before_main_content' );
			?>
			<main id="primary" class="site-main <?php echo esc_attr( 'width-' . news_event_get_section_width_layout_val() ); ?>">
				<div class="news-event-container">
					<div class="row">
					<div class="secondary-left-sidebar">
							<?php
								get_sidebar('left');
							?>
						</div>
						<div class="primary-content">
							<?php
								/**
								 * hook - news_event_before_inner_content
								 * 
								 */
								do_action( 'news_event_before_inner_content' );
								
								if ( have_posts() ) : ?>
								<header class="page-header">
									<?php
										if( ! is_author() ) :
											the_archive_title( '<h1 class="page-title news-event-block-title">', '</h1>' );
											the_archive_description( '<div class="archive-description">', '</div>' );
										endif;
									?>
								</header><!-- .page-header -->
								<div class="<?php echo esc_attr( $newListWrapClass ); ?>">
									<?php
										
										$args['archive_post_meta_order'] = json_decode( NEV\news_event_get_customizer_option( 'archive_post_meta_order' ), true );
										$args['archive_page_category_option'] = NEV\news_event_get_customizer_option( 'archive_page_category_option' );
										$args['archive_image_size'] = NEV\news_event_get_customizer_option( 'archive_image_size' );
										$args['website_read_time_before_icon'] = NEV\news_event_get_customizer_option( 'website_read_time_before_icon' );
										add_filter( 'excerpt_length', 'news_event_archive_excerpt_length', 999 );
											/* Start the Loop */
											while ( have_posts() ) :
												the_post();
												/*
												* Include the Post-Type-specific template for the content.
												* If you want to override this in a child theme, then include a file
												* called content-___.php (where ___ is the Post Type name) and that will be used instead.
												*/
												get_template_part( 'template-parts/content', get_post_type(), $args );
											endwhile;
										remove_filter( 'excerpt_length', 'news_event_archive_excerpt_length', 999 );
									else :
										get_template_part( 'template-parts/content', 'none' );
									endif;
									?>
								</div>
								<?php
									if( have_posts() ) :
										/**
										 * hook - news_event_pagination_link_hook
										 * 
										 * @package News Event Pro
										 * @since 1.0.0
										 */
										do_action( 'news_event_pagination_link_hook' );
									endif;
								?>
						</div>
						<div class="secondary-sidebar">
							<?php
								get_sidebar();
							?>
						</div>
					</div>
				</div>
			</main><!-- #main -->
		</div><!-- #theme-content -->
	<?php
get_footer();
