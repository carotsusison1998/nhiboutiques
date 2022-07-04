<?php
/**
 * Template Name: Products Order Template
 *
 * Displays the Products Order page template.
 *
 * @package Theme Freesia
 * @subpackage Excellent
 * @since Excellent 1.0
 */
get_header();
?>
<div class="wrap">
    <div class="woocommerce product-new">
        <h2 class="txt-center pt-30">Sản Phẩm Orders</h2>
        <div class="list-categogy"><?php echo get_sub_categogy_by_slug("san-pham-order"); ?></div>
        <ul class="new-product products d-flex">
        <?php
            $args = array(
                'post_type'      => 'product',
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
</div><!-- end .wrap -->
<?php
get_footer();