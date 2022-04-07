<?php
	$forgot_pass_page_id = '';
    $forgot_pass_page = get_page_by_page_template('page-template/template-forgot-password.php');
    if ($forgot_pass_page) {
        $forgot_pass_page_id = $forgot_pass_page -> ID;
    }
	$content_success = get_custom_field_by_post_id('forgot_password_success', $forgot_pass_page_id);
?>
<div class="content-success">
	<?php echo apply_filters('the_content', $content_success)?>
</div>