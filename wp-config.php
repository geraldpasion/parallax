<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link https://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'parallax');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

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
define('AUTH_KEY',         ']:4SxbK E(48TLHY?|dx5J.7#>)Wz_HB>k@01x w(J:(Cf|YBj <S*ZNV-O{9-,+');
define('SECURE_AUTH_KEY',  'H{rv?+b`j.1a+BpP&G7qbwN_NSEM:3s@v(BT[GK*+)gyl%f][H,l+.io;A`5*A?n');
define('LOGGED_IN_KEY',    'zIwH9T.rh&|^XCoN$2}Kdh:ABT|Cd<wuDTaPTO2U1q*;R+qKO*9dE-O{4}* -X8(');
define('NONCE_KEY',        'y)mZ 86U9rmv|Ya3ZU.j~*C/0ad?WTZ.T}DrN;t&H?ay7M@6;+h{f.EH_[i8G<uh');
define('AUTH_SALT',        'HCOb1~yueo-qR!x2-:rl7>CAz|U#H8*cwWb-*lFob0IrW(r0[zdxjT=0#28dEe7e');
define('SECURE_AUTH_SALT', 'i-P6K;(uv:tOqYpX4Gd5Ww&EwU;KED[-lItWCGL{u:AhUU1NQBU^w~Jk9F5t<-|}');
define('LOGGED_IN_SALT',   'mTv+b{1`{y8_`$Q3V6,R /8r/oaL~Mnp^%(J)YAvG{-B+a|U*(0 `lzmdX9uj+}Z');
define('NONCE_SALT',       '++ qssf,++-4n+^t_Gn#RJvEsKx(PieaQ.J|RI0Q*|7Egp+rO$pA+gDkM-h&hN]]');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
