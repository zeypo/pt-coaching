<?php
/**
 * La configuration de base de votre installation WordPress.
 *
 * Ce fichier contient les réglages de configuration suivants : réglages MySQL,
 * préfixe de table, clefs secrètes, langue utilisée, et ABSPATH.
 * Vous pouvez en savoir plus à leur sujet en allant sur 
 * {@link http://codex.wordpress.org/fr:Modifier_wp-config.php Modifier
 * wp-config.php}. C'est votre hébergeur qui doit vous donner vos
 * codes MySQL.
 *
 * Ce fichier est utilisé par le script de création de wp-config.php pendant
 * le processus d'installation. Vous n'avez pas à utiliser le site web, vous
 * pouvez simplement renommer ce fichier en "wp-config.php" et remplir les
 * valeurs.
 *
 * @package WordPress
 */

// ** Réglages MySQL - Votre hébergeur doit vous fournir ces informations. ** //
/** Nom de la base de données de WordPress. */
define('DB_NAME', 'pt_coaching');

/** Utilisateur de la base de données MySQL. */
define('DB_USER', 'root');

/** Mot de passe de la base de données MySQL. */
define('DB_PASSWORD', 'root');

/** Adresse de l'hébergement MySQL. */
define('DB_HOST', 'localhost');

/** Jeu de caractères à utiliser par la base de données lors de la création des tables. */
define('DB_CHARSET', 'utf8');

/** Type de collation de la base de données. 
  * N'y touchez que si vous savez ce que vous faites. 
  */
define('DB_COLLATE', '');

/**#@+
 * Clefs uniques d'authentification et salage.
 *
 * Remplacez les valeurs par défaut par des phrases uniques !
 * Vous pouvez générer des phrases aléatoires en utilisant 
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ le service de clefs secrètes de WordPress.org}.
 * Vous pouvez modifier ces phrases à n'importe quel moment, afin d'invalider tous les cookies existants.
 * Cela forcera également tous les utilisateurs à se reconnecter.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '8Pa|-]kmB$zR&C,8Q=&G}&-a8Pt_H4f=t]3*:h|b#^2{QH&ZXM{.YYA@1!DuIA}K');
define('SECURE_AUTH_KEY',  'it@/cYq+W3S_y&B }!&wuL6gSMO}-V=etbM9C`SEqe(fUO*51_~|)Z |%l|21**c');
define('LOGGED_IN_KEY',    'C:[d6x+A:6K4lRu.My)iTcE<!qT+vkD-]9+2EsIzC+7QR8*8^Q,TK&Fz-5E)# -|');
define('NONCE_KEY',        ')OG -y+DYWiplw!^kt}+6K%c[718/*=s?O&tbR=~LZ6~P95`4UL[T7=gs[@t|I:N');
define('AUTH_SALT',        'sXwZ/~*!gyOMh7-]{I.Q,wXs:KH{+v0FoHmq7clL];uoL*iX&%0z*/O]sb-|cie$');
define('SECURE_AUTH_SALT', '=ZP oa7+==rkRiS3`jdZ~CzUB{e7:h#O/Nm+=X-e(ML%{+;|7a+c,fll4={_LzM,');
define('LOGGED_IN_SALT',   'T,/evx50J&Ml:nC`YoPSoTO1XUh]9x#e1_e=Bk~T~|b+ens?$i79M%fwIEu%,k:N');
define('NONCE_SALT',       'n<c38gwu?g6KEORVOgWJGcz]R^/Wk._vOQ&;+}JLPHDzX6o,$k tlhsnBs|%HB;%');
/**#@-*/

/**
 * Préfixe de base de données pour les tables de WordPress.
 *
 * Vous pouvez installer plusieurs WordPress sur une seule base de données
 * si vous leur donnez chacune un préfixe unique. 
 * N'utilisez que des chiffres, des lettres non-accentuées, et des caractères soulignés!
 */
$table_prefix  = 'wp_';

/** 
 * Pour les développeurs : le mode deboguage de WordPress.
 * 
 * En passant la valeur suivante à "true", vous activez l'affichage des
 * notifications d'erreurs pendant votre essais.
 * Il est fortemment recommandé que les développeurs d'extensions et
 * de thèmes se servent de WP_DEBUG dans leur environnement de 
 * développement.
 */ 
define('WP_DEBUG', true); 

/* C'est tout, ne touchez pas à ce qui suit ! Bon blogging ! */

/** Chemin absolu vers le dossier de WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Réglage des variables de WordPress et de ses fichiers inclus. */
require_once(ABSPATH . 'wp-settings.php');