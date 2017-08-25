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

define( 'WP_DEBUG', true );

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'ekskluzywk128');

/** MySQL database username */
define('DB_USER', 'ekskluzywk128');

/** MySQL database password */
define('DB_PASSWORD', 'AaGFczmzDxBV');

/** MySQL hostname */
define('DB_HOST', 'mysql55-61.perso:3306');

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
define('AUTH_KEY',         'Aj%R]VK^35@^>k4nNs/1e/I!p$&k{^sXFy/!(l#_-=_prMvcA9[VijBy+_%dV:%t');
define('SECURE_AUTH_KEY',  'G;|^~6:DZ/ZA7I%z<%36~r.&Lk0uH$@YQ4f[8Zscrc=9$PGf8AC,c+*Tmg`AB(X0');
define('LOGGED_IN_KEY',    '%c2{A^Yu>.NLmAZdMgm>>_s{JrrqW&fp,`!X4)8$CyWiESLK;A`p87eD4/A0&M!z');
define('NONCE_KEY',        '01+;zlVO5_f$#9^q=0})fap)38B}job,Y;3yb+:cGcb~sJeW*?LxBzra_WijK5QY');
define('AUTH_SALT',        '7bCr0$T4u6$@BgV)4tWRSeyQ<r&wcI& Xg)+(E{j3o4f;!.-RzE]q9z:g&Um)$_&');
define('SECURE_AUTH_SALT', '5^W2vvL@pb[Jy6vv`)A9U)u0IW3FwJbF~7(;.:>;ci;@zTihZSIr$~Y^1ioKZ6zs');
define('LOGGED_IN_SALT',   '=>D:,qbsu+2Hl~4<3)Px`s@8O[l>7_%7{m,oRxz._?3rvq:q-%ZPG1&bE{RD`0Zn');
define('NONCE_SALT',       'q8as2cI6D5KP.5mp(CyQ0dS-:,Wm(jL$S9+^)KwP:2eS4.!7PQ$G=FHWFvG(mYvL');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'hiszsmak_';

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
