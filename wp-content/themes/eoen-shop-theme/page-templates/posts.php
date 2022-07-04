<?php
/**
 * Template Name: POSTs Template
 *
 * Displays the POSTs page template.
 *
 * @package Theme Freesia
 * @subpackage Excellent
 * @since Excellent 1.0
 */
get_header();
?>
<div class="wrap">
    <div class="woocommerce product-new">
        <h2 class="txt-center pt-30">Xu Hướng và Mẹo Vặt</h2>
        <ul class="new-product products d-flex">
        <?php
            $args = array( 'posts_per_page' => 9, 'category_name' => 'xu-huong-va-meo-vat' );
            $posts = get_posts($args);
            foreach ( $posts as $post ) : setup_postdata( $post );
        ?>
                <li>
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
</div><!-- end .wrap -->
<?php
get_footer();