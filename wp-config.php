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
define( 'DB_NAME', 'anglara' );

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
define( 'AUTH_KEY',         'PlxZcc|d=GeVN@o=G4BEZ-?!2ieKyP+^yg7WI<j=(O;UN-6lp]6HHj$7*9?8g?WM' );
define( 'SECURE_AUTH_KEY',  '}hC|nQv%,v#khZo_l$`?xmcY#-[$5LxZ:vD,ulLkqJuY$vT1v(phM i->LKo `^!' );
define( 'LOGGED_IN_KEY',    '0]Z=?Pgb[XqcV)p5&nL}]H]1nt037dC=(%&anS|35WVvAL@*sP6rYtIhMw.W L%4' );
define( 'NONCE_KEY',        'hN8y>Ov~X(04-sujyMpLGC!;P15q},)S]c<,*jJ-w4#zyOl/^bvhN$Ovem/BD{sV' );
define( 'AUTH_SALT',        '(WPC(|I#{a}Q@#xr[k8jqZ!|0[(Qq6n>8v#$fq=p_$TEY%]F>YwfVHo>?AK8VkaW' );
define( 'SECURE_AUTH_SALT', 'D0+c*giL>f!sq4hvXXzPlnMX6GnfN{Alp%)efs$FlDTKxO!`B0eTN7b2]~-_$Iu3' );
define( 'LOGGED_IN_SALT',   'W MP%#Xx7yUN)lw`r:A ,bB12L/[0P%|P;u*E9*vg#4I&}7e.OvkVX0vUciA(W1v' );
define( 'NONCE_SALT',       ',XGd@bR~enIW+$~k6d<)U6YW~d[; 5pCdRae.iln#H{f(`9B/&!*kTE42+BuNI|O' );

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
