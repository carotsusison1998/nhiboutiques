<?php
/**
* Template Name: パスワード再設定 Page
*/
?>
<?php get_header();?>
<div class="member-login">
    <!-- Container -->
    <div class="container">
		<!-- login form -->
        <div class="login">
            <h2 class="title">パスワード再設定</h2>
            <div class="form-login">
                <form id="frm-forgot-password">
                    <div class="item">
						<label><?php echo __('メールアドレス', TEXTDOMAIN)?><br><?php echo __('（携帯以外）', TEXTDOMAIN)?><span class="required">*</span></label>
                        <input maxlength="70" type="email" name="email" placeholder="<?php echo __('Email Address', TEXTDOMAIN)?>" autocomplete="off" />
                    </div>
                    <div class="item">
                        <p class="note">ご登録済みのメールアドレスにパスワード再設定メールを送信いたします。</p>
                    </div>
                    <p class="login-error required"></p>
                    <input id="forgot-password" class="btn-submit-login" type="button" value="<?php echo __('送信', TEXTDOMAIN)?>">
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
<?php
    wp_enqueue_script('def-js-login', DEF_SCRIPTS. 'components/forgot-password.js', array(), date('YmdHis'));
?>
<?php get_footer();?>