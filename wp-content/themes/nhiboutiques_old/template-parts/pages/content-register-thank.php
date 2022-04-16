<?php
	$register_page_id = '';
    $register_page = get_page_by_page_template('page-template/template-register.php');
    if ($register_page) {
        $register_page_id = $register_page -> ID;
    }
	$thank_content = get_custom_field_by_post_id('harai_register_thank', $register_page_id);
?>
<div class="register-thank">
	<?php echo apply_filters('the_content', $thank_content)?>
</div>