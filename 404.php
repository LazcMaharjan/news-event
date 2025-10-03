<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package News Event Pro
 */
use NewsEvent\CustomizerDefault as NEV;
get_header();
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
							<section class="error-404 not-found">
								<?php
									/**
									 * hook - news_event_before_inner_content
									 * 
									 */
									do_action( 'news_event_before_inner_content' );
								?>
								<div class="post-inner-wrapper news-event-card">
									<header class="page-header">
										<h1 class="page-title news-event-block-title"><?php echo esc_html( NEV\news_event_get_customizer_option( 'error_page_page_title' ) ); ?></h1>
									</header><!-- .page-header -->

									<div class="page-content">
										<?php
											$error_page_image = NEV\news_event_get_customizer_option( 'error_page_image' );
											if( $error_page_image != 0 ) {
												echo wp_get_attachment_image( $error_page_image, 'full' );
											} 
										?>
										<p><?php echo esc_textarea( NEV\news_event_get_customizer_option( 'error_page_page_content' ) ); ?></p>
									</div><!-- .page-content -->

									<div class="page-footer">
										<a class="button-404" href="<?php echo esc_url( NEV\news_event_get_customizer_option( 'error_page_button_url' ) ); ?>"><?php echo esc_html( NEV\news_event_get_customizer_option( 'error_page_button_label' ) ); ?></a>
									</div>
								</div><!-- .post-inner-wrapper -->
							</section><!-- .error-404 -->
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
