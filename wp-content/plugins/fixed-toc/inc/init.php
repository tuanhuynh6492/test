<?php
/**
 * Initialization
 * 
 * Detect min compatible version, action links, internationalization, etc.
 * 
 * @since 3.1.0
 */
class Fixedtoc_Init {
	const WP_MIN_VERSION = '4.5';

	/**
	 * Constructor.
	 * 
	 * @since 3.1.0
	 * @access public
	 */
	public function __construct() {
		// Compare WordPress min version.
		register_activation_hook( FTOC_ROOTFILE, array( $this, 'wp_min_version_compare' ) );
		
		// Translation
		$this->internationalization();
		
		// Add action links
		add_filter( 'plugin_action_links_' . plugin_basename( FTOC_ROOTFILE ), array( $this, 'action_links' ) );
	}

	/**
	 * Compare WordPress min version.
	 * 
	 * @since 1.0.0
	 * @access public
	 * 
	 * @return void
	 */
	public function wp_min_version_compare() {
		if ( version_compare( $GLOBALS['wp_version'], self::WP_MIN_VERSION, '<' ) ) {
			wp_die( 
				sprintf( 
					__( 'This plugin requires at least WordPress version %s. You are running version %s. Please upgrade and try again.', 'fixedtoc' ), 
					self::WP_MIN_VERSION,
					$GLOBALS['wp_version'] 
				), 
				'', 
				array( 'back_link' => true ) 
			);
		}
	}

	/**
	 * Internationalization.
	 * 
	 * @since 1.0.0
	 * @access public
	 * 
	 * @return void
	 */
	public function internationalization() {
		load_plugin_textdomain( 'fixedtoc', false, FTOC_ROOTDIR . '/languages/' );
	}

	/**
	 * Add action links.
	 * 
	 * @since 1.0.0
	 * @access public
	 * 
	 * @param array $actions
	 * @return array
	 */
	public function action_links( $actions ) {
		$actions['settings'] = '<a href="' . admin_url( 'admin.php' ) . '?page=fixedtoc">' . __( 'Settings', 'fixedtoc' ) . '</a>';
		$actions['customize'] = '<a href="' . admin_url( 'customize.php' ) . '">' . __( 'Customize', 'fixedtoc' ) . '</a>';
		return $actions;
	}

}

/**
 * Check WordPress minimum compatible version.
 *
 * @since 1.0.0
 */
// register_activation_hook( FTOC_ROOTFILE, 'fixedtoc_wp_min_version' );

// function fixedtoc_wp_min_version() {
// 	if ( version_compare( $GLOBALS['wp_version'], '4.5', '<' ) ) {
// 		wp_die( sprintf( __( 'This plugin requires at least WordPress version 4.5. You are running version %s. Please upgrade and try again.', 'fixedtoc' ), $GLOBALS['wp_version'] ), '', array( 'back_link' => true ) );
// 	}
// }

/**
 * Internationalization
 *
 * @since 1.0.0
 */
// load_plugin_textdomain( 'fixedtoc', false, FTOC_ROOTDIR . '/languages/' );

/**
 * Add plugin settings link
 *
 * @since 1.0.0
 */
// add_filter( 'plugin_action_links_' . plugin_basename( FTOC_ROOTFILE ), 'fixedtoc_settings_link' );

// function fixedtoc_settings_link( $actions ) {
// 	$actions['settings'] = '<a href="' . admin_url( 'admin.php' ) . '?page=fixedtoc">' . __( 'Settings', 'fixedtoc' ) . '</a>';
// 	$actions['customize'] = '<a href="' . admin_url( 'customize.php' ) . '">' . __( 'Customize', 'fixedtoc' ) . '</a>';
// 	return $actions;
// }