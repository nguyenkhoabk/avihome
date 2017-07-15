<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'cp378584_wp1');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'pE1rupVmfJl13ocbi8Gct26nwjkG1xxtwUzyrcnrknYCbTQnhAKvTKEnE5f35WB8');
define('SECURE_AUTH_KEY',  '6n2EDTASs6MePe57u8w4rUxbBAml1gawVzB86XHgqx86gKyzoua8WZxFF2RzHYM2');
define('LOGGED_IN_KEY',    'suN4tFWg18Jhpmil6OnijKpyIhaNP66MkvlyTiF5FRAyyhUVtULmtOwbCBc0xyeM');
define('NONCE_KEY',        'lty9hjSOqC6suU4o4DY9IZPTVsKu6VFr1pKkuaI5909CzcSHClbDTsP6Zv6RhE7b');
define('AUTH_SALT',        '5EQhGHdqaC3sb6RemeF3CgvnoJmbUJY0P7aorMuGqsM38buBwT8lJiiNnpAovFfT');
define('SECURE_AUTH_SALT', 'x06sKtzhGRyZDSlF90WSHKwZnyzwr3tlWmsZwfMHZE9aw7sC3hIcvjUNvcgLfg51');
define('LOGGED_IN_SALT',   'UhV2mJN8UeIFGEmhjHfVyM5KT0sZlkobq145Mf1EEj5llj50Y8LQpByP3eOktfkM');
define('NONCE_SALT',       '3h9VwLIuM7wRJPDjJvXIaFN9UiQSVktz740KRMyuj3qgotVMKZZWnoD66EloPWtS');

/**
 * Other customizations.
 */
define('FS_METHOD','direct');define('FS_CHMOD_DIR',0755);define('FS_CHMOD_FILE',0644);
define('WP_TEMP_DIR',dirname(__FILE__).'/wp-content/uploads');

/**
 * Turn off automatic updates since these are managed upstream.
 */
define('AUTOMATIC_UPDATER_DISABLED', true);


/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
//define('WP_DEBUG', true);
// Disable display of errors and warnings 
define( 'WP_DEBUG_DISPLAY', false );
@ini_set( 'display_errors', 0 );


/* That's all, stop false editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

define('WP_HOME','http://avihome.dev');
define('WP_SITEURL','http://avihome.dev');