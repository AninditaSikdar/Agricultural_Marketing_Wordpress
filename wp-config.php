<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'agriculture_market' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'MH[vO=Z_rCXegh[e/%./RH?gnqrGspA.2u7>=xRQw3ejw<Rw:,.B:XiW^.n?%zlF' );
define( 'SECURE_AUTH_KEY',  'TYrEP9:6sTs45LH,;^49]1l/_!wyk4REr;?*d0D)(X&Sc5H$Vp;&t;HnsBue9=QT' );
define( 'LOGGED_IN_KEY',    'fN HLX!jEhEOVWLqz$`W/c52ybV{${IZ77cZ?J6o@fm=AyGPP}fs+~Ka-2L%aBzl' );
define( 'NONCE_KEY',        'iy9GNN?Zzs97j,~#w}/~>J;kK3KaDI^&#,uX*+m&9j15V&9f^>oh.rL`?_@1W<9y' );
define( 'AUTH_SALT',        '##y)oOo+V}e;ewYT0d%%M=|6_~Ne^9T4r~Q!LlvcyV%ty~c Hy(j8>G>zT?e&Nwv' );
define( 'SECURE_AUTH_SALT', 'k-DRm8wyTM*eYDTi=7rQ9Ca=B9ccm(b+YS-!lrkQEYTp7agw{ss0_@ 30j[9r-KA' );
define( 'LOGGED_IN_SALT',   'hNfgyFbDQej![.%%63&}k2/:@D)_g`5gHolo{HjsLPAAfx:M7BHU~tPIAt#-iD$(' );
define( 'NONCE_SALT',       'j@<(o%sDcbFc$>6hMN]RgVG__U)>3C/6#lV,63R5KxDoG^xGeP(NfA|xF<d&xU(n' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
