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
define('DB_NAME', 'unaux_22871450_622');

/** MySQL database username */
define('DB_USER', '22871450_3');

/** MySQL database password */
define('DB_PASSWORD', '[SY-6733pH');

/** MySQL hostname */
define('DB_HOST', 'sql107.byetcluster.com');

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
define('AUTH_KEY',         'jjkbkhzfb0zjapbcqkf0kg0aopsjwvand3vvodwhmcuv7giris9awogyci1hwnec');
define('SECURE_AUTH_KEY',  'jqrosbcn5wjkgdkuudnbcjiscxyfaleze8zsa0uzuixcfitydpm9q6pv2odgmjou');
define('LOGGED_IN_KEY',    'bfn3t8nkyggxnllqsv1jo8etnweexg1xfs4hdbumv5eukj4nut0fstmj24oqnjhm');
define('NONCE_KEY',        'ybs0vc1209r9nj14bxepzkeoj24hlwwvwxbzkgkscsbhthy6b2zpaqup6mjcvmrr');
define('AUTH_SALT',        'fgxxfqruoe5d0dt8b7af4jn2r81zgkumjsfr4gzfmhni37cpyqzvq1hi059g7qdo');
define('SECURE_AUTH_SALT', 'f2m4zkvczpbch5jqvb1xfstjifl6w9d75ulrz0tbvk2trhasecinrkumx8vjosix');
define('LOGGED_IN_SALT',   '1xq8jlkeyzobpnaps5khakxijqmmwmpkvgxncrigisdh6juguhf5vrqmenjyffqb');
define('NONCE_SALT',       'yync7ulhuwaw25ujb7gyqrehu6xgji86oqmo6cwcztzzsrh3ox1sqgpucpcp61rn');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wpih_';

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
