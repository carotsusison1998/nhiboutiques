<?php
/**
* Template Name: お問い合わせ Page
*/
?>
<?php get_header();?>
<!-- Contact -->
<div class="contact">
	<!-- Container -->
	<div class="container contact-container">
		<h2 class="title"><?php echo __('お問い合わせ', TEXTDOMAIN)?></h2>
		<div class="contact-form">
			<?php echo do_shortcode('[contact-form-7 id="5" title="Contact form"]')?>
		</div>
		<div class="desc">
			<?php
                while ( have_posts() ) : the_post();
                    the_content();
                endwhile;
            ?>
		</div>
		 <!-- social -->
        <?php echo get_template_part(TEMPLATES_PARTS, 'share');?>
        <!-- // social -->
	</div>
	<!-- //Container -->
</div>
<!-- //Contact -->
<?php get_footer();?>