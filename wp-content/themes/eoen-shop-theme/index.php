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
			
			<div class="woocommerce product-new">
				<h2 class="txt-center pt-30">Sản Phẩm Mới</h2>
				<div class="tl-right p10 pt-30">
					<a href="<?php echo get_site_url();?>/products">Xem tất cả <i class="fa-solid fa-angle-right"></i></a>
				</div>
				<ul class="new-product products d-flex">
				<?php  
					$args = array(
						'post_type'      => 'product',
						'posts_per_page' => 12,
						'tax_query' => array(
							array(
								'taxonomy' => 'product_cat',
								'field' => 'slug',
								'terms' => 'san-pham', /*category name*/
								'operator' => 'IN',
							)
						)
					);
					$loop = new WP_Query( $args );
					while ( $loop->have_posts() ) : $loop->the_post();
						global $product;
						// var_dump($product);
				?>
						<li <?php wc_product_class( '', $product ); ?>>
						<?php do_action( 'woocommerce_widget_product_item_start', $args ); ?>
							<a href="<?php echo get_permalink();?>" class="woocommerce-LoopProduct-link woocommerce-loop-product__link">
								<?php if ( $product->is_on_sale() ) : ?>
									<?php echo apply_filters( 'woocommerce_sale_flash', '<span class="onsale">' . esc_html__( 'Sale!', 'woocommerce' ) . '</span>', $post, $product ); ?>
								<?php endif; ?>
								<?php echo woocommerce_get_product_thumbnail();?>
								<h2 class="woocommerce-loop-product__title"><?=get_the_title();?></h2>
								<?php echo $product->get_price_html();?>
							</a>
							<br>
							<a href="?add-to-cart=18" data-quantity="1" class="button product_type_simple add_to_cart_button ajax_add_to_cart" data-product_id="18" data-product_sku="" aria-label="" rel="nofollow">Thêm giỏ hàng</a>
						</li>
				<?php
						// echo '<br /><a href="'.get_permalink().'">' . woocommerce_get_product_thumbnail().' '.get_the_title().'</a>';
					endwhile;

					wp_reset_query();
				?>
				</ul>
			</div>

			<div class="woocommerce product-order">
				<h2 class="txt-center pt-30">Sản Phẩm Order</h2>
				<div class="tl-right p10 pt-30">
					<a href="<?php echo get_site_url();?>/products-orders">Xem tất cả <i class="fa-solid fa-angle-right"></i></a>
				</div>
				<ul class="new-product products d-flex">
				<?php  
					$args = array(
						'post_type'      => 'product',
						'posts_per_page' => 12,
						'tax_query' => array(
							array(
								'taxonomy' => 'product_cat',
								'field' => 'slug',
								'terms' => 'san-pham-order', /*category name*/
								'operator' => 'IN',
							)
						)
					);

					$loop = new WP_Query( $args );

					while ( $loop->have_posts() ) : $loop->the_post();
						global $product;
						// var_dump($product);
				?>
						<li <?php wc_product_class( '', $product ); ?>>
						<?php do_action( 'woocommerce_widget_product_item_start', $args ); ?>
							<a href="<?php echo get_permalink();?>" class="woocommerce-LoopProduct-link woocommerce-loop-product__link">
								<?php if ( $product->is_on_sale() ) : ?>
									<?php echo apply_filters( 'woocommerce_sale_flash', '<span class="onsale">' . esc_html__( 'Sale!', 'woocommerce' ) . '</span>', $post, $product ); ?>
								<?php endif; ?>
								<?php echo woocommerce_get_product_thumbnail();?>
								<h2 class="woocommerce-loop-product__title"><?=get_the_title();?></h2>
								<?php echo $product->get_price_html();?>
							</a>
							<br>
							<a href="?add-to-cart=18" data-quantity="1" class="button product_type_simple add_to_cart_button ajax_add_to_cart" data-product_id="18" data-product_sku="" aria-label="" rel="nofollow">Thêm giỏ hàng</a>
						</li>
				<?php
						// echo '<br /><a href="'.get_permalink().'">' . woocommerce_get_product_thumbnail().' '.get_the_title().'</a>';
					endwhile;

					wp_reset_query();
				?>
				</ul>
			</div>

			<div class="woocommerce">
				<h2 class="txt-center pt-30">Xu Hướng Và Mẹo Vặt</h2>
				<div class="tl-right p10 pt-30">
					<a href="">Xem tất cả <i class="fa-solid fa-angle-right"></i></a>
				</div>
				<section class="splide slide-post" aria-label="">
					<div class="splide__track">
						<ul class="splide__list">
							<?php
								$args = array( 'posts_per_page' => 9, 'category_name' => 'xu-huong-va-meo-vat' );
								$posts = get_posts($args);
								foreach ( $posts as $post ) : setup_postdata( $post );
							?>
									<li class="splide__slide">
										<a href="<?php echo the_permalink(); ?>">
											<?php 
												// echo get_the_post_thumbnail( $post->ID, 'thumbnail', array( 'class' => 'alignleft' ) ); 
												$featured_img_url = get_the_post_thumbnail_url($post->ID, 'full');
												if($featured_img_url != ""){
													echo '<img src="'.$featured_img_url.'">';
												}else{
													echo '<img src="'.get_template_directory_uri().'/images/no-image.png'.'">';
												}
											?>
											<h4 class="title-slide-post"><?php echo the_title(); ?></h4>
										</a>
									</li>
							<?php
								endforeach; 
								wp_reset_postdata();
							?>
						</ul>
					</div>
				</section>
			</div>

			
		</main><!-- end #main -->
	</div> <!-- #primary -->
<?php
get_sidebar();
?>
</div><!-- end .wrap -->
<?php
get_footer();