<?php
	$change_pass_page_id = '';
    $change_pass_page = get_page_by_page_template('page-template/template-change-password.php');
    if ($change_pass_page) {
        $change_pass_page_id = $change_pass_page -> ID;
    }
	$content_success = $change_pass_page -> post_content;
?>
<div class="content-success">
	<?php echo apply_filters('the_content', $content_success)?>
</div>