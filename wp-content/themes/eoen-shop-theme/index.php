<?php
/**
 * The main template file.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Theme Freesia
 * @subpackage Excellent
 * @since Excellent 1.0
 */
get_header(); ?>
<div class="wrap">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<header class="page-header">
				<h2 class="page-title"><?php single_post_title();?></h2>
				<!-- .page-title -->
				<?php excellent_breadcrumb(); ?><!-- .breadcrumb -->
			</header><!-- .page-header -->
			
			<div class="woocommerce">
				<ul class="new-product products d-flex">
				<?php  
					$args = array(
						'post_type'      => 'product',
						'posts_per_page' => 10,
					);

					$loop = new WP_Query( $args );

					while ( $loop->have_posts() ) : $loop->the_post();
						global $product;
				?>
						<li class="product type-product post-18 status-publish first instock product_cat-ao-thun-unisex has-post-thumbnail sale shipping-taxable purchasable product-type-simple">
							<a href="http://localhost:8080/nhiboutiques/product/ao-thun-hades-saigon-spirit-black-nam-nu-ao-thun-tay-lo-hades-sai-gon-full-tag/" class="woocommerce-LoopProduct-link woocommerce-loop-product__link">
							<span class="onsale">Sale!</span>
							<img width="300" height="300" src="http://localhost:8080/nhiboutiques/wp-content/uploads/2022/06/1146399ec12122c0ddc383326e315e5d.jpg" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" alt="" loading="lazy"><h2 class="woocommerce-loop-product__title">Áo thun Hades SAIGON SPIRIT BLACK nam nữ áo thun tay lỡ hades sài gòn Full tag</h2>
							<span class="price"><del aria-hidden="true"><span class="woocommerce-Price-amount amount"><bdi>220.000&nbsp;<span class="woocommerce-Price-currencySymbol">₫</span></bdi></span></del> <ins><span class="woocommerce-Price-amount amount"><bdi>130.000&nbsp;<span class="woocommerce-Price-currencySymbol">₫</span></bdi></span></ins></span>
						</a><a href="?add-to-cart=18" data-quantity="1" class="button product_type_simple add_to_cart_button ajax_add_to_cart" data-product_id="18" data-product_sku="" aria-label="Add “Áo thun Hades SAIGON SPIRIT BLACK nam nữ áo thun tay lỡ hades sài gòn Full tag” to your cart" rel="nofollow">Add to cart</a>
						</li>
				<?php
						// echo '<br /><a href="'.get_permalink().'">' . woocommerce_get_product_thumbnail().' '.get_the_title().'</a>';
					endwhile;

					wp_reset_query();
				?>
				</ul>
			</div>
		</main><!-- end #main -->
	</div> <!-- #primary -->
<?php
get_sidebar();
?>
</div><!-- end .wrap -->
<?php
get_footer();