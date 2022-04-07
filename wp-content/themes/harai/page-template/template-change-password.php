<?php
/**
* Template Name: パスワード変更 Page
*/
?>
<?php get_header();?>
<?php
    $key = $_GET['key'];
    $location = get_site_url();
    if (empty($key)) {
        wp_redirect( $location);
        exit;
    }
    $check_user = check_user_reset_by_user_key($key);
    if (!$check_user) {
        wp_redirect( $location);
        exit;
    }
?>
<!-- Member login -->
<div class="member-login">
    <!-- Container -->
    <div class="container">
		<!-- login form -->
        <div class="login change-pass-login">
            <h2 class="title">パスワード変更</h2>
            <div class="form-login">
                <form id="frm-change-pass">
                    <div class="item">
                        <label><?php echo __('パスワード', TEXTDOMAIN)?><span class="required">*</span></label>
                        <input maxlength="30" type="password" name="password" placeholder="<?php echo __('パスワード', TEXTDOMAIN)?>" autocomplete="off" />
                    </div>
                    <div class="item">
                        <label><?php echo __('新しいパスワード', TEXTDOMAIN)?><span class="required">*</span></label>
                        <input maxlength="30" type="password" name="new_password" placeholder="<?php echo __('新しいパスワード', TEXTDOMAIN)?>" autocomplete="off" />
                    </div>
                    <div class="item">
                        <label><?php echo __('新しいパスワード<br>（再入力）', TEXTDOMAIN)?><span class="required">*</span></label>
                        <input maxlength="30" type="password" name="new_password_confirm" placeholder="<?php echo __('新しいパスワード（再入力）', TEXTDOMAIN)?>" autocomplete="off" />
                    </div>
                    <p class="login-error required"></p>
                    <input id="harai-user-change-pass" class="btn-submit-login" type="button" value="<?php echo __('変更', TEXTDOMAIN)?>">
                </form>
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
    wp_enqueue_script('def-js-login', DEF_SCRIPTS. 'components/change-password.js', array(), date('YmdHis'));
?>
<?php get_footer();?>