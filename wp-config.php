<?php
define( 'WP_CACHE', false ); // Added by WP Rocket

/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'techie1b_wp782tw' );

/** Database username */
define( 'DB_USER', 'techie1b_wp782tw' );

/** Database password */
define( 'DB_PASSWORD', 'PS)6E83Qp.' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

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
define( 'AUTH_KEY',         'hdw2ylohrt2zawl4imebhwmzjviytrhql1q7lgt7ypj9lfiwaovyuhxrshhmaxjr' );
define( 'SECURE_AUTH_KEY',  'opxsgqc5eddo2qtbl6zbdncbx5j8y5vx2ym2bkiiqezepvnrfkiohclbm4jpfln8' );
define( 'LOGGED_IN_KEY',    'mvq66sa5tzgq4otebly98dmmavdjzoirjsdwabund6wfgmt5dz5pzl3rnp8oslka' );
define( 'NONCE_KEY',        '7qotwgxrpl0tdg1kpz8vbs0o2svyfivvosslglmv9w2gizwoyvzrlysolgmyanug' );
define( 'AUTH_SALT',        'tfz0vxapvdw9vehc37tmdmzjcvcoyceixrdbzyr65g9fsh6bibgvaot7m62nlgop' );
define( 'SECURE_AUTH_SALT', 'ikv8hq9zpso3b8fpdbrxyfjhdc7i70xqmwqyjzwhrhox9nest4jy9xizpqfsrcsp' );
define( 'LOGGED_IN_SALT',   'grm5nwenfb7d0gypumc17mgqvox9fikkpxsy5wepzmfvrvqphbtfpildajkc1eqt' );
define( 'NONCE_SALT',       'pmer1mexwsgeprl9ffxgpryybmb1lodowpbqaynntdp6clbvsmn4ghzuurgerjuo' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wpss_tw';

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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
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
