<?php
/**
 * Load plugin's files with check for installing it as a standalone plugin or
 * a module of a theme / plugin. If standalone plugin is already installed, it
 * will take higher priority.
 * @package Meta Box
 */

/**
 * Plugin loader class.
 * @package Meta Box
 */
class RWMB_Loader
{
	/**
	 * Class constructor.
	 */
	public function __construct()
	{
		$this->constants();
		spl_autoload_register( array( $this, 'autoload' ) );
		$this->init();
	}

	/**
	 * Define plugin constants.
	 */
	public function constants()
	{
		// Script version, used to add version for scripts and styles
		define( 'RWMB_VER', '4.8.4' );

		// Plugin URLs, for fast enqueuing scripts and styles
		define( 'RWMB_URL', G5PLUS_THEME_URL . 'g5plus-framework/meta-box/' );
		define( 'RWMB_JS_URL', trailingslashit( RWMB_URL . 'js' ) );
		define( 'RWMB_CSS_URL', trailingslashit( RWMB_URL . 'css' ) );

		// Plugin paths, for including files
		define( 'RWMB_DIR', G5PLUS_THEME_DIR . 'g5plus-framework/meta-box/' );
		define( 'RWMB_INC_DIR', trailingslashit( RWMB_DIR . 'inc' ) );
		define( 'RWMB_FIELDS_DIR', trailingslashit( RWMB_INC_DIR . 'fields' ) );
	}

	/**
	 * Autoload fields' classes.
	 * @param string $class Class name
	 */
	public function autoload( $class )
	{
		// Only load plugin's classes
		if ( 'RW_Meta_Box' != $class && 0 !== strpos( $class, 'RWMB_' ) )
		{
			return;
		}

		// Get file name
		$file = 'meta-box';
		if ( 'RW_Meta_Box' != $class )
		{
			// Remove prefix 'RWMB_'
			$file = substr( $class, 5 );

			// Optional '_Field'
			$file = preg_replace( '/_Field$/', '', $file );
		}

		$file = strtolower( str_replace( '_', '-', $file ) ) . '.php';

		$dirs = array( RWMB_INC_DIR, RWMB_FIELDS_DIR, trailingslashit( RWMB_INC_DIR . 'walkers' ) );
		foreach ( $dirs as $dir )
		{
			if ( file_exists( $dir . $file ) )
			{
				require $dir . $file;
				return;
			}
		}
	}

	/**
	 * Initialize plugin.
	 */
	public function init()
	{
		// Plugin core
		new RWMB_Core;

		if ( is_admin() )
		{
			// Validation module
			new RWMB_Validation;
		}

		// Public functions
		require RWMB_INC_DIR . 'functions.php';
	}
}
