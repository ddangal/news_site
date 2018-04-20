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
define('DB_NAME', 'news_site');

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
define('AUTH_KEY',         'E->mnKFGL[x`B-mn]zr^XXo[v@Fo/oBL)_F~u>S*b:fMOynHM5>7}0fliUYlN1#<');
define('SECURE_AUTH_KEY',  '}4kYUyYZ6m_l!h}>@F,e<L`whr#dvaKer,amKhdlJ9Aq2*8GQL4t<;il=~~){8)R');
define('LOGGED_IN_KEY',    'H1{o[b>~UOtOibFAGIrFr&N01,y7(NWLZ639/I*$H )n7>$y$[iQQvs<&`1.Cy{y');
define('NONCE_KEY',        '7UytYEW_ptfxR&*9]GFokKt~m;O1NNhn@,Qv7OVRzKjEFsC3UFk^c[7D(AoQr(^y');
define('AUTH_SALT',        '|3t|^J3T|UQ,rcwGb5?l~nw+A7>cc%p_Q78e[TKka?k_x(hU45z%6W:7L5K;Ob25');
define('SECURE_AUTH_SALT', '%=-/~u)+Q|wYtyt!6<~f*84eh[Ny 81r*{*tYZE.[9k r)ruTE#N)RpT-Shm?PVf');
define('LOGGED_IN_SALT',   '9,7)4_9npQpf(.0G|ZYBHB%vzyw1<wHUysti?S<iYC)/urDao_34Riz$>jb1Hz=`');
define('NONCE_SALT',       'AaQ(D?NS=kB|F.bT*z,8;7T7)hKhfVn3(x]i+8LNL/ 5~6wJiO,T,H>o7F`7k><]');

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
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
