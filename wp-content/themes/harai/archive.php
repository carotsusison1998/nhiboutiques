<?php
	$post_type = (!empty($post->post_type)) ? $post->post_type : '';
	if(empty($post_type)) {
	    $queried_object = get_queried_object();
	    $post_type = $queried_object -> name;
	}
	if (CPT_PAGE['ORGANIZATION'] == $post_type) {
	    get_template_part('page-template/template', 'harai');
	} else {
	    $location = get_site_url();
	    wp_redirect( $location);
	    exit;
	}
?>