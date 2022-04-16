<?php
/**
* Template Name: 会員様ログイン Page
*/
?>
<?php get_header();?>
<?php
    if(!empty($_SESSION[HARAI_USER])) {
        $location = get_site_url();
        wp_redirect( $location);
        exit;
    }
?>
<!-- Member login -->
<div class="member-login">
    <!-- Container -->
    <div class="container">
		<!-- login form -->
        <div class="login">
            <h2 class="title">ログイン <span>Login</span></h2>
            <div class="form-login">
                <form id="harai-login">
                    <div class="item">
						<label><?php echo __('メールアドレス', TEXTDOMAIN)?><br><?php echo __('（携帯以外）', TEXTDOMAIN)?><span class="required">*</span></label>
                        <input maxlength="70" type="email" name="email" placeholder="<?php echo __('Email Address', TEXTDOMAIN)?>" autocomplete="off" />
                    </div>
                    <div class="item">
                        <label><?php echo __('Password', TEXTDOMAIN)?><span class="required">*</span></label>
                        <input maxlength="30" type="password" name="password" placeholder="<?php echo __('Password', TEXTDOMAIN)?>" autocomplete="off" />
                    </div>
                    <p class="login-error required"></p>
                    <input id="harai-login" class="btn-submit-login" type="button" value="<?php echo __('ログイン', TEXTDOMAIN)?>">
                </form>
            </div>
            <div class="note-login">
                <?php
                    while ( have_posts() ) : the_post();
                        the_content();
                    endwhile;
                ?>
            </div>
		</div>
		<!-- // login form -->
		<!-- social -->
		 <?php echo get_template_part(TEMPLATES_PARTS, 'share');?>
        <!-- // social -->
    </div>
    <!-- //Container -->
</div>
<!-- //Member login -->
<?php
    wp_enqueue_script('def-js-login', DEF_SCRIPTS. 'components/login.js', array(), date('YmdHis'));
?>
<?php get_footer();?>