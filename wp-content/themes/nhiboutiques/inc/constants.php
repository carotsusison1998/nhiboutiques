<?php
//The path to template directory
define('DEF_THEMEROOT', get_stylesheet_directory_uri());
//The path to image directory
define('DEF_IMAGES', DEF_THEMEROOT . '/images/');
//The path to js directory
define('DEF_SCRIPTS', DEF_THEMEROOT . '/js/');
//The path to css directory
define('DEF_STYLE', DEF_THEMEROOT . '/css/');
//The path to vendor directory
define('DEF_VENDOR', DEF_THEMEROOT . '/js/vendor/');
define('DEF_JS', DEF_THEMEROOT . '/js/');
//The path to template-parts folder
define('TEMPLATES_PARTS', 'template-parts/pages/content');
//Defines a text domain for multiple languages
define('TEXTDOMAIN', 'harai');
//Custom post type page
define('CPT_PAGE', array(
	'ORGANIZATION' => 'organization_cpt'
));
define('TOTAL_ARTICLE_LIMIT', 6);
//Limit the number of characters to display short descriptions for news and history articles
define('CHAR_LIMIT', 70);
define('ORGANIZATION_CHAR_LIMIT', 256);
define('ORGANIZATION1_CHAR_LIMIT', 266);
define('HARAI_USER', 'harai_user');
define('ADMIN_MAILS', 'vo.duy.anh@greensun.com.vn, luyen.nguyen@flex.com.vn');