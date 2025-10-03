<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package News Event Pro
 */

 /**
  * hook - news_event_before_footer_section
  * 
  */
  do_action( 'news_event_before_footer_section' );

	/**
	 * Function - news_event_get_footer_instagram
	 * 
	 * @since 1.0.0
	 */
	news_event_get_footer_instagram();
?>
	<footer id="colophon" class="site-footer dark_bk">
		<?php
			/**
			 * Function - news_event_footer_sections_html
			 * 
			 * @since 1.0.0
			 * 
			 */
			news_event_footer_sections_html();

			/**
			 * Function - news_event_bottom_footer_sections_html
			 * 
			 * @since 1.0.0
			 * 
			 */
			news_event_bottom_footer_sections_html();
		?>
	</footer><!-- #colophon -->
	<?php
		/**
		* hook - news_event_after_footer_hook
		*
		* @hooked - news_event_scroll_to_top
		*
		*/
		if( has_action( 'news_event_after_footer_hook' ) ) {
			do_action( 'news_event_after_footer_hook' );
		}
	?>
</div><!-- #page -->

<?php wp_footer(); ?>
</body>
</html>