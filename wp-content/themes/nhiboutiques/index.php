<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package nhiboutiques
 */

get_header();
?>

	<main id="primary" class="site-main">
		<!-- slideshow -->
        	<?php echo get_template_part(TEMPLATES_PARTS, 'slider');?>
        <!-- //slideshow -->
		<div class="products-main">
			<h2 class="title-product">Sản Phẩm Mới</h2>
			<ul class="products">
			<?php 
				if ( is_front_page() ){
					$args = array(
				        'post_type' => 'product',
				        'posts_per_page' => 18
				        );
				    $loop = new WP_Query( $args );
				    if ( $loop->have_posts() ) {
				        while ( $loop->have_posts() ) : $loop->the_post();
				            woocommerce_get_template_part( 'content', 'product' );
				        endwhile;
				    } else {
				        echo __( 'No products found' );
				    }
				    wp_reset_postdata();
				}
			?>
			</ul>
		</div>
	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
