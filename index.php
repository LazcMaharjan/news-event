<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package News Event Pro
 */
use NewsEvent\CustomizerDefault as NEV;
get_header();
/**
 * hook - news_event_main_banner_hook
 * 
 * hooked - news_event_main_banner_part - 10
 */
if( is_home() && is_front_page() ) do_action( 'news_event_main_banner_hook' );

$homepage_content_order = json_decode( NEV\news_event_get_customizer_option( 'homepage_content_order' ), true );
foreach( $homepage_content_order as $content_order_key => $content_order ) :
	if( $content_order_key == 'latest_posts' && is_home() && ! is_front_page()  ) $content_order = true;
	if( $content_order ) :
		switch( $content_order_key ) {
			case "full_width_section": 
								/**
								 * hook - news_event_full_width_blocks_hook
								 * 
								 * hooked- news_event_full_width_blocks_part
								 * @since 1.0.0
								 * 
								 */
								if( is_home() && is_front_page() ) do_action( 'news_event_full_width_blocks_hook' );
							break;
			case "leftc_rights_section": 
								/**
								 * hook - news_event_leftc_rights_blocks_hook
								 * 
								 * hooked- news_event_leftc_rights_blocks_part
								 * @since 1.0.0
								 * 
								 */
								if( is_home() && is_front_page() ) do_action( 'news_event_leftc_rights_blocks_hook' );
							break;
			case "lefts_rightc_section": 
								/**
								 * hook - news_event_lefts_rightc_blocks_hook
								 * 
								 * hooked- news_event_lefts_rightc_blocks_part
								 * @since 1.0.0
								 * 
								 */
								if( is_home() && is_front_page() ) do_action( 'news_event_lefts_rightc_blocks_hook' );
							break;
			case "video_playlist": 
								/**
								 * function - news_event_video_playlist_part
								 * 
								 * @since 1.0.0
								 * 
								 */
								if( is_home() && is_front_page() ) news_event_video_playlist_part();
							break;
			case "bottom_full_width_section": 
								/**
								 * hook - news_event_bottom_full_width_blocks_hook
								 * 
								 * hooked- news_event_bottom_full_width_blocks_part
								 * @since 1.0.0
								 * 
								 */
								if( is_home() && is_front_page() ) do_action( 'news_event_bottom_full_width_blocks_hook' );
							break;
			case "three_column_section": 
								/**
								 * hook - news_event_three_column_section_hook
								 * 
								 * hooked- news_event_three_column_section_columns_part
								 * @since 1.0.0
								 * 
								 */
								if( is_home() && is_front_page() ) do_action( 'news_event_three_column_section_hook' );
							break;
			case "two_column_section": 
								/**
								 * hook - news_event_two_column_section_hook
								 * 
								 * hooked- news_event_two_column_section_columns_part
								 * @since 1.0.0
								 * 
								 */
								if( is_home() && is_front_page() ) do_action( 'news_event_two_column_section_hook' );
							break;
			default: ?>
					<div id="theme-content">
						<main id="primary" class="site-main <?php echo esc_attr( 'width-' . news_event_get_section_width_layout_val() ); ?>">
							<div class="news-event-container">
                    			<div class="row">
									<div class="secondary-left-sidebar">
										<?php get_sidebar('left'); ?>
									</div>
                    				<div class="primary-content">
										<?php
											if ( have_posts() ) :
												$args['archive_post_element_order'] = json_decode( NEV\news_event_get_customizer_option( 'archive_post_element_order' ), true );
												$newListWrapClass = 'news-list-wrap ' . implode( '-', array_keys( $args['archive_post_element_order'] ) );
												if ( is_home() && ! is_front_page() ) :
													?>
													<header>
														<h1 class="page-title news-event-block-title screen-reader-text"><?php single_post_title(); ?></h1>
													</header>
													<?php
												endif;
												$args['archive_post_meta_order'] = json_decode( NEV\news_event_get_customizer_option( 'archive_post_meta_order' ), true );
												$args['archive_page_category_option'] = NEV\news_event_get_customizer_option( 'archive_page_category_option' );
												$args['archive_image_size'] = NEV\news_event_get_customizer_option( 'archive_image_size' );
												$args['website_read_time_before_icon'] = NEV\news_event_get_customizer_option( 'website_read_time_before_icon' );
												add_filter( 'excerpt_length', 'news_event_archive_excerpt_length', 999 );
												echo '<div class="', esc_attr( $newListWrapClass ) ,'">';
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
												echo '</div>';
												/**
												 * hook - news_event_pagination_link_hook
												 * 
												 * @package News Event Pro
												 * @since 1.0.0
												 */
												do_action( 'news_event_pagination_link_hook' );
												remove_filter( 'excerpt_length', 'news_event_archive_excerpt_length', 999 );
											else :
												get_template_part( 'template-parts/content', 'none' );
											endif;
										?>
									</div>
									<div class="secondary-sidebar">
										<?php
											get_sidebar();
										?>
									</div>
								</div>
							</div> <!-- news-event-container end -->
						</main><!-- #main -->
					</div><!-- #theme-content -->
			<?php
		}
	endif;
endforeach;
get_footer();