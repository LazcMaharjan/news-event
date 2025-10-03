<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package News Event Pro
 */
use NewsEvent\CustomizerDefault as NEV;
$args[ 'single_page_show_original_image_option' ] = NEV\news_event_get_customizer_option( 'single_page_show_original_image_option' );
$args[ 'single_page_image_caption' ] = NEV\news_event_get_customizer_option( 'single_page_image_caption' );
get_header();
	if( is_front_page() ) :
		/**
		 * hook - news_event_main_banner_hook
		 * 
		 * hooked - news_event_main_banner_part - 10
		 */
		do_action( 'news_event_main_banner_hook' );

		$homepage_content_order = json_decode( NEV\news_event_get_customizer_option( 'homepage_content_order' ), true );
		foreach( $homepage_content_order as $content_order_key => $content_order ) :
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
										do_action( 'news_event_full_width_blocks_hook' );
									break;
					case "leftc_rights_section": 
										/**
										 * hook - news_event_leftc_rights_blocks_hook
										 * 
										 * hooked- news_event_leftc_rights_blocks_part
										 * @since 1.0.0
										 * 
										 */
										do_action( 'news_event_leftc_rights_blocks_hook' );
									break;
					case "lefts_rightc_section": 
										/**
										 * hook - news_event_lefts_rightc_blocks_hook
										 * 
										 * hooked- news_event_lefts_rightc_blocks_part
										 * @since 1.0.0
										 * 
										 */
										do_action( 'news_event_lefts_rightc_blocks_hook' );
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
					case "bottom_full_width_section": 
										/**
										 * hook - news_event_bottom_full_width_blocks_hook
										 * 
										 * hooked- news_event_bottom_full_width_blocks_part
										 * @since 1.0.0
										 * 
										 */
										do_action( 'news_event_bottom_full_width_blocks_hook' );
									break;
						default: ?>
						<div id="theme-content">
							<?php
								/**
								 * hook - news_event_before_main_content
								 * 
								 */
								do_action( 'news_event_before_main_content' );
							?>
							<main id="primary" class="site-main">
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
											?>
											<div class="post-inner-wrapper news-event-card">
												<?php
													while ( have_posts() ) :
														the_post();

														get_template_part( 'template-parts/content', 'page', $args );

														// If comments are open or we have at least one comment, load up the comment template.
														if ( comments_open() || get_comments_number() ) :
															comments_template();
														endif;

													endwhile; // End of the loop.
												?>
											</div>
										</div>
										<div class="secondary-sidebar">
											<?php get_sidebar(); ?>
										</div>
									</div>
								</div>
							</main><!-- #main -->
						</div><!-- #theme-content -->
					<?php
				}
			endif;
		endforeach;
	else :
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
								?>
								<div class="post-inner-wrapper news-event-card">
									<?php
										while ( have_posts() ) :
											the_post();

											get_template_part( 'template-parts/content', 'page', $args );

											// If comments are open or we have at least one comment, load up the comment template.
											if ( comments_open() || get_comments_number() ) :
												comments_template();
											endif;

										endwhile; // End of the loop.
									?>
								</div>
							</div>
							<div class="secondary-sidebar">
								<?php get_sidebar(); ?>
							</div>
						</div>
					</div>
				</main><!-- #main -->
			</div><!-- #theme-content -->
		<?php
	endif;
get_footer();
