<?php  get_header();?>
<?php 
	$current_page = 'detail';
	$post_type = (!empty($post->post_type)) ? $post->post_type : '';
	if(!empty($post_type)) {	
	    if (CPT_PAGE['ORGANIZATION'] == $post_type) {
		    $current_page = 'harai-detail';
		}
	}
	echo get_template_part('template-parts/pages/content', $current_page);
?>
<?php get_footer();?>