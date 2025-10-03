<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package News Event Pro
 */
use NewsEvent\CustomizerDefault as NEV;
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> <?php news_event_schema_body_attributes(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'news-event-pro' ); ?></a>
	<div class="news_event_ovelay_div"></div>
	<?php
		/**
		 * hook - news_event_page_prepend_hook
		 * 
		 * @package News Event Pro
		 * @since 1.0.0
		 */
		do_action( "news_event_page_prepend_hook" );

		/**
		 * Function - news_event_get_header_instagram
		 * 
		 * @since 1.0.0
		 */
		news_event_get_header_instagram();

		$headerClass = 'site-header layout--default';
		$headerClass .= ' layout--' . NEV\news_event_get_customizer_option('header_layout');
		if( ! NEV\news_event_get_customizer_option('header_bottom_box_shadow') ) $headerClass .= ' with-no-bottom-box-shadow';
	?>
	
	<header id="masthead" class="<?php echo esc_attr( $headerClass ); ?>">
		<?php
			/**
			 * Function - news_event_top_header_html
			 * 
			 * @since 1.0.0
			 * 
			 */
			news_event_top_header_html();

			/**
			 * Function - news_event_header_html
			 * 
			 * @since 1.0.0
			 * 
			 */
			news_event_header_html();
		?>
	</header><!-- #masthead -->
	
	<?php

	if( is_single() ) news_event_breadcrumb_html();
	/**
	 * function - news_event_after_header_html
	 * 
	 * @since 1.0.0
	 */
	news_event_after_header_html();