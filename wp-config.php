<?php
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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'eoenshop' );

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
define( 'AUTH_KEY',         'tq9#qPF^Jo3Op111RMR,@s2O;BDv6qo]CxX=yJs|PlWI4`l,BCniqh<{RT,hilA]' );
define( 'SECURE_AUTH_KEY',  'ONhU|FJl]MTt7UdW8R0A)ju$7i/W&HlP8tB+GW3h^ZWdK6,:m6KJyq0<hB7]c7Jx' );
define( 'LOGGED_IN_KEY',    'XDQ`)U;9T,D&=Oa Ok(UL}O<#Ng$zWNAQs.F&BeV3RxuAK7T(dVt;?/@_o63dx{:' );
define( 'NONCE_KEY',        '8(<( ZJ~fuNSqhl{Mx3;G;H<^/5^,ET[4wd3~oR]_!io#`N[*`$?=R%JAE~n]1Z7' );
define( 'AUTH_SALT',        '1Awm#U2U*;7s1?O(HttJ/<iV>=2ySU0$;(c)0x{Ho OaVhf87aV AaOSC^s^,J(*' );
define( 'SECURE_AUTH_SALT', '*m2Pt3vf0=Um9kt1JB^_IB:;9~emCqMY?:u<H@48y!e*`p1kHlh7l8}c2+}pB(2s' );
define( 'LOGGED_IN_SALT',   'k+t2u:8)59==G3K6Zkpf2-2o}}n#jgt#}`X>|a<B8c/-?HKg<I{Xi?+x[j20PXeD' );
define( 'NONCE_SALT',       '4 =*JvdftR|RE~ERtz,o $`TbwwLGwsssdZm4IJD5~Q&r}p%q)A_Eay`@C..{4EF' );

/**#@-*/

/**
 * WordPress database table prefix.
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

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
