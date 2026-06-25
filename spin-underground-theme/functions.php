<?php
/**
 * Spin Underground Theme functions and definitions
 */

if ( ! function_exists( 'spinunderground_setup' ) ) :
	function spinunderground_setup() {
		// Let WordPress manage the document title.
		add_theme_support( 'title-tag' );

		// Enable support for Post Thumbnails on posts and pages.
		add_theme_support( 'post-thumbnails' );

		// Enable support for custom logo.
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'spinunderground_setup' );

/**
 * Enqueue scripts and styles.
 */
function spinunderground_scripts() {
	// Google Fonts
	wp_enqueue_style( 'spinunderground-fonts', 'https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;600&display=swap', array(), null );
	
	// Bootstrap Icons
	wp_enqueue_style( 'bootstrap-icons', 'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css', array(), '1.11.3' );

	// Theme stylesheet
	wp_enqueue_style( 'spinunderground-style', get_stylesheet_uri(), array(), wp_get_theme()->get( 'Version' ) );

    // Main JS (we will enqueue it inline for now, or you can extract it)
}
add_action( 'wp_enqueue_scripts', 'spinunderground_scripts' );

/**
 * Custom Post Types, Taxonomies, and ACF fields
 */
require get_template_directory() . '/inc/artists-setup.php';
require get_template_directory() . '/inc/front-page-setup.php';

/**
 * Customizer settings
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Custom comment callback to display author name instead of email
 */
if ( ! function_exists( 'spinunderground_comment_callback' ) ) {
	function spinunderground_comment_callback( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;
		
		// Get the user ID from the comment
		$user_id = $comment->user_id;
		
		// Get the display name if user is registered, otherwise use the comment author name
		if ( $user_id ) {
			$comment_author = get_the_author_meta( 'display_name', $user_id );
		} else {
			$comment_author = get_comment_author();
		}
		
		$comment_url    = get_comment_author_url();
		$comment_link   = $comment_url ? sprintf( '<a href="%s" target="_blank" rel="noopener">%s</a>', esc_url( $comment_url ), esc_html( $comment_author ) ) : esc_html( $comment_author );
		?>
		<li id="comment-<?php comment_ID(); ?>" <?php comment_class( 'comment' ); ?>>
			<div class="comment-meta">
				<div class="comment-author">
					<?php echo get_avatar( $comment, 40 ); ?>
					<div>
						<strong><?php echo $comment_link; ?></strong>
					</div>
				</div>
				<div class="comment-metadata">
					<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
						<?php printf( esc_html__( '%s ago', 'spinunderground' ), human_time_diff( get_comment_time( 'U' ), current_time( 'timestamp' ) ) ); ?>
					</a>
				</div>
			</div>
			<div class="comment-content">
				<?php comment_text(); ?>
			</div>
			<div class="comment-reply">
				<?php
				comment_reply_link( array_merge( $args, array(
					'depth'      => $depth,
					'max_depth'  => $args['max_depth'],
					'reply_text' => esc_html__( 'Reply', 'spinunderground' ),
				) ) );
				?>
			</div>
		</li>
		<?php
	}
}

