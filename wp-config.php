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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wp_new' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '56Y/G,5_zP%1s(_AwJ+,|nAvsfdwE!K3l4QLgf;hJ`_l2pvA5-r/XQBuSGc3b%&^' );
define( 'SECURE_AUTH_KEY',  '68N):*H{5}lrL%S[vC@G:nji|PgWGZn zDJDQTW9[gA?[uhzFfhU[oTf.+;]CX!W' );
define( 'LOGGED_IN_KEY',    'UBIEbR}c8Pu@t&5n>LXLxHjx}jIi7TxjnlS$-JG7w=Bb(0{si?E8R9@9%UbIclj9' );
define( 'NONCE_KEY',        'e3OZtH/!}T]GxanF :ZZJ6>wCtKm$)xmUPbJ*J6a9iJ<x$<^}[6Iq iP<}#bS_=V' );
define( 'AUTH_SALT',        '{blz#2`f?Xu[Z)q-j^<|:%/QOr/Y]5CW=O[k0J.;BK_N}Qwf/=~8.:%60}no?_Q}' );
define( 'SECURE_AUTH_SALT', '],(]hCRfd7m5,Dk(0b%Z@[djaaRE=f5%=D.}M-R0-5h7Tf}vRL0qzSSd56A_!t}b' );
define( 'LOGGED_IN_SALT',   'DHCd#X#UR/<LE]&`AM3CS8tc?-WB5B%O^vOS98Y}73wef_9[;=xr|G-]+eB)#vV:' );
define( 'NONCE_SALT',       'brnwJJ:yfLdcG~o/bt9T%pJTd:f9fi#Ghs2Q}d?rp=Q$]0mSUmpAYo:E);6FaM-~' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
