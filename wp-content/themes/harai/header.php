<?php 
/**
 * header.php
 *
 * The header for the theme.
 */
?>
<!DOCTYPE html>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <title><?php wp_title( '', true, 'right' );?></title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <script type="text/javascript">
        if (/MSIE \d|Trident.*rv:/.test(navigator.userAgent)) {
            document.write('<script src="<?php echo DEF_VENDOR?>blazor/blazor.polyfill.min.js"><\/script>');
        }
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dosis:wght@300;400;500;600;700;800&family=Nunito+Sans:ital,wght@0,200;0,300;1,200;1,300&family=Nunito:wght@200;300;400;500;600&display=swap" rel="stylesheet">
    <?php wp_head(); ?>
</head>
<?php
    $login_page_url = '';
    $login_page = get_page_by_page_template('page-template/template-member-login.php');
    if ($login_page) {
        $login_page_url = $login_page -> url;
    }
    $contact_page_url = '';
    $contact_page = get_page_by_page_template('page-template/template-contact.php');
    print_r($contact_page);
    if ($contact_page) {
        $contact_page_url = $contact_page -> url;
    }
    $shrm_page_url = '';
    $shrm_page = get_page_by_page_template('page-template/template-shrm.php');
    if ($shrm_page) {
        $shrm_page_url = $shrm_page -> url;
    }
    $is_user_login = true;
    if(empty($_SESSION[HARAI_USER])) {
        $is_user_login = false;
    }
?>
<body <?php body_class(); ?>>
   <!-- Header -->
    <div id="header">
        <div class="navbar-toggler hidden-pc" type="button">
            <span></span>
            <span></span>
            <span></span>
        </div>
        <div class="container <?php echo ( is_front_page() ) ? 'container-home' : '' ?>">
            <div class="top-menu">
                
                <?php 
                    wp_nav_menu( array( 
                        'theme_location' => 'top-menu',
                        'fallback_cb' => false,
                        'container' => 'ul',
                        'container_id' => '',
                        'link_before' => '',
                        'link_after' => '',
                        'menu_class' => ''
                    ));
                ?>
            </div>
            <div class="nav-menu">
                <div class="top-menu-sp">
                    <?php if ($is_user_login){?>
                        <a class="harai-logout" href="javascript:void(0);"><?php echo __('ログアウト', TEXTDOMAIN)?></a>
                    <?php } else {?>
                        <a href="<?php echo $login_page_url?>"><?php echo __('ログイン', TEXTDOMAIN)?></a>
                    <?php }?>
                    <a href="<?php echo $contact_page_url?>"><?php echo __('お問い合わせ', TEXTDOMAIN)?></a>
                </div>
                <?php 
                    wp_nav_menu( array( 
                        'theme_location' => 'main-menu',
                        'fallback_cb' => false,
                        'container' => 'ul',
                        'container_id' => '',
                        'link_before' => '',
                        'link_after' => '',
                        'menu_class' => ''
                    ));
                ?>
            </div>
        </div>
    </div>
    <!-- //Header -->