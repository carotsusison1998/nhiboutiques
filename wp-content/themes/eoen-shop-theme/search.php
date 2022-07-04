<?php
/**
 * The template for displaying search results.
 *
 * @package Theme Freesia
 * @subpackage Excellent
 * @since Excellent 1.0
 */
get_header(); ?>
<div class="wrap">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<div class="search-page">
				<?php
				if( have_posts() ) { ?>
				<header class="page-header">
					<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'excellent' ), '<span>' . esc_html( get_search_query() ) . '</span>' ); ?></h1>
				</header><!-- .page-header -->
				<ul class="products-search products d-flex">
					<?php while( have_posts() ) {
						the_post();
						get_template_part( 'template-parts/content', 'excerpt' );
					}
				} else { ?>
				</ul>
				<h2 class="entry-title">
					<p>&nbsp; </p>
					<?php esc_html_e( 'Không có sản phẩm bạn cần tìm.', 'excellent' ); ?>
				</h2>
				<?php }
				get_template_part( 'pagination', 'none' ); ?>
			</div>
		</main><!-- end #main -->
	</div> <!-- #primary -->
<?php
get_sidebar();
?>
</div><!-- end .wrap -->
<?php
get_footer();