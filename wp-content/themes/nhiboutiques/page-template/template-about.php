<?php
/**
* Template Name: About Page
*/
?>
<?php get_header();?>
<!-- About -->
<div class="about">
	<!-- Container -->
	<div class="container">
		<?php
            while ( have_posts() ) : the_post();
                the_content();
            endwhile;
        ?>
	</div>
	<!-- //Container -->
</div>
<!-- //About -->
<?php get_footer();?>